document.addEventListener('DOMContentLoaded', () => {
    // ---------------------------------------------------------
    // AMBIENT AUDIO LOGIC
    // ---------------------------------------------------------
    const ambientAudio = document.getElementById('ambient-audio');
    const ambientToggle = document.getElementById('ambient-toggle');
    ambientAudio.volume = 0.5;

    ambientToggle.addEventListener('change', (e) => {
        if(e.target.checked) {
            ambientAudio.play().catch(err => {
                console.error("Browser blocked autoplay:", err);
                e.target.checked = false;
            });
        } else {
            ambientAudio.pause();
        }
    });


    // ---------------------------------------------------------
    // MUSIC PLAYLIST LOGIC
    // ---------------------------------------------------------
    const musicAudio = document.getElementById('music-audio');
    const btnPlay = document.getElementById('btn-play');
    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');
    
    const iconPlay = document.getElementById('icon-play');
    const iconPause = document.getElementById('icon-pause');
    
    const albumArt = document.getElementById('album-art');
    const coverImage = albumArt.querySelector('img');
    const trackTitle = document.getElementById('track-title');
    const trackArtist = document.getElementById('track-artist');
    
    const progressBar = document.getElementById('progress-bar');
    const progressThumb = document.getElementById('progress-thumb');
    const progressContainer = document.getElementById('progress-container');
    const timeCurrent = document.getElementById('time-current');
    const timeTotal = document.getElementById('time-total');
    
    musicAudio.volume = 0.8;

    // YOUR PLAYLIST
    // We try to load the dynamic playlist provided by the server. 
    // If the folder is empty, we provide a fallback placeholder so the UI doesn't crash.
    const playlist = window.DYNAMIC_PLAYLIST && window.DYNAMIC_PLAYLIST.length > 0 
        ? window.DYNAMIC_PLAYLIST 
        : [
            {
                title: "No songs found!",
                artist: "Add MP3s to /public/assets/audio/songs/",
                file: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
                cover: "https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?q=80&w=200&auto=format&fit=crop"
            }
        ];

    let currentTrackIndex = 0;

    // Load track info into UI
    function loadTrack(index) {
        const track = playlist[index];
        musicAudio.src = track.file;
        trackTitle.innerText = track.title;
        trackArtist.innerText = track.artist;
        coverImage.src = track.cover;
        
        // Reset UI
        timeCurrent.innerText = "0:00";
        timeTotal.innerText = "0:00";
        progressBar.style.width = "0%";
        progressThumb.style.left = "0%";
    }

    // Play current track
    function playTrack() {
        musicAudio.play().then(() => {
            iconPlay.classList.add('hidden');
            iconPause.classList.remove('hidden');
            albumArt.style.animationPlayState = 'running';
        }).catch(err => {
            console.error("Playback failed", err);
        });
    }

    // Pause current track
    function pauseTrack() {
        musicAudio.pause();
        iconPlay.classList.remove('hidden');
        iconPause.classList.add('hidden');
        albumArt.style.animationPlayState = 'paused';
    }

    // Toggle Play/Pause
    btnPlay.addEventListener('click', () => {
        if (musicAudio.paused) {
            playTrack();
        } else {
            pauseTrack();
        }
    });

    // Next Track
    btnNext.addEventListener('click', () => {
        currentTrackIndex = (currentTrackIndex + 1) % playlist.length;
        loadTrack(currentTrackIndex);
        playTrack();
    });

    // Prev Track
    btnPrev.addEventListener('click', () => {
        currentTrackIndex = (currentTrackIndex - 1 + playlist.length) % playlist.length;
        loadTrack(currentTrackIndex);
        playTrack();
    });
    
    // Auto-play next track when current finishes
    musicAudio.addEventListener('ended', () => {
        btnNext.click();
    });

    // Format Time (seconds to M:SS)
    function formatTime(seconds) {
        if (isNaN(seconds)) return "0:00";
        const m = Math.floor(seconds / 60);
        const s = Math.floor(seconds % 60);
        return `${m}:${s.toString().padStart(2, '0')}`;
    }

    // Update Progress Bar
    musicAudio.addEventListener('timeupdate', () => {
        const current = musicAudio.currentTime;
        const duration = musicAudio.duration || 0;
        
        timeCurrent.innerText = formatTime(current);
        
        if (duration > 0) {
            const percent = (current / duration) * 100;
            progressBar.style.width = `${percent}%`;
            progressThumb.style.left = `${percent}%`;
        }
    });

    // Loaded Metadata (get total time)
    musicAudio.addEventListener('loadedmetadata', () => {
        timeTotal.innerText = formatTime(musicAudio.duration);
    });

    // Click to seek
    progressContainer.addEventListener('click', (e) => {
        const rect = progressContainer.getBoundingClientRect();
        const clickX = e.clientX - rect.left;
        // Clamp the percentage between 0 and 1 just to be safe
        const percent = Math.max(0, Math.min(1, clickX / rect.width));
        
        if (musicAudio.duration > 0) {
            musicAudio.currentTime = percent * musicAudio.duration;
            // If they seek, automatically ensure it starts playing
            playTrack();
        }
    });

    // Initialize first track on load
    loadTrack(currentTrackIndex);
    
    // Smart Auto-Play Handler
    const playPromise = musicAudio.play();
    if (playPromise !== undefined) {
        playPromise.then(() => {
            // Autoplay succeeded!
            iconPlay.classList.add('hidden');
            iconPause.classList.remove('hidden');
            albumArt.style.animationPlayState = 'running';
        }).catch(error => {
            // Autoplay was blocked by browser security.
            // Fallback: wait for the user's very first click anywhere on the page to start the music.
            console.log("Autoplay paused by browser. Waiting for user interaction...");
            const startOnInteraction = () => {
                if (musicAudio.paused) {
                    playTrack();
                }
                document.removeEventListener('click', startOnInteraction);
            };
            document.addEventListener('click', startOnInteraction);
        });
    }
});
