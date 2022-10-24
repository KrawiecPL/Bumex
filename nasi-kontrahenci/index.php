<!DOCTYPE HTML>
	<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<title>Nasi kontrahenci • Bumex | Machines with passion</title>
		<link rel="shortcut icon" href="https://bumex.pl/images/favicon.png" type="image/x-icon">
		<link rel="stylesheet" media="screen and (max-device-width: 980px)" href="../mobile.css" type="text/css">
		<!-- min-device-width: 1256px
		max-device-width: 1257px dla tabletów  !-->
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
								<li><a href="https://bumex.pl/szkolenia-tematyczne/">Szkolenia tematyczne</a></li>
								<li><a href="https://bumex.pl/nasi-kontrahenci/" class="active-item">Nasi kontrahenci</a></li>
								<li><a href="https://bumex.pl/kontakt/">Kontakt</a></li>
							</ul>
						</div>
					</div>
        </header>
                </div>
				<div id="main">
					<div id="kontrahenci">
                        <div class="contractors-row">
                            <img src="https://bumex.pl/images/home/7.webp">
                            <img src="https://bumex.pl/images/home/6.webp">
                            <img src="https://bumex.pl/images/home/5.webp">
                        </div>
                        <div class="contractors-row">
                            <img src="https://bumex.pl/images/home/3.webp" style="width: 264px; height: 166px;">
                            <img src="https://bumex.pl/images/home/2.webp" style="width: 150px; height: 22px;">
                            <img src="https://bumex.pl/images/home/4.webp" style="width: 264px; height: 120px;">
                            <img src="https://bumex.pl/images/home/1.webp" style="width: 264px; height: 195px;">
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