<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro ML Player Portfolio</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- Swiper CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&display=swap');

        body {
            font-family: 'Rajdhani', sans-serif;
            background: #0F172A;
        }

        .hero-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('https://via.placeholder.com/1920x1080') center/cover;
            position: relative;
            overflow: hidden;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, #6D28D9 0%, #4C1D95 100%);
            opacity: 0.3;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .glow-effect {
            position: relative;
        }

        .glow-effect::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #6D28D9, #4C1D95);
            border-radius: inherit;
            z-index: -1;
            animation: glow 2s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.1);
        }

        .hero-card {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .hero-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, #6D28D9 0%, transparent 100%);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .hero-card:hover::after {
            opacity: 0.3;
        }

        .match-history-item {
            transition: all 0.3s ease;
        }

        .match-history-item:hover {
            transform: scale(1.02);
        }

        .gradient-text {
            background: linear-gradient(45deg, #6D28D9, #9333EA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="bg-[#0F172A] text-white">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 backdrop-blur-lg bg-black/30 border-b border-white/10">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="#" class="text-2xl font-bold gradient-text">MLPRO</a>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="hover:text-purple-500 transition font-medium">Home</a>
                    <a href="#stats" class="hover:text-purple-500 transition font-medium">Stats</a>
                    <a href="#heroes" class="hover:text-purple-500 transition font-medium">Heroes</a>
                    <a href="#streams" class="hover:text-purple-500 transition font-medium">Streams</a>
                    <a href="#matches" class="hover:text-purple-500 transition font-medium">Matches</a>
                </div>
                <button class="glow-effect bg-purple-700 px-6 py-2 rounded-full text-sm font-bold hover:bg-purple-600 transition">
                    Connect
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-bg min-h-screen flex items-center">
        <div class="container mx-auto px-4 hero-content">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h1 class="text-6xl md:text-8xl font-bold mb-4 gradient-text">PRO ML PLAYER</h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8">Top Global Assassin | MPL Professional Player</p>
                    <div class="flex space-x-4">
                        <button class="glow-effect bg-purple-700 px-8 py-3 rounded-full font-bold hover:bg-purple-600 transition">
                            View Profile
                        </button>
                        <button class="border border-purple-500 px-8 py-3 rounded-full font-bold hover:bg-purple-700 transition">
                            Watch Stream
                        </button>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left">
                    <img src="https://via.placeholder.com/500x500" alt="Player Avatar" class="rounded-full w-full max-w-md mx-auto glow-effect">
                    <div class="absolute top-0 left-0 w-full h-full animate-spin-slow opacity-50" style="background: conic-gradient(from 0deg, transparent, #6D28D9, transparent);">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Status Section -->
    <section class="py-10 bg-gradient-to-b from-black/50 to-transparent">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-center space-x-4" data-aos="fade-up">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-green-500 font-bold">LIVE NOW</span>
                <span class="text-gray-400">|</span>
                <span class="text-white">Playing Ranked Match with Team RRQ</span>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 gradient-text" data-aos="fade-up">PLAYER STATISTICS</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="stat-card p-8 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-5xl font-bold text-purple-500 mb-2 counter">2000+</div>
                    <p class="text-gray-400 text-lg">Total Matches</p>
                </div>
                <div class="stat-card p-8 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-5xl font-bold text-purple-500 mb-2 counter">68.5%</div>
                    <p class="text-gray-400 text-lg">Win Rate</p>
                </div>
                <div class="stat-card p-8 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-5xl font-bold text-purple-500 mb-2 counter">15</div>
                    <p class="text-gray-400 text-lg">Heroes Mastered</p>
                </div>
                <div class="stat-card p-8 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-5xl font-bold text-purple-500 mb-2 counter">50+</div>
                    <p class="text-gray-400 text-lg">Tournaments Won</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Heroes Section -->
    <section id="heroes" class="py-20 bg-black/30">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 gradient-text" data-aos="fade-up">SIGNATURE HEROES</h2>
            <div class="swiper heroSwiper">
                <div class="swiper-wrapper pb-12">
                    <!-- Hero Card 1 -->
                    <div class="swiper-slide">
                        <div class="hero-card bg-gray-800/50 rounded-2xl overflow-hidden">
                            <img src="https://via.placeholder.com/400x250" alt="Hero 1" class="w-full">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-2xl font-bold">Lancelot</h3>
                                    <span class="bg-purple-600 px-3 py-1 rounded-full text-sm">Assassin</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span>Win Rate</span>
                                        <span class="text-purple-500">90%</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-purple-500 rounded-full h-2" style="width: 90%"></div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Matches</span>
                                        <span class="text-purple-500">500+</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>MVP Rate</span>
                                        <span class="text-purple-500">60%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Card 2 -->
                    <div class="swiper-slide">
                        <div class="hero-card bg-gray-800/50 rounded-2xl overflow-hidden">
                            <img src="https://via.placeholder.com/400x250" alt="Hero 2" class="w-full">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-2xl font-bold">Fanny</h3>
                                    <span class="bg-purple-600 px-3 py-1 rounded-full text-sm">Assassin</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span>Win Rate</span>
                                        <span class="text-purple-500">85%</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-purple-500 rounded-full h-2" style="width: 85%"></div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Matches</span>
                                        <span class="text-purple-500">300+</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>MVP Rate</span>
                                        <span class="text-purple-500">55%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Card 3 -->
                    <div class="swiper-slide">
                        <div class="hero-card bg-gray-800/50 rounded-2xl overflow-hidden">
                            <img src="https://via.placeholder.com/400x250" alt="Hero 3" class="w-full">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-2xl font-bold">Ling</h3>
                                    <span class="bg-purple-600 px-3 py-1 rounded-full text-sm">Assassin</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span>Win Rate</span>
                                        <span class="text-purple-500">88%</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-purple-500 rounded-full h-2" style="width: 88%"></div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Matches</span>
                                        <span class="text-purple-500">400+</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>MVP Rate</span>
                                        <span class="text-purple-500">58%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                </div>
        </div>
    </section>

    <!-- Live Stream Section -->
    <section id="streams" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 gradient-text" data-aos="fade-up">LIVE STREAMS</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Main Stream -->
                <div class="bg-gray-800/50 rounded-2xl overflow-hidden" data-aos="fade-right">
                    <div class="relative">
                        <img src="https://via.placeholder.com/800x450" alt="Stream Preview" class="w-full">
                        <div class="absolute top-4 left-4 flex items-center space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                            <span class="text-white bg-black/50 px-2 py-1 rounded-lg text-sm">LIVE</span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <div class="bg-black/50 px-3 py-1 rounded-lg">
                                <span class="text-white">🔥 12.5K watching</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Road to Mythical Glory!</h3>
                        <p class="text-gray-400">Live ranked gameplay with team RRQ</p>
                    </div>
                </div>

                <!-- Previous Streams -->
                <div class="space-y-4" data-aos="fade-left">
                    <div class="bg-gray-800/50 rounded-xl p-4 hover:bg-gray-700/50 transition cursor-pointer">
                        <div class="flex space-x-4">
                            <img src="https://via.placeholder.com/150x150" alt="Stream Thumbnail" class="w-24 h-24 rounded-lg">
                            <div>
                                <h4 class="font-bold mb-1">MPL Season 12 Highlights</h4>
                                <p class="text-gray-400 text-sm">2 days ago • 45K views</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-800/50 rounded-xl p-4 hover:bg-gray-700/50 transition cursor-pointer">
                        <div class="flex space-x-4">
                            <img src="https://via.placeholder.com/150x150" alt="Stream Thumbnail" class="w-24 h-24 rounded-lg">
                            <div>
                                <h4 class="font-bold mb-1">Pro Tips: Assassin Guide</h4>
                                <p class="text-gray-400 text-sm">4 days ago • 32K views</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Match History Section -->
    <section id="matches" class="py-20 bg-black/30">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 gradient-text" data-aos="fade-up">RECENT MATCHES</h2>
            <div class="space-y-4">
                <!-- Match Item -->
                <div class="match-history-item bg-gray-800/50 rounded-xl p-6" data-aos="fade-up">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="https://via.placeholder.com/80x80" alt="Hero" class="w-16 h-16 rounded-lg">
                            <div>
                                <h4 class="font-bold text-xl">Victory</h4>
                                <p class="text-purple-500">Ranked Match • 12-2-8 KDA</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-400">2 hours ago</p>
                            <p class="text-green-500">MVP</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-purple-500 rounded-full h-2" style="width: 85%"></div>
                            </div>
                            <span class="text-purple-500">85% Kill Participation</span>
                        </div>
                    </div>
                </div>

                <!-- More Match Items -->
                <div class="match-history-item bg-gray-800/50 rounded-xl p-6" data-aos="fade-up">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="https://via.placeholder.com/80x80" alt="Hero" class="w-16 h-16 rounded-lg">
                            <div>
                                <h4 class="font-bold text-xl">Victory</h4>
                                <p class="text-purple-500">Tournament Match • 15-3-10 KDA</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-400">5 hours ago</p>
                            <p class="text-green-500">MVP</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-purple-500 rounded-full h-2" style="width: 90%"></div>
                            </div>
                            <span class="text-purple-500">90% Kill Participation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 gradient-text" data-aos="fade-up">UPCOMING MATCHES</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tournament Card -->
                <div class="bg-gray-800/50 rounded-2xl p-6 hover:bg-gray-700/50 transition" data-aos="fade-up">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-purple-500 font-bold">MPL Season 13</span>
                        <span class="bg-purple-600/20 text-purple-300 px-3 py-1 rounded-full text-sm">Upcoming</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">RRQ vs EVOS</h3>
                    <p class="text-gray-400 mb-4">Quarter Finals</p>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-calendar-alt text-purple-500"></i>
                        <span>Tomorrow, 19:00 WIB</span>
                    </div>
                </div>

                <!-- More Tournament Cards -->
                <div class="bg-gray-800/50 rounded-2xl p-6 hover:bg-gray-700/50 transition" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-purple-500 font-bold">MSC 2024</span>
                        <span class="bg-purple-600/20 text-purple-300 px-3 py-1 rounded-full text-sm">Upcoming</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Group Stage</h3>
                    <p class="text-gray-400 mb-4">vs ONIC PH</p>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-calendar-alt text-purple-500"></i>
                        <span>Next Week, 15:00 WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/50 border-t border-white/10 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold gradient-text mb-4">MLPRO</h3>
                    <p class="text-gray-400">Professional Mobile Legends Player & Content Creator</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-purple-500 transition">About</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Achievements</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Schedule</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Social Media</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-purple-500 transition">
                            <i class="fab fa-youtube text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-purple-500 transition">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-purple-500 transition">
                            <i class="fab fa-tiktok text-2xl"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Newsletter</h4>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="bg-gray-800 px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <button class="bg-purple-600 px-4 rounded-r-lg hover:bg-purple-700 transition">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-white/10 text-center text-gray-400">
                <p>&copy; 2024 MLPRO. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Initialize Swiper
        new Swiper('.heroSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });

        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.innerText);
            const increment = target / 100;
            let current = 0;

            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.innerText = Math.ceil(current);
                    setTimeout(updateCounter, 10);
                } else {
                    counter.innerText = target;
                }
            };

            updateCounter();
        });
    </script>
</body>
</html>