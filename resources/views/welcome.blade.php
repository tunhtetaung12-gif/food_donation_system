<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Share & Care - Community Donation Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 text-gray-800">
    <nav class="sticky top-0 z-50 p-6 flex justify-between items-center bg-white/80 backdrop-blur-md shadow-sm">
        <h1 class="text-2xl font-bold text-green-600 tracking-tight">Share & Care</h1>
        <div class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold hover:text-green-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 transition font-medium">Log
                        in</a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 bg-green-600 text-white rounded-full font-semibold hover:bg-green-700 transition shadow-md">Join
                        the Cause</a>
                @endauth
            @endif
        </div>
    </nav>


    <header class="relative py-24 px-6 text-center overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-6 leading-tight">
                Feeding Hope, <span class="text-green-600">Reducing Waste.</span>
            </h2>
            <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                We bridge the gap between surplus food and empty plates. List your surplus items or join as a volunteer
                today.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="px-10 py-4 bg-green-600 text-white font-bold rounded-full hover:shadow-lg transition transform hover:-translate-y-1">Get
                    Started Now</a>
                <a href="#gallery"
                    class="px-10 py-4 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-50 transition">View
                    Our Impact</a>
            </div>
        </div>
    </header>

    <div id="stats-section" class="relative pt-16 pb-24 bg-green-600 overflow-hidden">
        <div class="absolute inset-0 opacity-20"
            style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

                <div
                    class="bg-white p-5 rounded-3xl shadow-sm border border-green-400/20 flex flex-col items-center transition hover:scale-105 duration-300">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-3 text-xl">🍲</div>
                    <p class="text-2xl font-black text-gray-900">
                        <span class="stat-number" data-target="5000">0</span><span class="text-green-500">+</span>
                    </p>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mt-1">Meals</p>
                </div>

                <div
                    class="bg-white p-5 rounded-3xl shadow-sm border border-green-400/20 flex flex-col items-center transition hover:scale-105 duration-300">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-3 text-xl">🤝</div>
                    <p class="text-2xl font-black text-gray-900">
                        <span class="stat-number" data-target="120">0</span><span class="text-blue-500">+</span>
                    </p>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mt-1">Donors</p>
                </div>

                <div
                    class="bg-white p-5 rounded-3xl shadow-sm border border-green-400/20 flex flex-col items-center transition hover:scale-105 duration-300">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3 text-xl">🌱
                    </div>
                    <p class="text-2xl font-black text-gray-900">
                        <span class="stat-number" data-target="50">0</span><span class="text-orange-500">+</span>
                    </p>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mt-1">Volunteers</p>
                </div>

                <div
                    class="bg-white p-5 rounded-3xl shadow-sm border border-green-400/20 flex flex-col items-center transition hover:scale-105 duration-300">
                    <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center mb-3 text-xl">🏢
                    </div>
                    <p class="text-2xl font-black text-gray-900">
                        <span class="stat-number" data-target="10">0</span><span class="text-purple-500">+</span>
                    </p>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mt-1">Partners</p>
                </div>

            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-12 fill-white">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C58.47,105.1,123.47,101.5,182.47,88Z">
                </path>
            </svg>
        </div>
    </div>

    <script>
        const animateNumbers = () => {
            const stats = document.querySelectorAll('.stat-number');

            stats.forEach(stat => {
                const target = +stat.getAttribute('data-target');
                const duration = 2000;
                const frameDuration = 1000 / 60;
                const totalFrames = Math.round(duration / frameDuration);
                let frame = 0;

                const updateCount = () => {
                    frame++;
                    const progress = frame / totalFrames;
                    const currentCount = Math.round(target * (1 - Math.pow(1 - progress, 3)));

                    stat.innerText = currentCount.toLocaleString();

                    if (frame < totalFrames) {
                        requestAnimationFrame(updateCount);
                    } else {
                        stat.innerText = target.toLocaleString();
                    }
                };

                updateCount();
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateNumbers();
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.3
        });

        observer.observe(document.querySelector('#stats-section'));
    </script>
    <section class="bg-white py-24 px-16">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

                <div class="lg:col-span-5 space-y-8">
                    <div class="space-y-4">
                        <p class="text-green-600 font-bold uppercase tracking-[0.3em] text-xs">Our Story</p>
                        <h2 class="text-5xl font-serif text-gray-900 leading-tight">
                            A Legacy of <br>
                            <span class="italic">Shared Abundance.</span>
                        </h2>
                    </div>

                    <div class="relative group">
                        <div
                            class="absolute -inset-4 border border-gray-100 rounded-sm -z-10 transition-transform group-hover:scale-105">
                        </div>
                        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2070&auto=format&fit=crop"
                            alt="Community gathering"
                            class="w-full grayscale hover:grayscale-0 transition-all duration-700 rounded-sm shadow-2xl">
                    </div>
                </div>

                <div class="lg:col-span-7 lg:pl-12 pt-12 lg:pt-32">
                    <div class="max-w-xl space-y-8">
                        <p class="text-2xl font-serif text-gray-700 leading-relaxed italic">
                            "We believe that the surplus of the few should meet the basic necessities of the many."
                        </p>

                        <div class="space-y-6 text-gray-600 font-light leading-loose tracking-wide">
                            <p>
                                Share & Care was established on a singular, unwavering principle: hunger is not a scarcity
                                of resources, but a failure of distribution. What began as a local initiative has
                                evolved into a sophisticated network connecting surplus to necessity.
                            </p>
                            <p>
                                Through our proprietary logistics framework and a dedicated fellowship of volunteers, we
                                ensure that excess food from corporate partners and private donors is rerouted to those
                                in immediate need with dignity and efficiency.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- <section id="gallery" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-gray-900">Our Community in Action</h3>
                <div class="w-20 h-1 bg-green-500 mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group relative overflow-hidden rounded-2xl shadow-lg aspect-square">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=800"
                        alt="Feeding kids"
                        class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                        <p class="text-white font-semibold">Local Shelter Support</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-2xl shadow-lg aspect-square">
                    <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&q=80&w=800"
                        alt="Food Prep"
                        class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                        <p class="text-white font-semibold">Fresh Surplus Packaging</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-2xl shadow-lg aspect-square">
                    <img src="https://images.unsplash.com/photo-1594708767771-a7502209ff51?auto=format&fit=crop&q=80&w=800"
                        alt="Volunteer"
                        class="object-cover w-full h-full transition duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                        <p class="text-white font-semibold">Our Dedicated Volunteers</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="gallery" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-xl">
                    <p class="text-green-600 font-bold uppercase tracking-[0.3em] text-[10px] mb-4">The Archive</p>
                    <h3 class="text-5xl font-serif text-gray-900 leading-tight">
                        Our Community <br>
                        <span class="italic text-gray-400">In Action</span>
                    </h3>
                </div>
                <div class="hidden md:block w-32 h-px bg-gray-200 mb-4"></div>
            </div>

            <div class="grid grid-cols-12 gap-8">

                <div
                    class="col-span-12 md:col-span-7 group relative overflow-hidden rounded-sm aspect-[4/3] bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=1200"
                        alt="Feeding kids"
                        class="object-cover w-full h-full grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-105">

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-8">
                        <span class="text-green-400 text-[10px] font-bold uppercase tracking-widest mb-2">Social
                            Impact</span>
                        <p class="text-white font-serif text-2xl italic">Local Shelter Support</p>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-5 flex flex-col gap-8">
                    <div class="group relative overflow-hidden rounded-sm aspect-square bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&q=80&w=800"
                            alt="Food Prep"
                            class="object-cover w-full h-full grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-105">

                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <p class="text-white font-serif italic text-lg border-b border-white/40 pb-1">Surplus
                                Packaging</p>
                        </div>
                    </div>

                    <div class="p-8 border-l-2 border-green-600 bg-gray-50">
                        <p class="text-sm text-gray-500 leading-relaxed font-light italic">
                            "Documenting the tangible difference made through the collective effort of our donors and
                            volunteers."
                        </p>
                    </div>
                </div>

                <div class="col-span-12 group relative overflow-hidden rounded-sm aspect-[21/9] bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1594708767771-a7502209ff51?auto=format&fit=crop&q=80&w=1600"
                        alt="Volunteer"
                        class="object-cover w-full h-full grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-105">

                    <div
                        class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center p-12">
                        <div class="max-w-xs">
                            <p class="text-white font-serif text-3xl leading-tight">Our Dedicated <br>Fellowship</p>
                            <div class="w-12 h-px bg-green-500 mt-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-12 px-6 text-center">
        <p class="mb-4">© 2026 Share & Care System.</p>
        <div class="flex justify-center gap-6">
            <a href="#" class="hover:text-white transition">Privacy Policy</a>
            <a href="#" class="hover:text-white transition">Contact Us</a>
        </div>
    </footer>
</body>

</html>
