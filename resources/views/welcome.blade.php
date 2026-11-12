<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Direktori Aplikasi - Fakultas Ilmu Komputer Universitas Subang</title>
        <meta name="description" content="Portal direktori resmi seluruh aplikasi dan layanan web Fakultas Ilmu Komputer (FASILKOM) Universitas Subang. Akses cepat SIAKAD, SIBIMA, LMS, JTIK, dan sistem digital kampus.">

        <link rel="icon" href="/logo-unsub.png" type="image/png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background-color: #F8FAFC;
                color: #0F172A;
            }
            h1, h2, h3, h4, .font-heading {
                font-family: 'Outfit', sans-serif;
            }
            .hero-bg-pattern {
                background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
                background-size: 24px 24px;
            }
        </style>
    </head>
    <body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col selection:bg-blue-600 selection:text-white"> 
        <!-- HERO SECTION -->
        <section id="beranda" class="relative bg-linear-to-b from-white via-slate-50 to-slate-100 pt-12 pb-16 md:pt-16 md:pb-20 border-b border-slate-200 hero-bg-pattern">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                
                <!-- Main Academic Title -->
                <h1 class="text-3xl sm:text-5xl font-extrabold font-heading text-slate-900 tracking-tight leading-tight">
                    Direktori Aplikasi <br/>
                    <span class="text-blue-900">Fakultas Ilmu Komputer</span>
                    <span class="text-blue-900">Universitas Subang</span>
                </h1>
                <!-- Search Box -->
                <div class="mt-8 max-w-2xl mx-auto">
                    <div class="relative bg-white rounded-2xl p-2 border border-slate-300 shadow-lg flex items-center">
                        <div class="pl-3 text-slate-400">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="appSearchInput"
                            placeholder="Cari nama aplikasi atau kata kunci (misal: SIAKAD, SIBIMA, Skripsi, LMS, Jurnal)..." 
                            class="w-full bg-transparent border-0 focus:ring-0 focus:outline-none placeholder-slate-400 px-3 py-2 text-sm sm:text-base font-medium"
                            oninput="filterApps()"
                        />
                        <button 
                            id="clearSearchBtn"
                            onclick="clearSearch()"
                            class="hidden text-slate-400 hover:text-slate-700 p-1.5 rounded-lg hover:bg-slate-100 transition-all mr-1"
                            title="Bersihkan pencarian"
                        >
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </section>



        <!-- ALL APPLICATIONS DIRECTORY SECTION -->
        <section id="direktori" class="py-14 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Category Filter Buttons -->
            <div class="flex items-center justify-center flex-wrap gap-2 mb-8" id="categoryFilterContainer">
                @foreach ($categories as $cat)
                    <button 
                        onclick="selectCategory('{{ $cat['slug'] }}')"
                        data-category="{{ $cat['slug'] }}"
                        class="category-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all border flex items-center gap-2 {{ $loop->first ? 'bg-blue-900 text-white border-blue-900 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-100 hover:text-slate-900' }}"
                    >
                        <span>{{ $cat['name'] }}</span>
                    </button>
                @endforeach
            </div>

            <!-- Applications Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="appsContainer">
                @foreach ($apps as $app)
                    <div 
                        class="app-card bg-white rounded-2xl p-6 border border-slate-200 hover:border-blue-300 shadow-xs hover:shadow-md transition-all flex flex-col justify-between"
                        data-name="{{ strtolower($app['name']) }}"
                        data-short="{{ strtolower($app['short_name']) }}"
                        data-desc="{{ strtolower($app['description']) }}"
                        data-category="{{ $app['category_slug'] }}"
                        data-tags="{{ strtolower(implode(' ', $app['tags'])) }}"
                    >
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-[#1e293b] text-amber-400 p-2.5 flex items-center justify-center shrink-0">
                                    @if ($app['icon_svg'] === 'academic-cap')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6"/></svg>
                                    @elseif ($app['icon_svg'] === 'document-text')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    @elseif ($app['icon_svg'] === 'laptop')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @elseif ($app['icon_svg'] === 'book-open')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    @elseif ($app['icon_svg'] === 'user-plus')
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                    @elseif ($app['icon_svg'] === 'user-group')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    @elseif ($app['icon_svg'] === 'chart-bar')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2M7 19h10a2 2 0 002-2v-7H7v7zM15 7a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    @elseif ($app['icon_svg'] === 'information-circle')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @elseif ($app['icon_svg'] === 'envelope')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @elseif ($app['icon_svg'] === 'light-bulb')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.496 1.508 1.333 1.508 2.316v.192m4.5 0-4.5 0"/></svg>
                                    @elseif ($app['icon_svg'] === 'folder-open')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2l-2 4H5z"/></svg>
                                    @elseif ($app['icon_svg'] === 'chat-bubble-left-right')
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                </div>

                            </div>

                            <span class="text-xs font-bold uppercase tracking-wider text-blue-900">{{ $app['category'] }}</span>
                            <h3 class="text-lg font-bold font-heading text-slate-900 mt-0.5">
                                {{ $app['name'] }}
                            </h3>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                                {{ $app['description'] }}
                            </p>

                            <div class="flex flex-wrap gap-1.5 mt-4">
                                @foreach ($app['tags'] as $tag)
                                    <span class="text-[10px] font-semibold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[11px] font-medium text-slate-500 truncate max-w-[140px]">
                                {{ $app['badge'] }}
                            </span>

                            <div class="flex items-center gap-2">
                                <button 
                                    onclick="copyToClipboard('{{ $app['url'] }}')"
                                    class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-100 transition-colors"
                                    title="Salin Tautan Aplikasi"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </button>

                                <a 
                                    href="{{ $app['url'] }}" 
                                    target="_blank" 
                                    rel="noopener font-medium" 
                                    class="px-3.5 py-1.5 rounded-lg bg-blue-900 hover:bg-blue-800 text-white text-xs font-bold flex items-center gap-1 transition-all shadow-xs"
                                >
                                    <span>Kunjungi</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty Search State -->
            <div id="noResultsState" class="hidden text-center py-12 bg-white rounded-2xl border border-slate-200 mt-6">
                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400 mb-3">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 font-heading">Aplikasi Tidak Ditemukan</h3>
                <p class="text-xs text-slate-500 mt-1">Coba gunakan kata kunci pencarian yang berbeda.</p>
                <button onclick="clearSearch()" class="mt-4 px-4 py-2 bg-blue-900 text-white text-xs font-bold rounded-lg hover:bg-blue-800 transition-all">
                    Tampilkan Semua Aplikasi
                </button>
            </div>

        </section>
      
        <!-- TOAST NOTIFICATION -->
        <div id="toast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
            <div class="bg-blue-950 text-white px-4 py-3 rounded-xl border border-amber-400/40 shadow-xl flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                <span id="toastMessage" class="text-xs font-semibold">Tautan berhasil disalin!</span>
            </div>
        </div>

        <script>
            let currentCategory = 'semua';

            function filterApps() {
                const query = document.getElementById('appSearchInput').value.toLowerCase().trim();
                const clearBtn = document.getElementById('clearSearchBtn');
                const cards = document.querySelectorAll('.app-card');
                const noResults = document.getElementById('noResultsState');

                if (query.length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                }

                let visibleCount = 0;

                cards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    const shortName = card.getAttribute('data-short');
                    const desc = card.getAttribute('data-desc');
                    const cat = card.getAttribute('data-category');
                    const tags = card.getAttribute('data-tags');

                    const matchesCategory = (currentCategory === 'semua') || (cat === currentCategory);
                    const matchesSearch = !query || 
                        name.includes(query) || 
                        shortName.includes(query) || 
                        desc.includes(query) || 
                        tags.includes(query);

                    if (matchesCategory && matchesSearch) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }

            function selectCategory(categorySlug) {
                currentCategory = categorySlug;
                
                const buttons = document.querySelectorAll('.category-btn');
                buttons.forEach(btn => {
                    const slug = btn.getAttribute('data-category');
                    if (slug === categorySlug) {
                        btn.className = "category-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all border flex items-center gap-2 bg-blue-900 text-white border-blue-900 shadow-sm";
                    } else {
                        btn.className = "category-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all border flex items-center gap-2 bg-white text-slate-600 border-slate-200 hover:bg-slate-100 hover:text-slate-900";
                    }
                });

                filterApps();
            }

            function clearSearch() {
                document.getElementById('appSearchInput').value = '';
                selectCategory('semua');
            }

            function copyToClipboard(url) {
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(url).then(() => {
                        showToast('Tautan ' + url + ' berhasil disalin!');
                    }).catch(() => {
                        showToast('Gagal menyalin tautan');
                    });
                } else {
                    // Fallback untuk HTTP (non-HTTPS)
                    const textArea = document.createElement("textarea");
                    textArea.value = url;
                    textArea.style.position = "fixed";
                    textArea.style.left = "-999999px";
                    textArea.style.top = "-999999px";
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();
                    try {
                        document.execCommand('copy');
                        showToast('Tautan ' + url + ' berhasil disalin!');
                    } catch (error) {
                        showToast('Gagal menyalin tautan');
                    }
                    textArea.remove();
                }
            }

            function showToast(message) {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toastMessage');
                toastMessage.textContent = message;
                
                toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
                
                setTimeout(() => {
                    toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
                }, 3000);
            }
        </script>
    </body>
</html>
