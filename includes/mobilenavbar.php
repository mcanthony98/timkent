<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="products.php" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="query" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                 <li class="active">
                 <?php if(isset($_SESSION['uid'])){?>
                    <a href="login.php" class="text-primary"><?php echo $_SESSION['name'];?></a>
                 <?php }else{?>
                    <a href="login.php" class="text-primary">Login/Register</a>
                 <?php } ?>

                </li>
                <li class="">
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="products.php">Products</a>
                </li>
                <li>
                    <a href="blogs.php">Blogs</a>
                </li>
                <li>
                    <a href="contact.php" class="sf-with-ul">Contact Us</a>
                </li>
               
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->