<?php
//To be included at start of every file.

// Check for cookies, if none, set new.
$cartcount = 0;
if(isset($_COOKIE['cart'])){
    $cartcode = $_COOKIE['cart'];
    setcookie('cart', $cartcode, time() + (86400 * 180), "/");

    $cartcountqry = "SELECT * FROM cart WHERE browser_id='$cartcode'";
    $cartcountres = $pdo->query($cartcountqry);
    $cartcount = $cartcountres->num_rows;

}else{
    $cartcode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 12);
    setcookie('cart', $cartcode, time() + (86400 * 180), "/");
}

?>