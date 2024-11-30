<section id="faq" class="py-20 bg-white">
    <div class="max-w-4xl px-6 mx-auto lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                FAQ
            </h2>
            <p class="mt-4 text-lg text-slate-700 animate-fade-in-up">
                Pertanyaan yang sering diajukan seputar aplikasi keuangan kami.
            </p>
        </div>
        <div class="mt-16">
            <div class="space-y-4" x-data="{ activeAccordion: null }">
                <!-- FAQ 1 -->
                <div class="overflow-hidden transition-all duration-300 border rounded-lg shadow-sm hover:shadow-md">
                    <button @click="activeAccordion = (activeAccordion === 1 ? null : 1)"
                        class="flex items-center justify-between w-full px-6 py-4 font-semibold text-left transition-colors duration-200 text-slate-900 hover:bg-indigo-50">
                        Bagaimana cara menggunakan aplikasi ini?
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform transform"
                            :class="activeAccordion === 1 ? 'rotate-180' : 'rotate-0'" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 1" x-collapse class="px-6 pb-4 bg-white text-slate-700">
                        Anda dapat mulai dengan mendaftar akun secara gratis, lalu langsung mencatat pemasukan dan
                        pengeluaran Anda.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="overflow-hidden transition-all duration-300 border rounded-lg shadow-sm hover:shadow-md">
                    <button @click="activeAccordion = (activeAccordion === 2 ? null : 2)"
                        class="flex items-center justify-between w-full px-6 py-4 font-semibold text-left transition-colors duration-200 text-slate-900 hover:bg-indigo-50">
                        Apakah aplikasi ini gratis?
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform transform"
                            :class="activeAccordion === 2 ? 'rotate-180' : 'rotate-0'" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 2" x-collapse class="px-6 pb-4 bg-white text-slate-700">
                        Ya, aplikasi ini menyediakan versi gratis.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="overflow-hidden transition-all duration-300 border rounded-lg shadow-sm hover:shadow-md">
                    <button @click="activeAccordion = (activeAccordion === 3 ? null : 3)"
                        class="flex items-center justify-between w-full px-6 py-4 font-semibold text-left transition-colors duration-200 text-slate-900 hover:bg-indigo-50">
                        Apakah data saya aman?
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform transform"
                            :class="activeAccordion === 3 ? 'rotate-180' : 'rotate-0'" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 3" x-collapse class="px-6 pb-4 bg-white text-slate-700">
                        Kami menggunakan enkripsi pada setiap akun yang terdaftar untuk memastikan data Anda tetap aman dan terlindungi.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
