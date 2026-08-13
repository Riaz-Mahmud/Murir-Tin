<!DOCTYPE html>
<html lang="en" class="dark">
@php
    // Dynamically read MP3 files from the songs folder
    $songFiles = glob(public_path('assets/audio/songs/*.mp3'));
    $dynamicPlaylist = [];
    
    if ($songFiles) {
        shuffle($songFiles); // Randomize the playlist sequence on every page load
        
        foreach($songFiles as $file) {
            $filename = basename($file);
            $rawTitle = pathinfo($filename, PATHINFO_FILENAME);
            
            // Try to make the filename look pretty for the UI
            $cleanTitle = ucwords(str_replace(['-', '_'], ' ', $rawTitle));
            
            $dynamicPlaylist[] = [
                'title' => $cleanTitle,
                'artist' => 'Local Audio', // Can't easily read ID3 tags without a library, so we use a fallback
                'file' => '/stream-audio/' . $filename,
                'cover' => 'https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?q=80&w=200&auto=format&fit=crop' // Default vinyl cover
            ];
        }
    }
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Murir Tin | A Rainy Ride Home</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Space Mono', monospace; }
        
        .grain-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/7/76/1k_Dissolve_Noise_Texture.png');
            opacity: 0.05;
            pointer-events: none;
            z-index: 50;
            mix-blend-mode: multiply;
        }

        /* Ambient Rain/Bus BG */
        .hero-bg-container {
            position: fixed;
            inset: 0;
            z-index: -10;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute;
            top: -10%; left: -10%; width: 120%; height: 120%;
            background: linear-gradient(to bottom, rgba(9, 9, 11, 0.4), rgba(9, 9, 11, 0.8)), 
                        url('/assets/images/bus-bg.png') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>
<body class="min-h-full flex flex-col bg-zinc-950 text-slate-300 selection:bg-emerald-900 selection:text-emerald-100">
    
    <main class="relative flex min-h-dvh flex-1 flex-col items-center justify-between overflow-hidden">
        <!-- 1. The Zooming Parallax Background -->
        <div class="hero-bg-container">
            <div class="hero-bg animate-zoom"></div>
        </div>
        
        <!-- 2. The Grain & Heavy High-Speed Rain Overlays -->
        <div class="grain-overlay"></div>
        <div class="rain-overlay"></div>

        <!-- 3. The Bumpy Ride Content Wrapper (simulates sitting inside the bumpy bus) -->
        <div class="animate-bump w-full h-full flex flex-col items-center justify-between flex-1 z-20">

            <!-- Background Ambient Element -->
            <audio id="ambient-audio" loop preload="auto">
                <source src="/assets/audio/murir-tin-rain.mp3" type="audio/mpeg">
            </audio>



        <!-- Center Logo -->
        <div class="mt-[15vh] flex flex-col items-center px-6">
            <h1 class="text-6xl md:text-8xl font-bold tracking-tighter text-white drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)]" style="font-family: sans-serif;">
                মুড়ির টিন
            </h1>
            <p class="text-white/70 mt-4 text-sm md:text-base tracking-widest uppercase">Bangla Rock & Rain</p>
        </div>

        <!-- Ambiance Toggle & Player Wrapper -->
        <div class="mb-[8vh] flex flex-col w-full items-center justify-center px-6 z-20 gap-4">
            
            <!-- Ambiance Toggle Pill -->
            <div class="flex items-center justify-between px-4 py-2 rounded-full bg-black/60 backdrop-blur-xl border border-white/5 shadow-lg w-full max-w-[300px]">
                <div class="flex items-center gap-2">
                    <span class="text-sm">🌧️</span>
                    <span class="text-[12px] text-white/90 font-medium tracking-wide">Bus Ambiance</span>
                </div>
                <label for="ambient-toggle" class="relative inline-flex items-center cursor-pointer mr-1">
                    <input type="checkbox" id="ambient-toggle" class="sr-only peer">
                    <div class="w-9 h-5 bg-zinc-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-zinc-300 after:border-gray-300 after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500 shadow-inner border border-black/50"></div>
                </label>
            </div>

            <!-- The Saloon Style Horizontal Player Pill -->
            <div class="w-full max-w-[700px] flex items-center gap-4 rounded-full p-3 pr-6 bg-gradient-to-r from-[#944436]/90 to-[#663b33]/90 backdrop-blur-2xl border border-white/20 shadow-[0_12px_40px_rgba(0,0,0,0.6)] font-sans">
                
                <!-- Vinyl Art -->
                <div class="relative h-16 w-16 md:h-16 md:w-16 shrink-0 ml-1">
                    <div id="album-art" class="h-full w-full overflow-hidden rounded-full shadow-lg ring-1 ring-black/40" style="animation: spin 4s linear infinite; animation-play-state: paused;">
                        <img src="https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?q=80&w=200&auto=format&fit=crop" class="h-full w-full object-cover"/>
                    </div>
                    <!-- Center Hole -->
                    <div class="pointer-events-none absolute left-1/2 top-1/2 h-3 w-3 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#111] ring-1 ring-white/10 shadow-inner"></div>
                </div>

                <!-- Song Info -->
                <div class="flex-1 min-w-0 flex flex-col justify-center mt-1">
                    <p id="track-title" class="truncate text-[16px] font-bold text-white drop-shadow-md leading-tight tracking-wide">Mujhse Mohabbat Ka Izhaar Karta</p>
                    <p id="track-artist" class="truncate text-[13px] text-white/80 mb-2 font-medium">Satrang Music Official</p>
                    
                    <!-- Seek bar -->
                    <div id="progress-container" class="group/bar relative h-1.5 w-full cursor-pointer rounded-full bg-white/20 shadow-inner">
                        <div id="progress-bar" class="absolute left-0 top-0 h-full rounded-full bg-white/90" style="width: 0%"></div>
                        <!-- Thumb -->
                        <div id="progress-thumb" class="absolute top-1/2 h-3 w-3 -translate-y-1/2 rounded-full bg-white shadow opacity-0 group-hover/bar:opacity-100 transition-opacity" style="left: 0%; transform: translate(-50%, -50%);"></div>
                    </div>
                    
                    <div class="mt-1.5 text-[10.5px] text-white/70 tracking-widest font-medium">
                        <span id="time-current">0:00</span> / <span id="time-total">0:00</span>
                    </div>
                </div>

                <!-- Controls -->
                <div class="flex items-center gap-4 shrink-0 ml-4 mr-2">
                    <button id="btn-prev" class="text-white/80 hover:text-white transition active:scale-90">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"></path></svg>
                    </button>
                    
                    <button id="btn-play" class="flex items-center justify-center h-12 w-12 rounded-full bg-white text-black shadow-xl hover:scale-105 active:scale-95 transition-transform">
                        <svg id="icon-play" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="ml-1"><path d="M8 5v14l11-7z"></path></svg>
                        <svg id="icon-pause" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="hidden"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"></path></svg>
                    </button>
                    
                    <button id="btn-next" class="text-white/80 hover:text-white transition active:scale-90">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 6h2v12h-2zm-2 6L5.5 6v12z"></path></svg>
                    </button>
                </div>

            </div>
            
            <!-- Hidden Audio Elements -->
            <audio id="music-audio" preload="auto">
                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
            </audio>
        </div> <!-- End Wrapper -->
    </main>

    <!-- Pass the dynamic PHP array to JavaScript -->
    <script>
        window.DYNAMIC_PLAYLIST = @json($dynamicPlaylist);
    </script>
    <script src="/assets/js/engine.js"></script>
</body>
</html>
