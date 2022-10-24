<?php
    session_start();

    if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>
	<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<title>Usuń produkt • Bumex | Machines with passion</title>
		<link rel="shortcut icon" href="https://bumex.pl/images/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="https://bumex.pl/style.css" type="text/css">
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
						<div class="menu">
							<ul>
								<li><a href="/">Strona główna</a></li>
								<li><a href="https://bumex.pl/produkty/">Produkty</a>
									<ul>
										<li><a href="https://bumex.pl/budowa/" class="nowosc"><p>NOWOŚĆ! Natryskowy automat do odlakierowywania</p></a></li>
										<?php
											require_once('../../menu.php');
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
                        if(isset($_REQUEST['produkty']))
                        {
                                $produkt = $_REQUEST['produkty'];

                                require_once('../../connect.php');

                                $sql = "SELECT * FROM produkty WHERE id=$produkt";

                                $db = @new mysqli($db_host, $db_login, $db_password, $db_name);

                                $row2 = $db->query($sql)->fetch_assoc();

                                $zdj = $row2['image'];
                                $category_id = $row2['category_id'];

                                unlink('../../'.$zdj);

                                $sql2 = "SELECT * FROM kategorie WHERE id=$category_id";
                                $rezultat = $db->query($sql2)->fetch_assoc();

                                $count = $rezultat['products'] - 1;

                                $countupdate = "UPDATE kategorie SET products=$count WHERE id=$category_id";
                                $db->query($countupdate);

                                $sql3 = "DELETE FROM produkty WHERE id=$produkt";
                                $db->query($sql3);

                                echo '<div class="alert alert-success" role="alert">Produkt został usunięty</div>';
                        }
                    ?>

                    <div class="wstecz">
                        <a href="https://bumex.pl/admin/admin/index.php">< Wstecz</a>
                        <h1>Usuń produkt</h1>
                    </div>
					<div class="productadd">
                        <div class="productbox">
                            <form href="#" method="POST" enctype="multipart/form-data">
                            <p>Wybierz produkt:</p>
							<div id="focusxd" class="selectbox">
								<select name="produkty" onmouseover="heh()" onmouseout="heh2()">
								<?php
										require_once('../../connect.php');
										$db = @new mysqli($db_host, $db_login, $db_password, $db_name);

										$request = "SELECT * FROM produkty";

										$result = $db->query($request);

										while($row = $result->fetch_assoc())
										{
											$nazwa = $row['product'];
											$id = $row['id'];

											echo '<option value="'.$id.'">'.$nazwa.'</option>';
										}
									?>
									</select>
								</div>
                                <input type="submit" value="Usuń">
                            </form>
                        </div>
                    </div>
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
			function heh() {
				var element = document.getElementById("focusxd");
				element.classList.add("kek");
			}
			function heh2() {
				var element = document.getElementById("focusxd");
				element.classList.remove("kek");
			}
		</script>
		<script src="https://bumex.pl/cookies.js" charset="utf-8"></script>
	</body>
	</html>