<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;  // Import Hash facade for secure password generation
use Illuminate\Support\Str;
use Storage;// Import Str facade for generating secure tokens

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Retrieve the user information from Google
            $user = Socialite::driver('google')->user();

            // Check if the user exists either by Google ID or email
            $finduser = User::where('google_id', $user->id)
                ->orWhere('email', $user->email)
                ->first();

            // If user exists, log them in
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('/dashboard'); // Redirect to intended page (or dashboard if none)
            } else {
                // If user doesn't exist, create a new user
                $newUser = User::create([
                    'fullname' => $user->name,  // Full name from Google
                    'nickname' => $user->nickname ?? Str::slug($user->name), // Fallback to slug if no nickname
                    'email' => $user->email,  // Email from Google
                    'google_id' => $user->id,  // Google ID for future reference
                    'password' => Hash::make(Str::random(16)),  // Generate a random secure password
                ]);

                if ($user->avatar) {
                    $imageContent = file_get_contents($user->avatar);
                    $imageName = 'profile_' . $newUser->id . '.jpg';
                    $path = 'img/profile_photos/' . $imageName;

                    // Simpan file langsung ke public/img/profile_photos
                    $storagePath = public_path($path);

                    // Pastikan direktori tujuan ada
                    if (!file_exists(dirname($storagePath))) {
                        mkdir(dirname($storagePath), 0755, true); // Buat folder jika belum ada
                    }

                    file_put_contents($storagePath, $imageContent);

                    // Simpan path ke database
                    $newUser->profile_photo_path = $path;
                    $newUser->save();
                }

                // Log the new user in
                Auth::login($newUser);
                return redirect()->intended('/dashboard');  // Redirect to the dashboard after successful login
            }
        } catch (Exception $e) {
            // If something goes wrong, return an error message
            return redirect('/')->with('error', 'Something went wrong, please try again.');
        }
    }
}
