<!DOCTYPE HTML>
	<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<title>Dodaj produkt • Bumex | Machines with passion</title>
		<link rel="shortcut icon" href="https://bumex.pl/images/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="https://bumex.pl/style.css" type="text/css">
		<script type='text/javascript' src='https://bumex.pl/jquery-3.6.0.min.js'></script>
		<script type='text/javascript' src='ckeditor/ckeditor.js'></script>
		<script src="https://kit.fontawesome.com/73efc6168d.js" crossorigin="anonymous"></script>
		</head>
	<body onload="checkboxtab()">
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
						if(isset($_REQUEST['product-name']))
						{
							foreach($_FILES['product-image']['tmp_name'] as $key => $val)
							{
								$name = $_FILES['product-image']['tmp_name'][$key];

								$type = mime_content_type($name);
								if(($type == 'image/png') || ($type == 'image/jpeg'))
								{
									$product = $_REQUEST['product-name'];
									$check = $_REQUEST['tabelka'];
									$tab = $_REQUEST['tab'];
									$check = htmlentities($check, ENT_QUOTES, "UTF-8");
									$category_id = $_REQUEST['kategorie'];
									$descrpit = $_REQUEST['opis'];
									$target_dir = "img/";
									$filename = $_FILES['product-image']['name'][$key];
									$name = $_FILES['product-image']['tmp_name'][$key];

									$max_resolution = 500;
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

									if($_FILES['product-image']['type'][$key]=='image/jpeg')
									{
										$source=imagecreatefromjpeg($name);
										imagecopyresized($new_image,$source,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
										$finalFilename2 = $target_dir.'resized_'.$filenameHash.'.jpg';
										imagejpeg($new_image,'../../'.$finalFilename2);
									}
									elseif($_FILES['product-image']['type'][$key]=='image/png')
									{
										$source=imagecreatefrompng($name);
										imagecopyresized($new_image,$source,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
										$finalFilename2 = $target_dir.'resized_'.$filenameHash.'.png';
										imagepng($new_image,'../../'.$finalFilename2);
									}

									$filenameArray = explode('.',$filename);
									$fileExtension = $filenameArray[count($filenameArray)-1];
									$finalFilename = $target_dir.$filenameHash.'.'.$fileExtension;
									move_uploaded_file($_FILES['product-image']['tmp_name'][$key],'../../'.$finalFilename);



									require_once('../../connect.php');

									if($check == 1)
									{
										$sql = "INSERT INTO produkty (`id`, `product`, `category_id`, `image`, `descript`, `boxcheck`, `tabelka`) VALUES (NULL, '$product', '$category_id', '../admin/$finalFilename2', '$descrpit', '$check', '$tab')";
									}
									elseif($check != 1)
									{
										$sql = "INSERT INTO produkty (`id`, `product`, `category_id`, `image`, `descript`, `boxcheck`, `tabelka`) VALUES (NULL, '$product', '$category_id', '../admin/$finalFilename2', '$descrpit', 0, 0)";
									}
										
									$sql2 = "SELECT * FROM kategorie WHERE id=$category_id";

									$db = @new mysqli($db_host, $db_login, $db_password, $db_name);

									$kat = $db->query($sql2)->fetch_assoc();
									$liczba = $kat['products']+1;

									$sql3 = "UPDATE kategorie SET products=$liczba WHERE id=$category_id";

									$db->query($sql3);

									$db->query($sql);

									echo '<div class="alert alert-success" role="alert">Produkt dodany</div>';

									$db->close();
								}
								else
								{
									echo '<div class="alert alert-danger" role="alert">Wskaż prawidłowy plik graficzny</div>';
								}
							}
						}
                    ?>

                    <div class="wstecz">
                        <a href="../index.php">< Wstecz</a>
                        <h1>Dodaj produkt</h1>
                    </div>
					<div class="productadd">
                        <div class="productbox">
                            <form href="#" method="POST" enctype="multipart/form-data">
                                <p>Podaj nazwę produktu:</p>
                                <input type="text" id="product-name" name="product-name" required>
                                <p>Wgraj zdjęcie:</p>
                                <input type="file" id="product-image" name="product-image[]" accept="image/png, image/jpeg" required multiple>
								<p>Podaj opis produktu:</p>
								<textarea name="opis" id="opis" required></textarea>
                                <p>Wybierz kategorię:</p>
								<div id="focusxd" class="selectbox">
									<select name="kategorie" onmouseover="heh()" onmouseout="heh2()">
									<?php
										require_once('../../connect.php');
										$db = @new mysqli($db_host, $db_login, $db_password, $db_name);

										$request = "SELECT * FROM kategorie";

										$result = $db->query($request);

										while($row = $result->fetch_assoc())
										{
											$nazwa = $row['category'];
											$id = $row['id'];

											echo '<option value="'.$id.'">'.$nazwa.'</option>';
										}
									?>
									</select>
								</div>
								<div class="tabelkabox">
									<input type="checkbox" name="tabelka" id="tabelka" value="1" onclick="checkboxtab()">
									<label for="tabelka">Dodaj tabelkę produktu</label>

									<textarea name="tab" id="tab"></textarea>
								</div>

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
			CKEDITOR.addCss('.cke_editable { background-color: #29292a; color: white }');

			CKEDITOR.replace('opis',
			{
				toolbar : [
					{ name: 'clipboard', items: [ 'PasteFromWord' ]},
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
					'/',
					{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
					{ name: 'links', items: [ 'Link', 'Unlink' ] },
					{ name: 'insert', items: [ 'Table', 'HorizontalRule', 'SpecialChar' ] },
					{ name: 'colors', items: [ 'TextColor' ] },
					'/',
					{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize' ] }
				]
			});

			CKEDITOR.replace('tab',
			{
				toolbar : [
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
					{ name: 'paragraph', items: [ 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
					'/',
					{ name: 'insert', items: [ 'Table' ] },
					{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
					'/',
					{ name: 'styles', items: [ 'Format' ] }
				]
			});

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

			const textarea = document.querySelector("textarea");
			textarea.addEventListener("keyup", e =>{
				textarea.style.height = "50px";
				let scHeight = e.target.scrollHeight;
				textarea.style.height = `${scHeight}px`;
			})

			function checkboxtab(){
				var tab = document.getElementById('tabelka');
				var tabelka = document.getElementById('tab');
				var cketab = document.getElementById('cke_tab');
				if (tab.checked){
					cketab.setAttribute("required", "required");
					cketab.style.display = 'block';
				}
				else
				{
					cketab.removeAttribute('required');
					cketab.style.display = 'none';
				}
			}
		</script>
		<script src="https://bumex.pl/cookies.js" charset="utf-8"></script>
	</body>
	</html>