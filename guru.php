<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style1.css">
    <title>Music Website</title>
    <style>
        header .song_side::before{
            background: url('arjit_bg.png');
        }
    </style>
</head>
<body style="background-image: url('L6.jpg'); background-size: cover; background-repeat: no-repeat; ">
    <header>
        <div class="menu_side">
            <h1><i class="bi bi-music-note"></i> Playlist</h1>
            <div class="playlist">
                <h4 class="active"><span></span><i class="bi bi-music-note-beamed"></i> Playlist</i></h4>
                <h4><span></span><i class="bi bi-music-note-beamed"></i><a href="sb.php" style="color: inherit; text-decoration: none;"> Pick For Yourself</a></i></h4>
                <a href="recommend.php" style="text-decoration: none;"><h4><span></span><i class="bi bi-music-note-beamed"></i>  Recommended for you</i></h4></a>
            </div>
            <div class="menu_song">
                <li class="songItem">
                    <span>01</span>
                    <img src="img/guru/1.jpeg" alt="">
                    <h5>Aise Na Chhoro <br>
                        <div class="subtitle">Guru Randhawa</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="1"></i>
                </li>
                <li class="songItem">
                    <span>02</span>
                    <img src="img/guru/2.jpeg" alt="">
                    <h5>All Right <br>
                        <div class="subtitle">Guru Randhawa</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="2"></i>
                </li>
                <li class="songItem">
                    <span>03</span>
                    <img src="img/guru/3.jpeg" alt="">
                    <h5>Alone <br>
                        <div class="subtitle">Guru Randhawa</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="3"></i>
                </li>
                <li class="songItem">
                    <span>04</span>
                    <img src="img/guru/4.jpeg" alt="">
                    <h5>Man of the Moon <br>
                        <div class="subtitle">Guru Randhawa</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="4"></i>
                </li>
                <li class="songItem">
                    <span>05</span>
                    <img src="img/guru/5.jpeg" alt="">
                    <h5>Daaru Wargi <br>
                        <div class="subtitle">Why Cheat India</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="5"></i>
                </li>
                <li class="songItem">
                    <span>06</span>
                    <img src="img/guru/6.jpeg" alt="">
                    <h5>Dance Meri Rani <br>
                        <div class="subtitle">Guru Randhawa</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="6"></i>
                </li>
                <li class="songItem">
                    <span>07</span>
                    <img src="img/guru/7.jpeg" alt="">
                    <h5>Dil Mera <br>
                        <div class="subtitle">Guru Randhawa</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="7"></i>
                </li>
                <li class="songItem">
                    <span>08</span>
                    <img src="img/guru/8.jpeg" alt="">
                    <h5>Designer <br>
                        <div class="subtitle">Guru Randhawa</div>
                    </h5>
                    <i class="bi playListPlay bi-play-circle-fill" id="8"></i>
                </li>
            </div>
        </div>

        <div class="song_side">
            <nav>
                <ul>
                    <li>Home</li>
                    <a href="radio.php" style="text-decoration: none;"><li>Radio</li></a>
                    <a href="about.php" style="text-decoration: none;"><li>About Us</li></a>
                </ul>
                <div class="search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search Music...">
                    <div class="search_results">
                    </div>
                </div>
                <div class="user">
                    <img src="img/WebLogo.jpeg" alt="">
                </div>
            </nav>
            <div class="content">
                <h1>Guru Randhawa-Downtown</h1>
                <p>Range Rover nu lain di mitraan di range aa
                Goria de layi, <br>baby, eh gal badi strange aa
                Range Rover nu lain di mitraan <br>di range aa
                Goria de layi, baby, eh gal badi strange aa
                   </p>
                <div class="buttons">
                    <button>Play</button>
                    <button>Follow</button>
                </div>
            </div>

            <div class="popular_song">
                <div class="h4">
                    <h4>Popular Song</h4>
                    <div class="btn_s">
                        <i class="bi bi-arrow-left-short" id="pop_song_left"></i>
                        <i class="bi bi-arrow-right-short" id="pop_song_right"></i>
                    </div>
                </div>
                <div class="pop_song">
                    <li class="songItem">
                        <div class="img_play">
                            <img src="img/guru/9.jpeg" alt="">
                            <i class="bi playListPlay bi-play-circle-fill" id="9"></i>
                        </div>
                        <h5>Downtown <br>
                            <div class="subtitle">Guru Randhawa</div>
                        </h5>
                    </li>
                    <li class="songItem">
                        <div class="img_play">
                            <img src="img/guru/10.jpeg" alt="">
                            <i class="bi playListPlay bi-play-circle-fill" id="10"></i>
                        </div>
                        <h5>Enni Soni Saaho <br>
                            <div class="subtitle">Guru Randhawa</div>
                        </h5>
                    </li>
                </div>
            </div>

            <div class="popular_artists">
                <div class="h4">
                    <h4>Popular Artists</h4>
                    <div class="btn_s">
                        <i class="bi bi-arrow-left-short" id="pop_art_left"></i>
                        <i class="bi bi-arrow-right-short" id="pop_art_right"></i>
                    </div>
                </div>
                <div class="item Artists_bx">
                    <li>
                        <a href=index1.php><img src="img/alan.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href=arjit.php><img src="img/arjit.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href=atif.php><img src="img/atif.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href=neha.php><img src="img/neha.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href=akhil.php><img src="img/akhil.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href=dhvani.php><img src="img/dhvani.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href=Diljit.php><img src="img/Diljit_Dosanjh.jpg" alt=""></a>
                    </li>
                    <li>
                        <img src="img/guru.jpg" alt="">
                    </li>
                    <li>
                    <a href=honey.php><img src="img/honey.jpg" alt=""></a>
                    </li>
                    <li>
                        <img src="img/jubin Nautiyal.jpg" alt="">
                    </li>
                    <li>
                        <img src="img/justin-bieber-lede.jpg" alt="">
                    </li>
                    <li>
                        <img src="img/12.jpg" alt="">
                    </li>
                </div>
            </div>
        </div>

        <div class="master_play">
            <div class="wave" id="wave">
                <div class="wave1"></div>
                <div class="wave1"></div>
                <div class="wave1"></div>
            </div>
            <img class="master_play_image"  src="img/guru/1.jpeg" alt="" id="poster_master_play">
            <h5 id="title">
            Aise Na Chhoro
                <div class="subtitle">Guru Randhawa</div>
            </h5>
            <div class="icon">
                <i class="bi shuffle bi-music-note-beamed">next</i>
                <i class="bi bi-skip-start-fill" id="back"></i>
                <i class="bi bi-play-fill" id="masterPlay"></i>
                <i class="bi bi-skip-end-fill" id="next"></i>
               <a href="" download id="download_music"><i class="bi bi-cloud-arrow-down-fill"></i></a>
            </div>
            <span id="currentStart">0:00</span>
            <div class="bar">
                <input type="range"  id="seek" min="0" max="100">
                <div class="bar2" id="bar2"></div>
                <div class="dot"></div>
            </div>
            <span id="currentEnd">0:30</span>
            <div class="vol">
                <i class="bi bi-volume-up-fill" id="vol_icon"></i>
                <input type= "range" min="0" max="100" id="vol">
                <div class="vol_bar"></div> 
                <div class="dot" id="vol_dot"></div>
            </div>
        </div>    

    </header>
    <script src="guru.js"></script> 
</body>
</html>
