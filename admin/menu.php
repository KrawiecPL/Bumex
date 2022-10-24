<?php
	require_once('connect.php');
    $db = @new mysqli($db_host, $db_login, $db_password, $db_name);
	$db->set_charset('utf8');
	$request = "SELECT * FROM kategorie";
	$result = $db->query($request);

	while($row = $result->fetch_assoc())
	{
		$id = $row['id'];
		$category = $row['category'];
		$count = $row['products'];

		if($count > 0)
		{
			echo '<li><a href="https://bumex.pl/produkty/?category_id='.$id.'">'.$category.'</a>';

			if($count > 0)
			{
				echo '<ul>';

				$request2 = "SELECT * FROM produkty WHERE category_id=$id";
				$result2 = $db->query($request2);

				while($row2 = $result2->fetch_assoc())
				{
					$category_id = $row2['category_id'];
					$product = $row2['product'];
					$product_id = $row2['id'];

					if($id == $category_id)
					{
						echo '<li><a href="https://bumex.pl/produkty/?product_id='.$product_id.'">'.$product.'</a></li>';
					}
				}

				echo '</ul>';
			}
		}
	}
	$db->close();
?>