<?php

if (!isset($_GET['product_id']))
	{
		header('Location: index.php');
		exit();
	}

    require_once('../admin/connect.php');

    $db = @new mysqli($db_host, $db_login, $db_password, $db_name);
    $db->set_charset('utf8');

    $id = $_GET['product_id'];
    $id = htmlentities($id, ENT_QUOTES, "UTF-8");

    $request2 = "SELECT * FROM produkty WHERE id=$id";

    $result2 = $db->query($request2);

    $count = $result2->num_rows;
    if($count < 1)
    {
        header('Location: index.php');
		exit();
    }

    $row2 = $result2->fetch_assoc();
    $produkt = $row2['product'];

    $request = "SELECT * FROM produkty WHERE id=$id";
    $result = $db->query($request);

    while($row = $result->fetch_assoc())
    {
        $category_id = $row['category_id'];
    echo '<div class="wstecz"><a href="index.php?category_id='.$category_id.'">< Wstecz</a><h1>'.$produkt.'</h1></div>';
    echo '<div class="product_site">';
    }

    $request = "SELECT * FROM produkty WHERE id=$id";
    $result = $db->query($request);

    while($row = $result->fetch_assoc())
    {
        $title = $row['product'];
        $image = $row['image'];
        $description = $row['descript'];
        $checkbox = $row['boxcheck'];

        if($checkbox == 0){
            echo '
                <div class="img_desc">
                    <div class="product_img">
                        <p>
                            <img src="'.$image.'" alt="'.$title.'">
                            '.$description.'
                        </p>
                    </div>
                </div>
                ';
        }
        elseif($checkbox == 1){
            $table = $row['tabelka'];
            echo '
                <div class="img_desc">
                    <div class="prdctop">
                        <div class="prdcimg">
                                <img src="'.$image.'" alt="'.$title.'" width="500">
                        </div>
                        <div class="prdctab">
                        <h2>Tabelka</h2>
                        <p>'.$table.'</p>
                        </div>
                    </div>
                    <div class="prdcdown">
                    <p>'.$description.'</p>
                    </div>
                </div>
                ';
        }
    }
    $db->close();
	echo '</div>';