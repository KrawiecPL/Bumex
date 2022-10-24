<!DOCTYPE HTML>
	<html lang="pl">
	<head>
		<meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<title>Szkolenia tematyczne • Bumex | Machines with passion</title>
		<link rel="shortcut icon" href="https://bumex.pl/images/favicon.png" type="image/x-icon">
		<link rel="stylesheet" media="screen and (max-device-width: 980px)" href="../mobile.css" type="text/css">
        <link rel="stylesheet" media="screen and (min-device-width: 981px)" href="../style.css" type="text/css">
		<script type='text/javascript' src='https://bumex.pl/jquery-3.6.0.min.js'></script>
		<script src="https://kit.fontawesome.com/73efc6168d.js" crossorigin="anonymous"></script>
		</head>
	<body>
		<div id="page">
			<div id="wrapper">
                <div id="menudiv">
				<header>
					<div id="whatever">
						<a class="logo" href="/"><img src="https://bumex.pl/images/logo.png"></a>
						<label for="btn" class="icon">
								<span class="fa fa-bars"></span>
							</label>
							<input type="checkbox" id="btn">
						<div class="menu">
							<ul>
								<li><a href="/">Strona główna</a></li>
                                <li>
									<input type="checkbox" id="btn-2">
								<label for="btn-2" class="checkbtn-2">Produkty +</label>
								<a href="https://bumex.pl/produkty/">Produkty</a>
									<ul>
										<li><a href="https://bumex.pl/budowa/" class="nowosc"><p>NOWOŚĆ! Natryskowy automat do odlakierowywania</p></a></li>
										<?php
											require_once('../admin/menu.php');
										?>
									</ul>
								</li>
								<li><a href="https://bumex.pl/szkolenia-tematyczne/" class="active-item">Szkolenia tematyczne</a></li>
								<li><a href="https://bumex.pl/kontakt/">Kontakt</a></li>
							</ul>
						</div>
					</div>
        </header>
                </div>
				<div id="main">
					<div id="szkolenia">
                        <h1 class="szkolenia_mobile">Szkolenia hydrografiki</h1>
                        <div id="banner"><img src="https://bumex.pl/images/szkolenia/banner.webp"></div>
                        <div id="szkolenia-content">
                            <img src="https://bumex.pl/images/szkolenia/wozek.webp" class="zdjecie">
                            <div id="szkolenia-text">
                                <p>Dzięki współpracy z wiodącą firmą w dziedzinie hydrografiki, nasi klienci mają dostęp do szkoleń i kursów podnoszących kwalifikacje. Firma oferuje jedno- i wielodniowe szkolenia przekazując swoim słuchaczom lata zdobywanej wiedzy i praktyki w sposób w pełni profesjonalny. Zajęcia składają się również z części praktycznej, gdzie kadra wykładowców uczy technik właściwego nakładania powłok i angażuje słuchaczy do czynnego udziału.</p>
                                <h4>KONTAKT:</h4>
                                <p>
                                HYDRONAUKA<br>
                                Nowaczyk Jakub<br>
                                ul. Kusocińskiego 13<br>
                                63-200 Jarocin, Polska<br>
                                tel. 514 300 085<br>
                                </p>
                                <div id="ikony">
                                    <a href="mailto:biuro@szkolenia-hydrografika.pl"><img src="https://bumex.pl/images/szkolenia/email.png"></a>
                                    <a href="https://szkolenia-hydrografika.pl/"><img src="https://bumex.pl/images/szkolenia/www.png"></a>
                                    <a href="https://pl-pl.facebook.com/szkoleniahydrografika"><img src="https://bumex.pl/images/szkolenia/facebook.png"></a>
                                </div>
                            </div>
                            <img src="https://bumex.pl/images/szkolenia/gitara.webp" class="zdjecie">
                        </div>
                    </div>
				</div>
				<div id="footer">
						<div id="top-footer">
							<div class="fbpage fbstart">
								<h4>Dołącz do nas na facebooku</h4>
								<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBumex.fhu&tabs&width=268&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="268" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
							</div>
							
							<div class="fbpage">
								<h4>Znajdź nas na YouTube</h4>
								<iframe class="yt" src="https://www.youtube.com/embed/wU5ARhyIZ6k"></iframe>
							</div>
							
							<div class="fbpage">
								<h4>Znajdź nas na Allegro</h4>
								<a href="https://allegro.pl/uzytkownik/Bumex_FHU" target="_blank"><img src="https://bumex.pl/images/home/allegro.webp"></a>
							</div>
							<div></div>
							
							<div></div>
						</div>
						<div id="bottom-footer">
							Copyright © 2012-2021 BUMEX | All Rights Reserved | <a href="polityka-prywatnosci">Polityka prywatności</a>
						</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			window.addEventListener("scroll", function(){
				var header = document.querySelector("header");
				header.classList.toggle("sticky", window.scrollY > 0);
			})
		</script>
		<script src="https://bumex.pl/cookies.js" charset="utf-8"></script>
	</body>
	</html>