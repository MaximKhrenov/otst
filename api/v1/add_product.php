<?
    require_once('common.php');

    check_req(['name', 'descript', 'stock']);
     
    q("INSERT INTO Product (name, descript, stock) VALUES ('$request[name]', '$request[descript]', '$request[stock]')");
   
    $id = mysqli_fetch_row(mysqli_query($conn ,"SELECT id_prod FROM Product WHERE name = '$request[name]' AND descript = '$request[descript]' AND stock = '$request[stock]' LIMIT 1"))[0];

    foreach($request['img'] as $img)
        q("INSERT INTO Prod_img (img_name, id_prod) VALUES ('$img[name]', $id)");
    
    foreach($request['price'] as $price)
        q("INSERT INTO Prod_price (descript, price, id_prod) VALUES ('$price[descript]', $price[price], $id)")

    
?>