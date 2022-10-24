<?php
 ob_start();
?>

<!DOCTYPE HTML>
	<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<?php
		if ((!isset($_GET['category_id']) || empty($_GET['category_id'])) &&
		(!isset($_GET['product_id']) || empty($_GET['product_id']))){
			$title = "Produkty";
		}
		elseif(isset($_GET['category_id']))
		{
			require_once('../admin/connect.php');

			$db = @new mysqli($db_host, $db_login, $db_password, $db_name);
			$db->set_charset('utf8');

			$id = $_GET['category_id'];
			$id = htmlentities($id, ENT_QUOTES, "UTF-8");

			$request2 = "SELECT * FROM kategorie WHERE id=$id";

			$result2 = $db->query($request2);
			$row2 = $result2->fetch_assoc();
    		$kategoria = $row2['category'];
			$title = $kategoria;
		}
		elseif(isset($_GET['product_id']))
		{
			require_once('../admin/connect.php');

			$db = @new mysqli($db_host, $db_login, $db_password, $db_name);
			$db->set_charset('utf8');

			$id = $_GET['product_id'];
			$id = htmlentities($id, ENT_QUOTES, "UTF-8");

			$request2 = "SELECT * FROM produkty WHERE id=$id";

			$result2 = $db->query($request2);
			$row2 = $result2->fetch_assoc();
    		$produkt = $row2['product'];
			$title = $produkt;
		}

		echo "<title>$title • Bumex | Machines with passion</title>"
		?>
		<link rel="shortcut icon" href="https://bumex.pl/images/favicon.png" type="image/x-icon">
		<link rel="stylesheet" media="screen and (max-device-width: 980px)" href="../mobile.css" type="text/css">
        <link rel="stylesheet" media="screen and (min-device-width: 981px)" href="../style.css" type="text/css">
		<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'>
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
								<label for="btn-2" class="checkbtn-2 active-item">Produkty +</label>
                                <a href="https://bumex.pl/produkty/" class="active-item">Produkty</a>
									<ul>
										<li><a href="https://bumex.pl/budowa/" class="nowosc"><p>NOWOŚĆ! Natryskowy automat do odlakierowywania</p></a></li>
										<?php
											require_once('../admin/menu.php');
										?>
									</ul>
								</li>
								<li><a href="https://bumex.pl/szkolenia-tematyczne/">Szkolenia tematyczne</a></li>
								<li><a href="https://bumex.pl/kontakt/">Kontakt</a></li>
							</ul>
						</div>
					</div>
				</header>
                </div>
				<div id="main">
					<?php
						if ((!isset($_GET['category_id']) || empty($_GET['category_id'])) &&
						(!isset($_GET['product_id']) || empty($_GET['product_id'])))
						{
							echo '<div class="wstecz"><h1>Kategorie produktów</h1></div>';
							echo '<div id="karty">';

							require_once('../admin/connect.php');

								$db = @new mysqli($db_host, $db_login, $db_password, $db_name);
								$db->set_charset('utf8');
								$request = "SELECT * FROM kategorie ORDER BY category ASC";
								$result = $db->query($request);

								while($row = $result->fetch_assoc())
								{
									$count = $row['products'];
									if($count > 0)
									{
										$image = $row['image'];
										$category = $row['category'];
										$id = $row['id'];

										echo '
										<a href="?category_id='.$id.'"><div class="karta">
											<div class="gora">
												<img src="'.$image.'">
												<div class="rectangle">
													<div class="triangle"></div>
													<div class="string"></div>
												</div>
											</div>
											<div class="dol">
												<p>'.$category.' ('.$count.')</p>
											</div>
										</div></a>
										';
									}
								}

								$db->close();
							echo '</div>';
						}
						elseif(isset($_GET['category_id']))
						{
							require_once('category.php');
						}
						elseif(isset($_GET['product_id']))
						{
							require_once('products.php');
						}
						
				?>
				</div>
				<div id="footer">
						<div id="top-footer">
							<div class="fbpage">
								<h4>Dołącz do nas na facebooku</h4>
								<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBumex.fhu&tabs&width=268&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="268" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
							</div>
							
							<div class="fbpage">
								<h4>Znajdź nas na YouTube</h4>
								<iframe width="450" height="250" src="https://www.youtube.com/embed/wU5ARhyIZ6k"></iframe>
							</div>
							
							<div class="fbpage">
								<h4>Znajdź nas na Allegro</h4>
								<a href="https://allegro.pl/uzytkownik/Bumex_FHU"><img src="https://bumex.pl/images/home/allegro.webp"></a>
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