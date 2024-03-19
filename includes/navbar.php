<header class="header header-7">
    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                
                <a href="index.php" class="">
                    <img src="assets\images\timkent\logo.png"  class="img-fluid" alt="Timkent Mobile Spares Logo" width="130" height="5">
                </a>
            </div><!-- End .header-left -->

            <div class="header-right">

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="active">
                            <a href="index.php" class="">Home</a>
                        </li>
                        <li class="">
                            <a href="products.php" class="">Our Products</a>
                        </li>
                        <li class="">
                            <a href="blogs.php" class="">Blogs</a>
                        </li>
                        <li class="">
                            <a href="contact.php" class="">Contact Us</a>
                        </li>

                        <?php if(isset($_SESSION['uid'])){?>
                        <li class="">
                            <a href="login.php" class="text-bold text-primary"><?php echo $_SESSION['name'];?></a>
                        </li>
                        <?php }else{?>
                        <li class="">
                            <a href="login.php" class="text-bold text-primary">Register/Login</a>
                        </li>
                        <?php } ?>

                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
                
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="products.php" method="get">
                        <div class="header-search-wrapper">
                            <label for="navsch" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="query" id='navsch' placeholder="Search product..." autocomplete="off" required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
                
                

                <div class="dropdown cart-dropdown">
                    <a href="cart.php" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count"><?php echo $cartcount;?></span>
                    </a>

                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->





 