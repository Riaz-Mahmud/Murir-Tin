<div align="center">
  <img src="public/assets/images/bus-bg.png" alt="Murir Tin Banner" width="100%" style="border-radius: 12px; margin-bottom: 20px;">
  
  # 🌧️ মুড়ির টিন (Murir Tin) 
  **An Immersive Audio-Visual Experience**
  
  <p align="center">
    <a href="#about">About</a> •
    <a href="#features">Features</a> •
    <a href="#installation">Installation</a> •
    <a href="#how-to-add-music">Adding Music</a> •
    <a href="#contributing">Contributing</a>
  </p>
</div>

---

## 📖 About

**Murir Tin** is an ultra-immersive, high-vibe experiential web application designed to trigger deep Bangladeshi cultural nostalgia. It simulates a rainy evening ride on a classic local bus ("Murir Tin") accompanied by your favorite Bengali band music (James, LRB, Miles, etc.) and atmospheric monsoon sounds.

Inspired by minimalist aesthetic audio players (like `saloon.wtf`), this project features a custom-built, zero-friction UI that blends stunning CSS parallax animations with a dynamic local audio engine.

## ✨ Features

- **Immersive 2.5D Environment:** A custom CSS-driven parallax background with dynamic screen-shake (bumpy ride) and high-speed rain overlays.
- **Dynamic Playlist Engine:** No hardcoding required. The backend automatically scans the `songs/` folder and generates a dynamic playlist on every page load.
- **Zero-Friction Playback:** Smart autoplay functionality that gracefully handles browser restrictions.
- **Ambient Audio Mixing:** A dedicated, perfectly styled toggle switch to mix in heavy rain and bus engine ambiance on demand.
- **Custom Frosted-Glass UI:** A beautiful, responsive "pill" style media player built with Tailwind CSS v4.

---

## 🚀 Installation

This project is built on **Laravel 12** and **Tailwind CSS v4** (via Vite).

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/murir-tin.git
   cd murir-tin
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM dependencies:**
   ```bash
   npm install
   ```

4. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run the application:**
   You will need two terminal windows running simultaneously.
   
   *Terminal 1 (Backend):*
   ```bash
   php artisan serve
   ```
   
   *Terminal 2 (Frontend Assets):*
   ```bash
   npm run dev
   ```

6. Open your browser to `http://127.0.0.1:8000`.

---

## 🎧 How to Add Music

Adding music to the playlist is completely automated!

1. Download your favorite Bengali rock `.mp3` files.
2. Drag and drop them into the `public/assets/audio/songs/` directory.
3. Refresh the page! The backend will automatically detect the new files, format the titles, shuffle them, and inject them into the player.

*(Note: To support seamless progress-bar seeking in local development, this project streams audio through a dedicated Laravel route that handles HTTP 206 Partial Content byte-range requests).*

---

## 🤝 Contributing

Contributions make the open source community such an amazing place to learn, inspire, and create. Any contributions you make to **Murir Tin** are **greatly appreciated**!

Whether it's optimizing the CSS animations, adding volume sliders, contributing new ambient background tracks, or squashing bugs, we'd love your help.

### How to Contribute:
1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Ideas for Contributions:
- **Visuals:** More dynamic background images or day/night cycle transitions.
- **Audio:** Custom volume mixer for the rain vs music.
- **UI:** Keyboard shortcuts (Space to play/pause, arrows to seek).

---

<div align="center">
  <p>Built with ❤️ and a love for Bengali Rock.</p>
</div>
