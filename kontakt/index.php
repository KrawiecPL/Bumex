<?php

    session_start();

	    use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\Composer;
        
        require 'vendor/autoload.php';
		require 'vendor/phpmailer/phpmailer/src/Exception.php';
		require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
		require 'vendor/phpmailer/phpmailer/src/SMTP.php';
		
    /*if (isset($_POST['email']))
    {
        die();
    }*/

	$secret = '6LcF1fYcAAAAABDJCimJ2FgkHruYXbR6d2tbMCrV';
	$validate = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
	$answer = json_decode($validate);

	if (isset($_POST['imie']))
	{
		if($answer->success == false)
		{
			$_SESSION['e_send']="Potwierdź, że nie jesteś robotem!";
		}
		else
		{
			$email = $_POST['mail-addr'];
			$subject = $_POST['subject'];
			$name = $_POST['imie'];
			$message = $_POST['message'];

			$mail = new PHPMailer;
			// SMTP configuration
			$mail->isSMTP();
			$mail->CharSet = "UTF-8";
			$mail->Encoding = 'base64';
			$mail->Host = 'smtp.dpoczta.pl';
			$mail->SMTPAuth = true;
			$mail->Username = 'info@bumex.pl';
			$mail->Password = 'Bumeczek012';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			
			//Sending
			$mail->setFrom('info@bumex.pl', $name);
			$mail->addAddress('info@bumex.pl');
			$mail->addReplyTo($email);
			
			//Content
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = '<img src="https://bumex.pl/images/logo.png"><br><p>Wiadomość wysłana przez: <b>'.$name.'</b><br><p>Treść wiadomości:<br><b>'.$message.'</b>';
			if($mail->send())
			{
				$_SESSION['s_send']="Wiadomość została wysłana!";
			}
			else
			{
				$_SESSION['e_send']="Wiadomość nie została wysłana!";
			}
		}
	}

?>
<!DOCTYPE HTML>
	<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>Kontakt • Bumex | Machines with passion</title>
		<link rel="shortcut icon" href="https://bumex.pl/images/favicon.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		<link rel="stylesheet" media="screen and (max-device-width: 980px)" href="../mobile.css" type="text/css">
        <link rel="stylesheet" media="screen and (min-device-width: 981px)" href="../style.css" type="text/css">
		<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'>
		<script type='text/javascript' src='https://bumex.pl/jquery-3.6.0.min.js'></script>
        <script src="https://kit.fontawesome.com/73efc6168d.js" crossorigin="anonymous"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
								<li><a href="https://bumex.pl/kontakt/" class="active-item">Kontakt</a></li>
							</ul>
						</div>
					</div>
        </header>
                </div>
                <div id="main">
                    <div id="contact">
                        <h2>BUMEX POLSKA</h2>
                        <div id="contact-area">
							<div id="elements">
								<div id="contact-info">
									<div class="info-element">
										<i class="fas fa-user"></i>
										<span><p>Właściciel – Paweł Wychowaniec</p></span>
									</div>
									<div class="info-element">
										<i class="fa fa-home"></i>
										<span><p>Ul. Staszica 16, 26-120 Bliżyn, Polska</p></span>
									</div>
									<div class="info-element">
										<i class="fa fa-phone-alt"></i>
										<span><p>+48 518 511 804</p></span>
									</div>
									<div class="info-element">
										<i class="fas fa-envelope"></i>
										<span><p>info@bumex.pl</p></span>
									</div>
								</div>
								<div id="support-info">
									<div class="info-element">
										<i class="fas fa-user"></i>
											<span><p>Dział techniczny</p></span>
										</div>
									<div class="info-element">
										<i class="fa fa-phone-alt"></i>
										<span><p>+48 512 139 360</p></span>
									</div>
									<div class="info-element">
										<i class="fas fa-envelope"></i>
										<span><p>support@bumex.pl</p></span>
									</div>
								</div>
							</div>
                            <div id="contact-form">
                                <form action="" method="POST" id="kontaktform">
                                    <input type="email" name="email" hidden>
                                    <input type="text" name="imie" placeholder="Podaj swoje imię" onClick="this.placeholder=''" onBlur="this.placeholder='Podaj swoje imię'" required>
                                    <input type="email" name="mail-addr" placeholder="Podaj swój adres email" onClick="this.placeholder=''" onBlur="this.placeholder='Podaj swój adres email'" required>
                                    <input type="text" name="subject" placeholder="Podaj temat" onClick="this.placeholder=''" onBlur="this.placeholder='Podaj temat'" required>
                                    <textarea rows="8" placeholder="Wiadomość" name="message" onClick="this.placeholder=''" onBlur="this.placeholder='Wiadomość'" required></textarea>
                                    <div class="g-recaptcha" data-sitekey="6LcF1fYcAAAAAC_Xatrj3xuDXRbT23MF3V0xeb0O"></div>
									<button type="submit">Wyślij</button>
                                    
                                    <?php
                                        if(isset($_SESSION['s_send']))
                                        {
                                            echo '<div class="success">'.$_SESSION['s_send'].'</div>';
                                            unset($_SESSION['s_send']);
                                        }
										elseif(isset($_SESSION['e_send']))
                                        {
                                            echo '<div class="error">'.$_SESSION['e_send'].'</div>';
                                            unset($_SESSION['e_send']);
                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                        <div id="ramka"></div>
                    </div>
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2505.2073621212876!2d20.752767651291414!3d51.104634179470736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471837457dbd085d%3A0x24c706a5b26f1208!2sBumex%20F.H.U.%20Wychowaniec%20Pawe%C5%82!5e0!3m2!1spl!2spl!4v1618995412594!5m2!1spl!2spl" style="border:0;" allowfullscreen="" width="100%" height="415px"></iframe>
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