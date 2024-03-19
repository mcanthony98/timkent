<?php
session_start();
require "includes/connect.php";
include "includes/cart.php"; 

if(!isset($_GET['pid'])){
    echo '<script>location.replace("products.php");</script>';
    exit ();
}
$pid = mysqli_real_escape_string($pdo, $_GET["pid"]);
$pqry = "SELECT * FROM product JOIN category ON product.category_id=category.category_id WHERE product.product_id = '$pid'";
$pres = $pdo->query($pqry);
$prow = $pres->fetch_assoc();


$mainimgres = $pdo->query("SELECT * FROM prod_img WHERE product_id='$pid' AND type='0'");
if($mainimgres->num_rows == 0){
    $mainimg = "placeholder.png";
}else{
    $mainimgrow = $mainimgres->fetch_assoc();
    $mainimg = $mainimgrow['image'];
}

$otherimgres = $pdo->query("SELECT * FROM prod_img WHERE product_id='$pid' AND type='1'");

$moreqry = "SELECT * FROM product WHERE category_id=".$prow['category_id'];
$moreres = $pdo->query($moreqry);

$quickordurl = "Hello, I visited your website and would like to make an order for: ";
$quickordurl .= ">".$prow['name']." -SKU".$prow['product_id'].". ";

?>

<!DOCTYPE html>
<html lang="en">


<!-- molla/product.html  22 Nov 2019 09:54:50 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $prow['name'];?> | Timkent Spares</title>
    <meta name="keywords" content="timkent, mobile phone screen, screen replacement, broken screen, screen replacement service, <?php echo $prow['name'];?>, <?php echo $prow['category_name'];?>">
    <meta name="description" content="Get your premium quality <?php echo $prow['name'];?> for your phone. This <?php echo $prow['category_name'];?> is ideal for repairing or replacing your broken, scratched mobile phone.">
    <meta name="author" content="Ganiam Tech">    


<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
<link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
<link rel="shortcut icon" href="assets/images/icons/favicon.ico">
<meta name="msapplication-TileColor" content="#cc9966">
<meta name="apple-mobile-web-app-title" content="Timkent Spares"> <!-- Add your web app title -->
<meta name="application-name" content="Timkent Spares"> <!-- Add your application name -->
<meta name="theme-color" content="#ffffff"> <!-- Add your theme color -->
<link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
<!-- Plugins CSS File -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
<!-- Main CSS File -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/plugins/nouislider/nouislider.css">
<link rel="stylesheet" href="assets/css/demos/demo-11.css">
</head>

<body>
    <div class="page-wrapper">
        <?php include "includes/navbar.php";?>

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                        <li class="breadcrumb-item"><a href="products.php?category=<?php echo $prow['category_id'];?>"><?php echo $prow['category_name'];?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $prow['name'];?></li>
                    </ol>

                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
                                        <figure class="product-main-image">
                                            <img id="product-zoom" src="products/<?php echo $mainimg;?>" data-zoom-image="products/<?php echo $mainimg;?>" alt="image of <?php echo $prow['name'];?> ">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure><!-- End .product-main-image -->

                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                            <a class="product-gallery-item active" href="#" data-image="products/<?php echo $mainimg;?>" data-zoom-image="products/<?php echo $mainimg;?>">
                                                <img src="products/<?php echo $mainimg;?>" alt="side image of <?php echo $prow['name'];?> ">
                                            </a>

                                            <?php while($otherimgrow = $otherimgres->fetch_assoc()){?>
                                            <a class="product-gallery-item" href="#" data-image="products/<?php echo $otherimgrow['image'];?>" data-zoom-image="products/<?php echo $otherimgrow['image'];?>">
                                                <img src="products/<?php echo $otherimgrow['image'];?>" alt="another side image of <?php echo $prow['name'];?> ">
                                            </a>
                                            <?php }?>

                                        </div><!-- End .product-image-gallery -->
                                    </div><!-- End .row -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                            <form class="addtocart" method="POST">
                                <div class="product-details">
                                    <h1 class="product-title text-capitalize"><?php echo $prow["name"];?></h1><!-- End .product-title -->


                                    <div class="product-price">
                                        Ksh <?php echo number_format($prow["price"],2)?>
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p><?php echo substr($prow['description'],0,400)?> <a href="#desc"> Read more...</a> </p>
                                    </div><!-- End .product-content -->

                                    
                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" id="qty" class="qtyfield form-control" value="1" min="1" max="<?php echo $prow['quantity'];?>" step="1" data-decimals="0" name="qty" required>
                                        </div><!-- End .product-details-quantity -->
                                    </div><!-- End .details-filter-row -->

                                    <input type="hidden" name="addcart" value="<?php echo $pid;?>">


                                    <div class="product-details-action" id="desc">
                                        <input type="submit" class="btn-product btn-cart" onclick="this.form.submit();" value="Add to Cart" />
                                                  
                                        <div class="details-action-wrapper">
                                        <a type="button" data-toggle="modal" data-target="#quickorder" class="btn btn-success btn-block text-white">Order Now Via Whatsapp!</a>
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a href="products.php?category=<?php echo $prow['category_id'];?>"><?php echo $prow['category_name'];?></a>,
                                        </div><!-- End .product-cat -->

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                                            </form>
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3>Product Information</h3>
                                    <p><?php echo $prow['description'];?> </p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            
                            
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->


                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

        <?php 
        include "includes/footer.php";
        include "includes/mobilenavbar.php";
        ?>
    

    <!-- Sticky Bar -->
    <div class="sticky-bar">
        <div class="container">
        <form class="addtocart" method="POST">
            <div class="row">
                <div class="col-6">
                    <figure class="product-media">
                        <a href="#">
                            <img src="products/<?php echo $mainimg;?>" alt="Product image">
                        </a>
                    </figure><!-- End .product-media -->
                    <h4 class="product-title text-capitalize"><a href="#"><?php echo $prow['name'];?></a></h4><!-- End .product-title -->
                </div><!-- End .col-6 -->

                
                <div class="col-6 justify-content-end">
                    <div class="product-price">
                        Ksh <?php echo number_format($prow['price'], 2);?>
                    </div><!-- End .product-price -->
                    
                    <div class="product-details-quantity">
                        <input type="number" id="sticky-cart-qty" class="qtyfield form-control" name="qty" value="1" min="1" max="<?php echo $prow['quantity'];?>" step="1" data-decimals="0" required>
                    </div><!-- End .product-details-quantity -->

                    <input type="hidden" name="addcart" value="<?php echo $pid;?>">

                    <div class="product-details-action">
                        <a href="#" type="button" data-toggle="modal" data-target="#quickorder" class="btn btn-success"><span>Order Now Via Whatsapp</span></a>
                    </div><!-- End .product-details-action -->
                </div><!-- End .col-6 -->
            </div><!-- End .row -->
                                            </form>
        </div><!-- End .container -->
    </div><!-- End .sticky-bar -->




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
    <script src="assets/js/jquery.elevateZoom.min.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <script>
  $(document).ready(function() {
      $(".addtocart").submit(function(event) {
        event.preventDefault();
          var x = $(".addtocart").serialize();
          $.ajax({  
                        url:"processes/cartprocesses.php",  
                        type:"POST",  
                        data:x,
                        crossDomain: true,
                        cache: false, 
                        success:function(data){
                            if(data == 1){
                                swal("Success!", "Item added to cart", "success");
                            }
                            if(data == 2){
                                swal("Info!", "Item already in cart", "info");
                            }
                            
                        }  
                });

      });
  });
</script>
<script>  
 $(document).ready(function(){  
      $('.qtyfield').on("keyup input", function(){
           var inputVal = $(this).val();
            $(".qtyfield").val(inputVal);	   
      });  
 });  
 </script>

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


</body>


<!-- molla/product.html  22 Nov 2019 09:55:05 GMT -->
</html>