<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recommended for You</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <meta property="og:title" content="Music Mood Playlist">
  <meta property="og:description" content="Check out these amazing songs curated just for you!">
  <meta property="og:type" content="website">
  <style>
        body {
      margin: 0;
      /* height: 100vh; */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('L6.jpg') no-repeat center center fixed;
      background-size: cover;
      color: var(--text-light);
      position: relative;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.6); 
      backdrop-filter: blur(8px); 
      z-index: 0;
    }
  </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col items-center p-8">

  <div class="w-full max-w-6xl">
    <header class="text-center mb-8">
      <h1 class="text-4xl font-bold mb-2 text-cyan-400">Music Mood Magic</h1>
      <p class="text-gray-300">Discover tracks tailored to your mood and share with friends!</p>
    </header>

    <!-- Controls Section -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
      <!-- Mood Selector -->
      <div class="flex items-center">
        <select id="moodSelect" class="p-3 rounded-l bg-gray-800 text-white border-r border-gray-700">
          <option value="happy">😊 Happy</option>
          <option value="sad">😢 Sad</option>
          <option value="chill">🧘 Chill</option>
          <option value="party">🎉 Party</option>
        </select>
        <button id="loadBtn" class="p-3 bg-cyan-500 hover:bg-cyan-600 rounded-r flex items-center gap-2">
          <i class="fas fa-random"></i> Shuffle
        </button>
      </div>

      <!-- Search Bar -->
      <div class="flex items-center">
        <input id="searchBar" type="text" placeholder="Search for songs..." 
               class="p-3 rounded-l bg-gray-800 text-white w-64 border-r border-gray-700" />
        <button id="searchBtn" class="p-3 bg-blue-500 hover:bg-blue-600 rounded-r flex items-center gap-2">
          <i class="fas fa-search"></i> Search
        </button>
      </div>
    </div>

    <!-- Playlist Info and Share Controls -->
    <div id="playlistInfo" class="hidden bg-gray-800 rounded-lg p-4 mb-6 shadow-lg">
      <div class="flex justify-between items-center">
        <div>
          <h2 id="playlistTitle" class="text-2xl font-bold text-cyan-400"></h2>
          <p id="playlistCount" class="text-gray-400"></p>
        </div>
        <div class="flex gap-3">
          <button id="copyLinkBtn" class="p-2 bg-gray-700 hover:bg-gray-600 rounded-full" 
                  title="Copy playlist link">
            <i class="fas fa-link"></i>
          </button>
          <button id="shareFbBtn" class="p-2 bg-blue-600 hover:bg-blue-700 rounded-full" 
                  title="Share to Facebook">
            <i class="fab fa-facebook-f"></i>
          </button>
          <button id="shareTwBtn" class="p-2 bg-blue-400 hover:bg-blue-500 rounded-full" 
                  title="Share to Twitter">
            <i class="fab fa-twitter"></i>
          </button>
          <button id="shareWaBtn" class="p-2 bg-green-500 hover:bg-green-600 rounded-full" 
                  title="Share to WhatsApp">
            <i class="fab fa-whatsapp"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Recommended Songs Grid -->
    <div id="recommendGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
      <!-- Loading placeholder -->
      <div id="loadingPlaceholder" class="hidden col-span-3 text-center py-12">
        <i class="fas fa-spinner fa-spin text-4xl text-cyan-400 mb-4"></i>
        <p class="text-gray-400">Loading your recommendations...</p>
      </div>
    </div>

    <!-- Empty state -->
    <div id="emptyState" class="hidden col-span-3 text-center py-12">
      <i class="fas fa-music text-4xl text-gray-600 mb-4"></i>
      <p class="text-gray-400">Select a mood or search for songs to get recommendations</p>
    </div>
  </div>

  <script>
    // DOM Elements
    const loadBtn = document.getElementById('loadBtn');
    const recommendGrid = document.getElementById('recommendGrid');
    const moodSelect = document.getElementById('moodSelect');
    const searchBar = document.getElementById('searchBar');
    const searchBtn = document.getElementById('searchBtn');
    const playlistInfo = document.getElementById('playlistInfo');
    const playlistTitle = document.getElementById('playlistTitle');
    const playlistCount = document.getElementById('playlistCount');
    const copyLinkBtn = document.getElementById('copyLinkBtn');
    const shareFbBtn = document.getElementById('shareFbBtn');
    const shareTwBtn = document.getElementById('shareTwBtn');
    const shareWaBtn = document.getElementById('shareWaBtn');
    const loadingPlaceholder = document.getElementById('loadingPlaceholder');
    const emptyState = document.getElementById('emptyState');

    // Current playlist data
    let currentPlaylist = {
      title: '',
      songs: [],
      query: ''
    };

    // Show empty state initially
    emptyState.classList.remove('hidden');

    // Function to show loading state
    function showLoading() {
      loadingPlaceholder.classList.remove('hidden');
      recommendGrid.innerHTML = '';
      emptyState.classList.add('hidden');
    }

    // Function to hide loading state
    function hideLoading() {
      loadingPlaceholder.classList.add('hidden');
    }

    // Function to update playlist info
    function updatePlaylistInfo(title, count, query) {
      currentPlaylist = {
        title,
        songs: [],
        query
      };
      
      playlistTitle.textContent = title;
      playlistCount.textContent = `${count} ${count === 1 ? 'song' : 'songs'}`;
      playlistInfo.classList.remove('hidden');
      
      // Update meta tags for sharing
      document.querySelector('meta[property="og:title"]').content = title;
      document.querySelector('meta[property="og:description"]').content = 
        `Check out this ${title} playlist with ${count} amazing songs!`;
    }

    // Function to generate shareable URL
    function generateShareUrl() {
      return `${window.location.origin}${window.location.pathname}?${currentPlaylist.query}`;
    }

    // Function to fetch songs
    function fetchSongs(query) {
      showLoading();
      
      fetch(`rec.php?${query}`)
        .then(response => response.json())
        .then(data => {
          hideLoading();
          
          if (data.error) {
            recommendGrid.innerHTML = `<p class="text-red-500 col-span-3 text-center">${data.error}</p>`;
            playlistInfo.classList.add('hidden');
            return;
          }
          
          const songs = data.songs || [];
          currentPlaylist.songs = songs;
          
          if (songs.length === 0) {
            recommendGrid.innerHTML = `<p class="text-gray-400 col-span-3 text-center">No songs found.</p>`;
            playlistInfo.classList.add('hidden');
            emptyState.classList.remove('hidden');
            return;
          }
          
          emptyState.classList.add('hidden');
          
          // Set playlist title based on query
          let title = '';
          if (query.includes('mood=')) {
            const mood = query.split('=')[1];
            title = `${mood.charAt(0).toUpperCase() + mood.slice(1)} Mood Playlist`;
          } else if (query.includes('search=')) {
            const searchTerm = query.split('=')[1];
            title = `Search Results for "${decodeURIComponent(searchTerm)}"`;
          }
          
          updatePlaylistInfo(title, songs.length, query);
          
          // Render songs
          recommendGrid.innerHTML = '';
          songs.forEach(song => {
            const card = document.createElement('div');
            card.className = "bg-gray-800 rounded-lg p-4 shadow-lg hover:scale-[1.02] transition";
            card.innerHTML = `
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h3 class="text-xl font-semibold">${song.title}</h3>
                  <p class="text-gray-400">${song.artist}</p>
                </div>
                <span class="bg-cyan-500/20 text-cyan-300 px-2 py-1 rounded-full text-xs">
                  ${song.mood || 'Various'}
                </span>
              </div>
              <audio controls class="w-full mt-2">
                <source src="${song.filepath}" type="audio/mpeg">
                Your browser does not support the audio element.
              </audio>
              <div class="flex justify-end mt-3 gap-2">
                <button class="p-1 text-gray-400 hover:text-cyan-400 share-song" 
                        data-title="${song.title}" data-artist="${song.artist}" data-url="${song.filepath}">
                  <i class="fas fa-share-alt"></i>
                </button>
              </div>
            `;
            recommendGrid.appendChild(card);
          });
          
          // Add event listeners to song share buttons
          document.querySelectorAll('.share-song').forEach(btn => {
            btn.addEventListener('click', (e) => {
              const title = btn.dataset.title;
              const artist = btn.dataset.artist;
              const url = btn.dataset.url;
              shareSong(title, artist, url);
            });
          });
        })
        .catch(error => {
          hideLoading();
          recommendGrid.innerHTML = `<p class="text-red-500 col-span-3 text-center">Error loading songs.</p>`;
          console.error(error);
        });
    }

    // Function to share individual song
    function shareSong(title, artist, url) {
      const text = `Check out "${title}" by ${artist}`;
      const shareUrl = `${window.location.origin}${window.location.pathname}?song=${encodeURIComponent(title)}`;
      
      if (navigator.share) {
        navigator.share({
          title: `${title} - ${artist}`,
          text: text,
          url: shareUrl
        }).catch(err => {
          console.log('Error sharing:', err);
          fallbackShare(shareUrl, text);
        });
      } else {
        fallbackShare(shareUrl, text);
      }
    }

    // Fallback for browsers without Web Share API
    function fallbackShare(url, text) {
      const input = document.createElement('input');
      input.value = `${text}\n\n${url}`;
      document.body.appendChild(input);
      input.select();
      document.execCommand('copy');
      document.body.removeChild(input);
      
      alert('Link copied to clipboard!');
    }

    // Mood selection handler
    loadBtn.addEventListener('click', () => {
      const mood = moodSelect.value;
      fetchSongs(`mood=${mood}`);
    });

    // Search button handler
    searchBtn.addEventListener('click', () => {
      const query = searchBar.value.trim();
      if (query) {
        fetchSongs(`search=${encodeURIComponent(query)}`);
      } else {
        recommendGrid.innerHTML = `<p class="text-gray-400 col-span-3 text-center">Please enter a search query.</p>`;
      }
    });

    // Enter key in search bar
    searchBar.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        searchBtn.click();
      }
    });

    // Share buttons
    copyLinkBtn.addEventListener('click', () => {
      const url = generateShareUrl();
      navigator.clipboard.writeText(url)
        .then(() => {
          const originalIcon = copyLinkBtn.innerHTML;
          copyLinkBtn.innerHTML = '<i class="fas fa-check"></i>';
          setTimeout(() => {
            copyLinkBtn.innerHTML = originalIcon;
          }, 2000);
        })
        .catch(err => {
          console.error('Failed to copy:', err);
        });
    });

    shareFbBtn.addEventListener('click', () => {
      const url = encodeURIComponent(generateShareUrl());
      window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
    });

    shareTwBtn.addEventListener('click', () => {
      const url = encodeURIComponent(generateShareUrl());
      const text = encodeURIComponent(`Check out my "${currentPlaylist.title}" playlist!`);
      window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
    });

    shareWaBtn.addEventListener('click', () => {
      const url = encodeURIComponent(generateShareUrl());
      const text = encodeURIComponent(`Check out my "${currentPlaylist.title}" playlist: ${url}`);
      window.open(`https://wa.me/?text=${text}`, '_blank');
    });

    // Check for URL parameters on load
    window.addEventListener('DOMContentLoaded', () => {
      const params = new URLSearchParams(window.location.search);
      
      if (params.has('mood')) {
        const mood = params.get('mood');
        moodSelect.value = mood;
        fetchSongs(`mood=${mood}`);
      } else if (params.has('search')) {
        const search = params.get('search');
        searchBar.value = search;
        fetchSongs(`search=${encodeURIComponent(search)}`);
      }
    });
  </script>
</body>
</html>