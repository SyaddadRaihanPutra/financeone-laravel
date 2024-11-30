<?php

namespace App\Providers;

use App\Models\{Transaction, Budget, Report};
use App\Policies\{TransactionPolicy, BudgetPolicy, ReportPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Transaction::class => TransactionPolicy::class,
        Budget::class => BudgetPolicy::class,
        Report::class => ReportPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
