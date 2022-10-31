<?php
session_start();
require "../includes/connect.php";

if(isset($_POST['addcart'])){
    $pid = mysqli_real_escape_string($pdo, $_POST["addcart"]);
    $qty = mysqli_real_escape_string($pdo, $_POST['qty']);
    $browser_id = mysqli_real_escape_string($pdo, $_COOKIE['cart']);

    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $qry = "INSERT INTO cart (user_id, browser_id, product_id, cart_quantity) VALUES ('$uid', '$browser_id', '$pid', '$qty')";
        $chkqry = "SELECT * FROM cart WHERE user_id='$uid' AND product_id='$pid'";
    }else{
        $qry = "INSERT INTO cart (browser_id, product_id, cart_quantity) VALUES ('$browser_id', '$pid', '$qty')";
        $chkqry = "SELECT * FROM cart WHERE browser_id='$browser_id' AND product_id='$pid'";
    }

    $chkres  = $pdo->query($chkqry);
    if($chkres->num_rows > 0){
        echo "2";
    }else{
        $res = $pdo->query($qry);
        echo "1";
    }    
    
}elseif(isset($_POST['adjqty'])){
    $cid = mysqli_real_escape_string($pdo, $_POST["cid"]);
    $qty = mysqli_real_escape_string($pdo, $_POST["adjqty"]);

    $qry = "UPDATE cart SET cart_quantity='$qty' WHERE cart_id='$cid'";
    $res = $pdo->query($qry);

    $_SESSION['success'] = "Quantity Updated Successfully!";
    header('location: ../cart.php#cartview');
    exit();
}elseif(isset($_GET['removeitem'])){
    $cid = mysqli_real_escape_string($pdo, $_GET["removeitem"]);

    $qry = "DELETE FROM cart WHERE cart_id='$cid'";
    $res=$pdo->query($qry);

    $_SESSION['success'] = "Item Removed Successfully!";
    header('location: ../cart.php#cartview');
    exit();
}

?>