<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us | Gaana Paglu</title>
  <style>
    :root {
      --primary-color: #36e2ec;
      --text-light: #fff;
      --bg-dark: black;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('about-us-page.png') no-repeat center center fixed;
      background-size: cover;
      color: var(--text-light);
      position: relative;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.6); 
      backdrop-filter: blur(8px); 
      z-index: 0;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: -1;
    }

    nav {
      background-color: var(--bg-dark);
      padding: 12px 20px;
      display: flex;
      font-size: 1.2rem;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      padding: 25px;
      z-index: 1000;
    }

    nav a {
      color: var(--text-light);
      text-decoration: none;
      margin-left: 15px;
      font-weight: 500;
      transition: color 0.3s;
    }

    nav a:hover {
      color: var(--primary-color);
    }

    header {
      /* padding: 25px;  */
      text-align: center;
    }

    header h1 {
      font-size: 2.5rem;
      margin-bottom: 25px;
      color: var(--primary-color);
    }

    main {
      max-width: 900px;
      margin: 20px auto;
      padding: 15px;
      background-color: rgba(63, 64, 68, 0.8);
      border-radius: 15px;
    }

    section {
      margin-bottom: 25px;
    }

    h2 {
      color: var(--primary-color);
      margin-bottom: 10px;
    }

    p, ul {
      line-height: 1.6;
    }

    ul {
      padding-left: 20px;
    }

    footer {
      background-color: var(--bg-dark);
      text-align: center;
      padding: 25px;
      font-size: 1rem;
      color: #bbb;
    }

    @media (max-width: 600px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }
      nav a {
        margin: 5px 0;
      }
    }
  </style>
</head>
<body>

  <nav>
    <div>
      <a href="#mission">Mission</a>
      <a href="#offerings">Offerings</a>
      <a href="#whyus">Why Us</a>
    </div>
  </nav>

  <header>
    <h1>About Us</h1>
    <p>Welcome to Gaana Paglu – Where Music Meets the Soul</p>
  </header>

  <main>
    <section id="mission">
      <h2>Our Mission</h2>
      <p>At Gaana Paglu, we believe music is more than sound—it's a universal language that bridges hearts and cultures. Our goal is to offer a platform where every music lover feels inspired, heard, and connected.</p>
    </section>

    <section id="offerings">
      <h2>What We Offer</h2>
      <ul>
        <li>Playlists tailored to your moods and moments</li>
        <li>Learning tools for beginners and advanced artists</li>
        <li>Community forums for creators and fans alike</li>
        <li>Latest trends, reviews, and artist stories</li>
      </ul>
    </section>

    <section id="whyus">
      <h2>Why Choose Us?</h2>
      <p>We're musicians, coders, and dreamers who combine tradition and innovation. With HarmonyVerse, you get a human touch, real passion, and a love for timeless and emerging tunes alike.</p>
    </section>
  </main>

  <footer>
    &copy; 2025 Gaana Paglu. Crafted with ❤️ and music.
  </footer>

</body>
</html>
