<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Live Genre Radio</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    .background-video {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
      filter: blur(10px);
    }
  </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center px-4 transition duration-300" id="mainBody">
  <video autoplay muted loop class="background-video">
    <source src="V3.mp4" type="video/mp4" />
  </video>
  <div class="flex flex-col justify-center items-center w-full max-w-4xl min-h-[80vh] text-center bg-gray-800 bg-opacity-90 rounded-2xl shadow-2xl p-6 space-y-6 content my-10">
    <h1 class="text-4xl font-bold text-cyan-400 animate-pulse">🎶 Genre-Based Live Radio</h1>
    <select id="genreSelect" class="p-2 rounded text-black w-full font-semibold">
      <option value="pop">🎤 Pop</option>
      <option value="rock">🎸 Rock</option>
      <option value="jazz">🎷 Jazz</option>
      <option value="classical">🎻 Classical</option>
      <option value="electronic">🎧 Electronic</option>
      <option value="news">🗞️ News</option>
    </select>
    <div id="loader" class="text-center text-lg text-yellow-300">Loading stations...</div>
    <div id="stations" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 py-4"></div>
    <div id="playerContainer" class="mt-6">
      <audio id="radioPlayer" class="w-full" controls autoplay></audio>
      <p id="nowPlaying" class="text-lg mt-2 font-medium">Now Playing: 🎧</p>
    </div>
    <label class="block font-semibold">🔊 Volume</label>
    <input type="range" id="volumeControl" min="0" max="1" step="0.01" value="1" class="w-full accent-red-500">
    <button onclick="toggleMode()" class="mt-4 bg-yellow-400 text-black hover:bg-yellow-500 px-4 py-2 rounded font-bold">
      🌗 Toggle Light/Dark Mode
    </button>
  </div>
  <script>
    lucide.createIcons();
    const genreSelect = document.getElementById('genreSelect');
    const stationsContainer = document.getElementById('stations');
    const loader = document.getElementById('loader');
    const audioPlayer = document.getElementById('radioPlayer');
    const nowPlaying = document.getElementById('nowPlaying');
    const volumeControl = document.getElementById('volumeControl');
    const body = document.getElementById('mainBody');
    const API_BASE = "https://at1.api.radio-browser.info/json";
    function fetchStationsByGenre(genre) {
      loader.style.display = 'block';
      stationsContainer.innerHTML = '';
      fetch(`${API_BASE}/stations/bytag/${genre}`)
        .then(res => res.json())
        .then(data => {
          loader.style.display = 'none';
          const stations = data.slice(0, 15);
          if (stations.length === 0) {
            stationsContainer.innerHTML = "<p class='text-red-400 col-span-full'>No stations found for this genre.</p>";
          }
          stations.forEach(station => {
            if (station.url_resolved) {
              const div = document.createElement('div');
              div.className = 'bg-white text-black rounded-lg p-4 shadow hover:shadow-xl transition';
              div.innerHTML = `
                <strong class="block font-bold mb-2">${station.name}</strong>
                <button onclick="playStation('${station.url_resolved}', '${station.name.replace(/'/g, "\\'")}')" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                  ▶ Play
                </button>
              `;
              stationsContainer.appendChild(div);
            }
          });
        })
        .catch(err => {
          loader.innerText = "⚠️ Failed to load stations.";
          console.error(err);
        });
    }
    function playStation(url, name) {
      audioPlayer.src = url;
      audioPlayer.play();
      nowPlaying.innerText = "Now Playing: " + name;
    }
    volumeControl.addEventListener('input', () => {
      audioPlayer.volume = volumeControl.value;
    });
    function toggleMode() {
      if (body.classList.contains('bg-gray-900')) {
        body.classList.replace('bg-gray-900', 'bg-white');
        body.classList.replace('text-white', 'text-black');
      } else {
        body.classList.replace('bg-white', 'bg-gray-900');
        body.classList.replace('text-black', 'text-white');
      }
    }
    window.onload = () => {
      fetchStationsByGenre(genreSelect.value);
    };
    genreSelect.addEventListener('change', () => {
      fetchStationsByGenre(genreSelect.value);
    });
  </script>
</body>
</html>
