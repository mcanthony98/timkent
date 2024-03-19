<?php
session_start();
require "includes/connect.php";
include "includes/cart.php";

if(isset($_GET['query'])){
    $query = $_GET['query'];
    $title = "Search results for '".$_GET["query"]."'";
    $pqry = "SELECT * FROM product JOIN category ON product.category_id=category.category_id WHERE product.name LIKE '%$query%' OR product.description LIKE '%$query%' OR  product.slug LIKE '%$query%' OR category.category_name LIKE '%$query%' ORDER BY product.views DESC";
  
}elseif(isset($_GET['category'])){
    $query = $_GET['category'];
    $title = "Search results for '".$_GET["query"]."'";
    $pqry = "SELECT * FROM product JOIN category ON product.category_id=category.category_id WHERE category.category_id = '$query' ORDER BY product.views DESC LIMIT 24";
}else{
    $title = "All Products";
    $query = "All products";
    $pqry = "SELECT * FROM product JOIN category ON product.category_id=category.category_id ORDER BY product.views DESC LIMIT 24";
}

$pres = $pdo->query($pqry);
?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Quality Mobile Phone Parts | Timkent Spares</title>
<meta name="keywords" content="timkent, samsung mobile phone parts, iphone parts, screen replacement, mobile phone parts, Umidigi screen, infinix screen, mobile phone screen replacement, mobile phone screen replacement, itel screen, techno phone, broken screen replacement">
<meta name="description" content="Browse through our High-quality mobile spare parts including Mobile phone screen for Samsung, Iphone, Itel, Infinix, Tecno, Oppo, Huawei, Redmi, One Plus, Vivo, Realme, Nokia. Which phone are you using?">
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
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title"><?php echo $title;?><span>Timkent Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="products.php">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $query;?></li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
        			<div class="toolbox">
        			


        				<div class="toolbox-right">
                            
                            <form action="products.php" method="get">
        					<div class="toolbox-sort">

                                <label>Search your device:</label>
                                <input type="search" class="form-control" name="query" id='navsch' placeholder="Search your device..." autocomplete="off" required>
                            </form>
								
        					</div><!-- End .toolbox-sort -->
        				</div><!-- End .toolbox-right -->
        			</div><!-- End .toolbox -->

                    <div class="products">
                        <div class="row">






                        <?php while($prow = $pres->fetch_assoc()){
                            $imgqry = "SELECT * FROM prod_img WHERE type='0' AND product_id=".$prow['product_id'];
                            $imgres =$pdo->query($imgqry);
                            if($imgres->num_rows == 0){
                                $img = "placeholder.png";
                            }else{
                                $imgrow = $imgres->fetch_assoc();
                                $img = $imgrow['image'];
                            }
                            
                            ?>
                            

                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <div class="product shadow-sm">
                                    <figure class="product-media">
                                        <?php if($prow['quantity'] == 0){?>
                                        <span class="product-label label-out">Out of stock</span>
                                        <?php }?>
                                        <a href="product.php?product=<?php echo $prow['slug'];?>&pid=<?php echo $prow['product_id'];?>">
                                            <img src="products/<?php echo $img;?>" alt="<?php echo $prow['name'];?>" class="product-image">
                                        </a>
                                    </figure><!-- End .product-media -->


                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="products.php?category=<?php echo $prow['category_id'];?>"><?php echo $prow['category_name'];?></a>
                                        </div><!-- End .product-cat -->
                                        <a href="product.php?product=<?php echo $prow['slug'];?>&pid=<?php echo $prow['product_id'];?>">
                                        <h3 class="product-title text-capitalize"><?php echo $prow['name'];?></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            Ksh <?php echo number_format($prow['price'], 2); ?>
                                        </div><!-- End .product-price -->
                                        </a>
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->

                        <?php } ?>




        
                        </div><!-- End .row -->

                       
                    </div><!-- End .products -->

                   
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

        <?php 
        include "includes/footer.php";
        include "includes/mobilenavbar.php";
        ?>

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
    <script src="assets/js/wNumb.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/nouislider.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <?php 
    if(isset($_GET['query'])){ ?>
    <script>
        $("#navsch").val("<?php echo $query;?>");
    </script>
    <?php } ?>
</body>


<!-- molla/category-boxed.html  22 Nov 2019 10:03:02 GMT -->
</html>