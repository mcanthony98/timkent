<?php
session_start();
require "includes/connect.php";
include "includes/cart.php";

if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
    $qry = "SELECT * FROM cart JOIN product ON product.product_id=cart.product_id WHERE cart.user_id='$uid' ORDER BY cart.cart_id DESC";
}elseif(isset($_COOKIE['cart'])){
    $uid = $_COOKIE['cart'];
    $qry = "SELECT * FROM cart JOIN product ON product.product_id=cart.product_id WHERE cart.browser_id='$uid' ORDER BY cart.cart_id DESC";
}
$total = 0;
$res = $pdo->query($qry);
$quickordurl = "Hello, I visited your website and would like to make an order for: ";
?>

<!DOCTYPE html>
<html lang="en">


<!-- molla/cart.html  22 Nov 2019 09:55:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shopping Cart - Timkent Spareparts</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="page-wrapper">
       <?php include "includes/navbar.php";?>

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb" id="cartview">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="products.php">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">


                            <?php if($res->num_rows == 0){?>
                                <div class="col-12 p-2 text-center">
                                    <div class="py-5 shadow">
                                        <span class="text-bold h5 my-2">Your Shopping Cart is Empty!</span><br/>
                                        <span>Please click below to start shopping.</span><br/>
                                        <a href="products.php" class="btn btn-primary btn-shadow btn-rounded btn-lg my-2"><span class="text-white">Go Shopping</span></a>
                                    </div>
                                </div>
                            <?php }else{?>
                                

	                		<div class="col-lg-9">
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>Product</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
                                        <?php while($row = $res->fetch_assoc()){
                                            $imgqry = "SELECT * FROM prod_img WHERE type='0' AND product_id =".$row['product_id'];
                                            $imgres = $pdo->query($imgqry);
                                            if($imgres->num_rows > 0){
                                                $imgrow = $imgres->fetch_assoc();
                                                $img = $imgrow['image'];
                                            }else{
                                                $img = "placeholder.png";
                                            }
                                            $subtotal = $row['price']*$row['cart_quantity'];
                                            $total = $total+$subtotal;

                                            $quickordurl .= ">".$row['name']." -SKU".$row['product_id'].". ";
                                            ?>
										<tr>
											<td class="product-col">
												<div class="product">
													<figure class="product-media">
														<a href="product.php?product=<?php echo $row['slug'];?>&pid=<?php echo $row['product_id'];?>">
															<img src="products/<?php echo $img;?>" alt="Product image">
														</a>
													</figure>

													<h3 class="product-title">
														<a href="product.php?product=<?php echo $row['slug'];?>&pid=<?php echo $row['product_id'];?>"><?php echo $row['name'];?></a>
													</h3><!-- End .product-title -->
												</div><!-- End .product -->
											</td>
											<td class="price-col">Ksh <?php echo number_format($row['price'], 2);?></td>
											<td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <form method="POST" action="processes/cartprocesses.php">
                                                    <input type="number" class="form-control" value="<?php echo $row['cart_quantity'];?>" min="1" max="<?php echo $row['quantity'];?>" name="adjqty"  step="1" data-decimals="0"  onchange="this.form.submit();" required>
                                                    <input type="hidden" name="cid" value="<?php echo $row['cart_id'];?>"/>
                                                    </form>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
											<td class="total-col">Ksh <?php echo number_format($subtotal ,2);?></td>
											<td class="remove-col"><a href="processes/cartprocesses.php?removeitem=<?php echo $row['cart_id'];?>" class="btn-remove" onclick="removealert()"><i class="icon-close"></i></a></td>
										</tr>

                                        <?php } ?>

									</tbody>
								</table><!-- End .table table-wishlist -->

	                		</div><!-- End .col-lg-9 -->
	                		<aside class="col-lg-3">
	                			<div class="summary summary-cart">
	                				<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

	                				<table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-subtotal">
	                							<td>Subtotal:</td>
	                							<td>Ksh <?php echo number_format($total,2);?></td>
	                						</tr><!-- End .summary-subtotal -->
	                						<tr class="summary-shipping">
	                							<td>Shipping:</td>
	                							<td>&nbsp;</td>
	                						</tr>

	                						<tr class="summary-shipping-row">
	                							<td>
													<div class="custom-control custom-radio">
														<input type="radio" id="free-shipping" name="shipping" class="custom-control-input" checked>
														<label class="custom-control-label" for="free-shipping">Standard Shipping</label>
													</div><!-- End .custom-control -->
	                							</td>
	                							<td>Ksh 350.00</td>
	                						</tr><!-- End .summary-shipping-row -->


	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>Ksh <?php echo number_format($total+350, 2);?></td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->
                                            <?php if(isset($_SESSION['uid'])){?>
	                				<!--<a href="checkout.php" onclick="qo()" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>-->
                                    <button onclick="qo()" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</button>
                                    <?php }else{?>
                                        <a href="login.php?return=cart.php" onclick="qo()" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                                        <?php } ?>
                                    <div class="text-center"> <span class="text-primary text-center">OR</span></div>
                                    <a type="button" data-toggle="modal" data-target="#quickorder" href="#" class="btn btn-outline-success btn-block">Quick Order</a>
	                			</div><!-- End .summary -->

		            			<a href="products.php" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
	                		</aside><!-- End .col-lg-3 -->

                            <?php } ?>
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->


        <?php 
        include "includes/footer.php";
        include "includes/mobilenavbar.php";
        ?>
    

<!-- Modal -->
<div class="modal fade" id="quickorder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quick Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center mx-2">

        
        <div class="alert alert-primary m-3 py-4 px-2" role="alert">
            Quick Orders are made via Whatsapp. You need Whatsapp to make a quick order.
        </div>
        <p>Click here to open Whatsapp</p>
        <a href="https://wa.me/254704135100?text=<?php echo htmlspecialchars($quickordurl);?>" target="_blank" class="btn btn-success btn-rounded">Quick Order Here</a>

        <hr class="m-3 text-primary">
        <p>Scan QR code below with a Whatsapp-Enabled Phone/Tablet</p>
        <div class="float-center" align="center"><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://wa.me/254704135100?text=<?php echo htmlspecialchars($quickordurl);?>" class="img-fluid text-center"></div>

        <hr class="m-3 text-primary">
        <p>Or you can copy the link below and paste it to your browser</p>
        <div class="mb-3">
        <input type="text" value="https://wa.me/254704135100?text=<?php echo htmlspecialchars($quickordurl);?>" class="form-control mb-1" readonly id="myInput">
        <button class="btn-secondary" onclick="ctc()">Copy Link</button>
        </div>

      </div>
    </div>
  </div>
</div>




    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php if(isset($_SESSION['success'])){
        echo "<script>toastr.success('".$_SESSION['success']."', {timeOut: 7000})</script>";
    unset($_SESSION['success']); 
    };?>

    <script>
        function ctc() {
  // Get the text field
  var copyText = document.getElementById("myInput");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  toastr.success('Link Copied to Clipboard', {timeOut: 5000})
}
    </script>
    <script>
        function qo(){
            swal("An Error Occurred!", "Please use the \"Quick Order\" option!", "warning");
        }
    </script>
</body>


<!-- molla/cart.html  22 Nov 2019 09:55:06 GMT -->
</html>