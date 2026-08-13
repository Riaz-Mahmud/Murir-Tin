<div align="center">
  <img src="assets/images/bus-bg.png" alt="Murir Tin Banner" width="100%" style="border-radius: 12px; margin-bottom: 20px;">
  
  # 🌧️ মুড়ির টিন (Murir Tin) 
  **An Immersive Audio-Visual Experience**
  
  <p align="center">
    <a href="#about">About</a> •
    <a href="#features">Features</a> •
    <a href="#installation">Getting Started</a> •
    <a href="#how-to-add-music">Adding Music</a> •
    <a href="#contributing">Contributing</a>
  </p>
</div>

---

## 📖 About

**Murir Tin** is an ultra-immersive, high-vibe experiential web application designed to trigger deep Bangladeshi cultural nostalgia. It simulates a rainy evening ride on a classic local bus ("Murir Tin") accompanied by your favorite Bengali band music (James, LRB, Miles, etc.) and atmospheric monsoon sounds.

Inspired by minimalist aesthetic audio players (like `saloon.wtf`), this project features a custom-built, zero-friction UI that blends stunning CSS parallax animations with a dynamic local audio engine.

This is a **pure static HTML/CSS/JS version** of the project, specifically optimized for zero-cost hosting on **GitHub Pages**, Vercel, Netlify, or running locally with absolutely no setup required.

## ✨ Features

- **Immersive 2.5D Environment:** A custom CSS-driven parallax background with dynamic screen-shake (bumpy ride) and high-speed rain overlays.
- **Static Playlist Engine:** A randomized list of classic Bengali rock tracks that plays seamlessly on load.
- **Zero-Friction Playback:** Smart autoplay functionality that gracefully handles browser restrictions by waiting for the user's first interaction.
- **Ambient Audio Mixing:** A dedicated, perfectly styled toggle switch to mix in heavy rain and bus engine ambiance on demand.
- **Custom Frosted-Glass UI:** A beautiful, responsive "pill" style media player built with Tailwind CSS.

---

## 🚀 Getting Started

Since this is a static site, there are **no dependencies, no PHP, no Composer, and no NPM installs required.**

### Running Locally:
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/murir-tin.git
   cd murir-tin
   ```
2. Double-click **`index.html`** to open it in any web browser, or serve it locally using a simple VS Code extension like Live Server.

### Hosting on GitHub Pages (Free):
1. Push this repository to your GitHub.
2. Go to **Settings** > **Pages** in your repository.
3. Under **Branch**, select `main` and root `/(root)`.
4. Click **Save**—your site is now live!

---

## 🎧 How to Add Music

1. Download your favorite Bengali rock `.mp3` files.
2. Place them in the `assets/audio/songs/` directory.
3. Open `index.html` in a text editor and add your songs to the `window.DYNAMIC_PLAYLIST` array near the bottom:
   ```javascript
   window.DYNAMIC_PLAYLIST = [
       { 
           "title": "Your Song Title", 
           "artist": "Artist Name", 
           "file": "assets/audio/songs/your-song.mp3", 
           "cover": "optional-cover-image-url" 
       },
       ...
   ];
   ```

---

## 🤝 Contributing

Contributions make the open source community such an amazing place to learn, inspire, and create. Any contributions you make to **Murir Tin** are **greatly appreciated**!

### How to Contribute:
1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

<div align="center">
  <p>Built with ❤️ and a love for Bengali Rock.</p>
</div>
