<x-base>
    <x-slot name="title">{{ $profileData['name'] }} - Developer Profile</x-slot>
    
    <x-slot name="styles">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap');
            
            .font-mono {
                font-family: 'JetBrains Mono', monospace;
            }
            
            .typewriter {
                overflow: hidden;
                border-right: .15em solid orange;
                white-space: nowrap;
                animation: typing 3.5s steps(30, end), blink-caret .5s step-end infinite;
            }
            
            @keyframes typing {
                from { width: 0 }
                to { width: 100% }
            }
            
            @keyframes blink-caret {
                from, to { border-color: transparent }
                50% { border-color: orange }
            }
            
            .gradient-text {
                background: linear-gradient(45deg, #3b82f6, #8b5cf6);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .particle-bg {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                position: relative;
                overflow: hidden;
            }
            
            .particle-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23334155' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
                opacity: 0.5;
            }
            
            .skill-bar {
                height: 8px;
                background: #1e293b;
                border-radius: 4px;
                overflow: hidden;
            }
            
            .skill-progress {
                height: 100%;
                background: linear-gradient(90deg, #3b82f6, #8b5cf6);
                border-radius: 4px;
                transition: width 2s ease-in-out;
            }
            
            .project-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .project-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            }
            
            .terminal-window {
                background: #1a1a1a;
                border-radius: 8px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            }
            
            .terminal-header {
                background: #2d2d2d;
                border-radius: 8px 8px 0 0;
                padding: 12px;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .terminal-button {
                width: 12px;
                height: 12px;
                border-radius: 50%;
            }
            
            .terminal-button.close { background: #ff5f56; }
            .terminal-button.minimize { background: #ffbd2e; }
            .terminal-button.maximize { background: #27ca3f; }
            
            .terminal-content {
                padding: 20px;
                font-family: 'JetBrains Mono', monospace;
                line-height: 1.5;
            }
            
            .typing-animation {
                border-right: 2px solid #4ade80;
                animation: blink 1s infinite;
            }
            
            @keyframes blink {
                0%, 50% { border-color: #4ade80; }
                51%, 100% { border-color: transparent; }
            }
            
            .fade-in {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }
            
            .fade-in.visible {
                opacity: 1;
                transform: translateY(0);
            }
            
            .tech-badge {
                display: inline-block;
                padding: 4px 12px;
                background: rgba(59, 130, 246, 0.1);
                border: 1px solid rgba(59, 130, 246, 0.3);
                border-radius: 16px;
                font-size: 0.875rem;
                color: #60a5fa;
                margin: 2px;
                transition: all 0.3s ease;
            }
            
            .tech-badge:hover {
                background: rgba(59, 130, 246, 0.2);
                transform: scale(1.05);
            }
            
            .smooth-scroll {
                scroll-behavior: smooth;
            }
            
            .nav-link {
                transition: color 0.3s ease;
            }
            
            .nav-link:hover {
                color: #60a5fa;
            }
            
            .nav-link.active {
                color: #3b82f6;
            }
        </style>
    </x-slot>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/90 backdrop-blur-md border-b border-slate-700">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold text-white">
                    <span class="gradient-text">{{ $profileData['name'] }}</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="nav-link text-gray-300 hover:text-blue-400">Home</a>
                    <a href="#about" class="nav-link text-gray-300 hover:text-blue-400">About</a>
                    <a href="#skills" class="nav-link text-gray-300 hover:text-blue-400">Skills</a>
                    <a href="#projects" class="nav-link text-gray-300 hover:text-blue-400">Projects</a>
                    <a href="#experience" class="nav-link text-gray-300 hover:text-blue-400">Experience</a>
                    <a href="#contact" class="nav-link text-gray-300 hover:text-blue-400">Contact</a>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-40 bg-slate-900/95 backdrop-blur-md hidden">
        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <a href="#home" class="nav-link text-2xl text-gray-300 hover:text-blue-400">Home</a>
            <a href="#about" class="nav-link text-2xl text-gray-300 hover:text-blue-400">About</a>
            <a href="#skills" class="nav-link text-2xl text-gray-300 hover:text-blue-400">Skills</a>
            <a href="#projects" class="nav-link text-2xl text-gray-300 hover:text-blue-400">Projects</a>
            <a href="#experience" class="nav-link text-2xl text-gray-300 hover:text-blue-400">Experience</a>
            <a href="#contact" class="nav-link text-2xl text-gray-300 hover:text-blue-400">Contact</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen particle-bg flex items-center justify-center relative pt-16">
        <div class="container mx-auto px-4 py-16 text-center relative z-10">
            <div class="mb-8 inline-block p-3 rounded-full bg-blue-500/20 border border-blue-500/30">
                <span class="text-sm text-blue-300 font-mono">console.log("Hello World!");</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-4">
                <span class="gradient-text typewriter">{{ $profileData['name'] }}</span>
            </h1>
            
            <h2 class="text-2xl md:text-3xl text-blue-300 mb-6">{{ $profileData['title'] }}</h2>
            
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">{{ $profileData['tagline'] }}</p>
            
            <!-- Terminal Style Info -->
            <div class="max-w-4xl mx-auto terminal-window mb-12">
                <div class="terminal-header">
                    <div class="terminal-button close"></div>
                    <div class="terminal-button minimize"></div>
                    <div class="terminal-button maximize"></div>
                    <span class="text-gray-400 text-sm ml-4">nhu@developer: ~/profile</span>
                </div>
                <div class="terminal-content text-left">
                    <div class="text-green-400 mb-2">
                        <span class="text-blue-400">$</span> whoami
                    </div>
                    <div class="text-gray-300 mb-4">
                        {{ $profileData['about']['intro'] }}
                    </div>
                    <div class="text-green-400 mb-2">
                        <span class="text-blue-400">$</span> ls -la skills/
                    </div>
                    <div class="text-gray-300 mb-4">
                        <?php foreach ($profileData['technologies'] as $category => $items): ?>
                            <div class="mb-1">
                                <span class="text-yellow-400">{{ $category }}:</span>
                                <span class="text-gray-300">{{ implode(', ', $items) }}</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-green-400 mb-2">
                        <span class="text-blue-400">$</span> echo "Let's build something amazing together!"
                    </div>
                    <div class="text-gray-300 typing-animation">
                        Let's build something amazing together!
                    </div>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="space-x-4">
                <a href="#projects" class="inline-block px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105">
                    View My Work
                </a>
                <a href="#contact" class="inline-block px-8 py-4 bg-transparent border-2 border-blue-400 hover:bg-blue-400/10 text-blue-300 font-semibold rounded-lg transition-all duration-300 hover:scale-105">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-slate-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">About Me</h2>
                <div class="w-20 h-1 bg-blue-500 mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <div class="bg-slate-900 p-8 rounded-lg border border-slate-700">
                        <h3 class="text-2xl font-semibold text-blue-400 mb-6">My Journey</h3>
                        <p class="text-gray-300 mb-6 leading-relaxed">
                            {{ $profileData['about']['intro'] }}
                        </p>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="bg-slate-800 p-4 rounded-lg">
                                <div class="text-3xl font-bold text-blue-400">{{ $profileData['about']['experience_years'] }}+</div>
                                <div class="text-gray-400 text-sm">Years Experience</div>
                            </div>
                            <div class="bg-slate-800 p-4 rounded-lg">
                                <div class="text-3xl font-bold text-green-400">{{ $profileData['about']['projects_completed'] }}+</div>
                                <div class="text-gray-400 text-sm">Projects Done</div>
                            </div>
                            <div class="bg-slate-800 p-4 rounded-lg">
                                <div class="text-3xl font-bold text-purple-400">{{ count($profileData['about']['languages_spoken']) }}</div>
                                <div class="text-gray-400 text-sm">Languages</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="fade-in">
                    <div class="bg-slate-900 p-8 rounded-lg border border-slate-700">
                        <h3 class="text-2xl font-semibold text-blue-400 mb-6">What I Do</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-2">Full-Stack Development</h4>
                                    <p class="text-gray-400">Building end-to-end web applications with modern technologies and best practices.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-2">UI/UX Design</h4>
                                    <p class="text-gray-400">Creating beautiful and intuitive user interfaces that provide excellent user experiences.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white mb-2">Performance Optimization</h4>
                                    <p class="text-gray-400">Optimizing applications for speed, scalability, and better user experience.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-slate-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Skills & Technologies</h2>
                <div class="w-20 h-1 bg-blue-500 mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
                <?php foreach ($profileData['skills'] as $category => $skills): ?>
                    <div class="bg-slate-800 p-8 rounded-lg border border-slate-700 fade-in">
                        <h3 class="text-2xl font-semibold text-white mb-6 capitalize">{{ $category }}</h3>
                        <div class="space-y-6">
                            <?php foreach ($skills as $skill => $level): ?>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-gray-300">{{ $skill }}</span>
                                        <span class="text-blue-400 font-semibold">{{ $level }}%</span>
                                    </div>
                                    <div class="skill-bar">
                                        <div class="skill-progress" style="width: {{ $level }}%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 bg-slate-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Featured Projects</h2>
                <div class="w-20 h-1 bg-blue-500 mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($profileData['projects'] as $project): ?>
                    <div class="project-card bg-slate-900 rounded-lg overflow-hidden border border-slate-700">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-white">{{ $project['title'] }}</h3>
                                <?php if ($project['featured']): ?>
                                    <span class="px-2 py-1 bg-blue-500/20 text-blue-300 text-xs rounded-full">Featured</span>
                                <?php endif; ?>
                            </div>
                            
                            <p class="text-gray-400 mb-4">{{ $project['description'] }}</p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach ($project['technologies'] as $tech): ?>
                                    <span class="tech-badge">{{ $tech }}</span>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="flex gap-4 pt-4 border-t border-slate-700">
                                <a href="{{ $project['github'] }}" target="_blank" class="flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                    Code
                                </a>
                                <a href="{{ $project['live'] }}" target="_blank" class="flex items-center text-green-400 hover:text-green-300 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Live Demo
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-slate-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Get In Touch</h2>
                <div class="w-20 h-1 bg-blue-500 mx-auto"></div>
                <p class="text-gray-400 mt-4">Let's discuss your next project or just say hello!</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div class="fade-in">
                    <div class="bg-slate-800 p-8 rounded-lg border border-slate-700">
                        <h3 class="text-2xl font-semibold text-white mb-6">Contact Information</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Email</div>
                                    <div class="text-gray-400">{{ $profileData['email'] }}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Phone</div>
                                    <div class="text-gray-400">{{ $profileData['phone'] }}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Location</div>
                                    <div class="text-gray-400">{{ $profileData['location'] }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h4 class="text-white font-semibold mb-4">Follow Me</h4>
                            <div class="flex space-x-4">
                                <a href="{{ $profileData['social']['github'] }}" target="_blank" class="w-10 h-10 bg-gray-700 hover:bg-gray-600 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </a>
                                <a href="{{ $profileData['social']['linkedin'] }}" target="_blank" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <a href="{{ $profileData['social']['twitter'] }}" target="_blank" class="w-10 h-10 bg-sky-500 hover:bg-sky-600 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="fade-in">
                    <form class="bg-slate-800 p-8 rounded-lg border border-slate-700">
                        <h3 class="text-2xl font-semibold text-white mb-6">Send Message</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-300 mb-2" for="name">Name</label>
                                <input type="text" id="name" name="name" class="w-full bg-slate-700 text-white rounded-lg p-3 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Your name">
                            </div>
                            <div>
                                <label class="block text-gray-300 mb-2" for="email">Email</label>
                                <input type="email" id="email" name="email" class="w-full bg-slate-700 text-white rounded-lg p-3 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="your@email.com">
                            </div>
                            <div>
                                <label class="block text-gray-300 mb-2" for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="w-full bg-slate-700 text-white rounded-lg p-3 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Subject">
                            </div>
                            <div>
                                <label class="block text-gray-300 mb-2" for="message">Message</label>
                                <textarea id="message" name="message" rows="5" class="w-full bg-slate-700 text-white rounded-lg p-3 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Your message..."></textarea>
                            </div>
                            <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-700 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 mb-4 md:mb-0">
                    <p>&copy; 2025 {{ $profileData['name'] }}. All rights reserved.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="{{ $profileData['social']['github'] }}" target="_blank" class="text-gray-400 hover:text-white transition-colors">GitHub</a>
                    <a href="{{ $profileData['social']['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-white transition-colors">LinkedIn</a>
                    <a href="{{ $profileData['social']['twitter'] }}" target="_blank" class="text-gray-400 hover:text-white transition-colors">Twitter</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on a link
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Active navigation link highlighting
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Typing animation for terminal
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.textContent = '';
            function type() {
                if (i < text.length) {
                    element.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing animation
        window.addEventListener('load', () => {
            const typingElement = document.querySelector('.typing-animation');
            if (typingElement) {
                const text = typingElement.textContent;
                setTimeout(() => {
                    typeWriter(typingElement, text, 50);
                }, 2000);
            }
        });

        // Animate skill bars on scroll
        const skillBars = document.querySelectorAll('.skill-progress');
        const skillObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 300);
                }
            });
        }, { threshold: 0.5 });

        skillBars.forEach(bar => {
            skillObserver.observe(bar);
        });

        // Form submission (placeholder)
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! I will get back to you soon.');
            this.reset();
        });
    </script>
</x-base>
