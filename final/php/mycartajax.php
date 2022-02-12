<?php
include_once("dbconnect.php");
session_start();

if (isset($_SESSION['sessionid'])) {
    $useremail = $_SESSION['email'];
}else{
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    return;
}
if (isset($_GET['submit'])) {
    $foodid = $_GET['id'];
    $foodprice = $_GET['price'];
    $sqlqty = "SELECT * FROM table_carts WHERE email = '$useremail' AND id = '$foodid'";
    $stmtsqlqty = $conn->prepare($sqlqty);
    $stmtsqlqty->execute();
    $resultsqlqty = $stmtsqlqty->setFetchMode(PDO::FETCH_ASSOC);
    $rowsqlqty = $stmtsqlqty->fetchAll();
    $foodcurqty = 0;
    foreach ($rowsqlqty as $food) {
        $foodcurqty = $food['cart_qty'] + $foodcurqty;
    }
    if ($_GET['submit'] == "add"){
        $cartqty = $foodcurqty + 1 ;
        $updatecart = "UPDATE `table_carts` SET `cart_qty`= '$cartqty' WHERE email = '$useremail' AND id = '$foodid'";
        $conn->exec($updatecart);
    }
    if ($_GET['submit'] == "remove"){
        if ($foodcurqty == 1){
            $updatecart = "DELETE FROM `table_carts` WHERE email = '$useremail' AND id = '$foodid'";
            $conn->exec($updatecart);
        }else{
            $cartqty = $foodcurqty - 1 ;
            $updatecart = "UPDATE `table_carts` SET `cart_qty`= '$cartqty' WHERE email = '$useremail' AND id = '$foodid'";
            $conn->exec($updatecart);    
        }
    }
}


$stmtqty = $conn->prepare("SELECT * FROM table_carts INNER JOIN table_product ON table_carts.id = table_product.id WHERE table_carts.email = '$useremail'");
$stmtqty->execute();
$rowsqty = $stmtqty->fetchAll();
$totalpayable = 0;
foreach ($rowsqty as $carts) {
   $carttotal = $carts['cart_qty'] + $carttotal;
   $foodpr = $carts['price'] * $carts['cart_qty'];
   $totalpayable = $totalpayable + $foodpr;
}

$mycart = array();
$mycart['carttotal'] =$carttotal;
$mycart['id'] =$foodid;
$mycart['qty'] =$cartqty;
$mycart['price'] = bcdiv($cartqty * $foodprice,1,2);
$mycart['totalpayable'] = bcdiv($totalpayable,1,2);


$response = array('status' => 'success', 'data' => $mycart);
sendJsonResponse($response);


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>