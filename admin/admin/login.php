<?php
    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

    require_once('../connect.php');

    $polaczenie = @new mysqli($db_host, $db_login, $db_password, $db_name);
    if ($polaczenie->connect_errno!=0)
	{
		echo 'Błąd połączenia z bazą danych';
	}
    else
    {
        $login = $_POST['login'];
		$password = $_POST['password'];

        $passwordmd5 = md5($password);

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$passwordmd5 = htmlentities($passwordmd5, ENT_QUOTES, "UTF-8");

        if ($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM uzytkownicy WHERE login='%s' AND password='%s'",
            mysqli_real_escape_string($polaczenie,$login),
            mysqli_real_escape_string($polaczenie,$passwordmd5))))
        {
            $ilu_userow = $rezultat->num_rows;

			if($ilu_userow>0)
			{
                $_SESSION['zalogowany'] = true;

                unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: admin.php');
            }
            else
            {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
			    header('Location: index.php');
            }
        }
        $polaczenie->close();
    }

?>