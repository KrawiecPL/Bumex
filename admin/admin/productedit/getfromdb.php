<?php
   ob_start();
    session_start();

    if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}

	if(isset($_POST['category_id']))
	{
		$id = $_POST['category_id'];
		require_once('../../connect.php');
		$db = @new mysqli($db_host, $db_login, $db_password, $db_name);

		$request = "SELECT * FROM produkty WHERE category_id=$id";

		$result = $db->query($request);

		if($result->num_rows > 0)
		{
			echo '<option value="0" disabled selected>Wybierz produkt</option>';
			while($row = $result->fetch_assoc())
			{
				$nazwa = $row['product'];
				$id = $row['id'];

				echo '<option value="'.$id.'">'.$nazwa.'</option>';
			}
		}
		else
		{
			echo '<option value="0" disabled selected>Nie znaleziono produktów</option>';
		}
	}
?>