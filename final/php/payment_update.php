<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_GET['email'];
//$mobile = $_GET['mobile'];
$amount = $_GET['amount'];

$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];
if ($paidstatus=="true"){
    $paidstatus = "Success";
}else{
    $paidstatus = "Failed";
}
$receiptid = $_GET['billplz']['id'];
$signing = '';
foreach ($data as $key => $value) {
    $signing.= 'billplz'.$key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}
 
 
$signed= hash_hmac('sha256', $signing, 'S-wzNn8FTL0endIB4wgi728w');
if ($signed === $data['x_signature']) {
    if ($paidstatus == "Success"){ //payment success
        $sqlinsertpayment = "INSERT INTO `table_payment`(`payment_receipt`, `payment_email`, `payment_paid`) VALUES ('$receiptid','$email','$amount')";
        $sqlcart = "SELECT * FROM `table_carts` INNER JOIN table_product ON table_carts.id = table_product.id WHERE  table_carts.email = '$email'";
        $stmtcart= $conn->prepare($sqlcart);
        $stmtcart->execute();
        $number_of_rows = $stmtcart->rowCount();
        $rows = $stmtcart->fetchAll();
        if ($number_of_rows > 0)
        {
            foreach ($rows as $carts)
                {
                    $foodid = $carts['id'];
                    $cartqty = (int)$carts['cart_qty'];
                    $foodprice = (double)$carts['price'];
                    $totalprice = $foodprice * $cartqty;
                    $status = "Processing";
                    $sqlinsertorders = "INSERT INTO `table_orders`(`order_receiptid`, `order_foodid`, `order_custid`, `order_paid`, `order_qty`, `order_status`) VALUES ('$receiptid','$foodid','$email','$totalprice','$cartqty','$status')";
                    //$conn->exec($sqlinsertorders);
                    $stmt = $conn->prepare($sqlinsertorders);
                    $stmt->execute();
                    $sqlupdateqty = "UPDATE table_product SET quantity = quantity - 1 WHERE id = $foodid and quantity > 0";
                    //$conn->exec($sqlupdateqty);
                    $stmt = $conn->prepare($sqlupdateqty);
                    $stmt->execute();
                }
        }
        $sqldeletecart = "DELETE FROM `table_carts` WHERE email = '$email'";
        try {
        $conn->exec($sqlinsertpayment);
        $stmt = $conn->prepare($sqldeletecart);
        $stmt->execute();
            echo "<script>alert('Payment successful')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Payment failed')</script>";
        }
    }
    else 
    {
        echo 'Payment Failed!';
    }
}

?>