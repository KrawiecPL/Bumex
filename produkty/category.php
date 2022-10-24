<?php

if (!isset($_GET['category_id']))
	{
		header('Location: index.php');
		exit();
	}

    require_once('../admin/connect.php');

    $db = @new mysqli($db_host, $db_login, $db_password, $db_name);
    $db->set_charset('utf8');

    $id = $_GET['category_id'];
    $id = htmlentities($id, ENT_QUOTES, "UTF-8");

    $request2 = "SELECT * FROM kategorie WHERE id=$id";

    $result2 = $db->query($request2);

    $count = $result2->num_rows;
    if($count < 1)
    {
        header('Location: index.php');
		exit();
    }

    $row2 = $result2->fetch_assoc();
    $kategoria = $row2['category'];

    echo '<div class="wstecz"><a href="index.php">< Wstecz</a><h1>'.$kategoria.'</h1></div>';
    echo '<div id="karty">';

    $request = "SELECT * FROM produkty WHERE category_id=$id";
    $result = $db->query($request);

    while($row = $result->fetch_assoc())
    {
        $title = $row['product'];
        $image = $row['image'];
        $id = $row['id'];

        echo '
        <a href="?product_id='.$id.'"><div class="karta">
                <div class="gora">
                    <img src="'.$image.'">
                    <div class="rectangle">
                        <div class="triangle"></div>
                        <div class="string"></div>
                    </div>
                </div>
                <div class="dol">
                    <p>'.$title.'</p>
                </div>
            </div></a>
            ';
    }
    $db->close();
	echo '</div>';