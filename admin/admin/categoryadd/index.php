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
		<title>Dodaj kategorię • Bumex | Machines with passion</title>
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
                        if(isset($_REQUEST['category-name']))
                        {
                            $name = $_FILES['category-image']['tmp_name'];

                            $type = mime_content_type($name);
                            if(($type == 'image/png') || ($type == 'image/jpeg'))
                            {
                                $category = $_REQUEST['category-name'];
                                $target_dir = "img/";
                                $filename = $_FILES['category-image']['name'];
								$name = $_FILES['category-image']['tmp_name'];

								$max_resolution = 250;
								$size = getimagesize($name);
								$original_width = $size[0];
								$original_height = $size[1];
								$ratio = $max_resolution / $original_width;
								$new_width = $max_resolution;
								$new_height = $original_height * $ratio;
								if($new_height > $max_resolution)
								{
									$ratio = $max_resolution / $original_height;
									$new_height = $max_resolution;
									$new_width = $original_width * $ratio;
								}
								$filenameHash = md5($filename.time());
								$new_image = imagecreatetruecolor($new_width,$new_height);
								imagealphablending($new_image, false);
    							imagesavealpha($new_image, true);
								$transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
								imagefilledrectangle($new_image, 0, 0, $original_width, $original_height, $transparent);

								if($_FILES['category-image']['type']=='image/jpeg')
								{
									$source=imagecreatefromjpeg($name);
									imagecopyresized($new_image,$source,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
									$finalFilename2 = $target_dir.'resized_'.$filenameHash.'.jpg';
									imagejpeg($new_image,'../../'.$finalFilename2);
								}
								elseif($_FILES['category-image']['type']=='image/png')
								{
									$source=imagecreatefrompng($name);
									imagecopyresized($new_image,$source,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
									$finalFilename2 = $target_dir.'resized_'.$filenameHash.'.png';
									imagepng($new_image,'../../'.$finalFilename2);
								}



                                $filenameArray = explode('.',$filename);
                                $fileExtension = $filenameArray[count($filenameArray)-1];
                                $finalFilename = $target_dir.$filenameHash.'.'.$fileExtension;
                                move_uploaded_file($_FILES['category-image']['tmp_name'],'../../'.$finalFilename);
								

                                require_once('../../connect.php');

                                $sql = "INSERT INTO kategorie (`id`, `image`, `category`, `products`) VALUES (NULL, '../admin/$finalFilename2', '$category', 0)";

                                $db = @new mysqli($db_host, $db_login, $db_password, $db_name);

                                $db->query($sql);

                                echo '<div class="alert alert-success" role="alert">Kategoria dodana</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">Wskaż prawidłowy plik graficzny</div>';
                            }
                        }
                    ?>

                    <div class="wstecz">
                        <a href="https://bumex.pl/admin/admin/index.php">< Wstecz</a>
                        <h1>Dodaj kategorię</h1>
                    </div>
					<div class="categoryadd">
                        <div class="categorybox">
                            <form href="#" method="POST" enctype="multipart/form-data">
                                <p>Podaj nazwę kategorii:</p>
                                <input type="text" id="category-name" name="category-name" required>
                                <p>Wgraj zdjęcie:</p>
                                <input type="file" id="category-image" name="category-image" accept="image/png, image/jpeg" required>
                                <input type="submit" value="Dodaj">
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