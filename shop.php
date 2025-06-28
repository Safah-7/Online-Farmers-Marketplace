<?php 
session_start();
include_once('includes/config.php');
error_reporting(0);

// Code for Wish List
$pid=intval($_POST['pid']);
if(isset($_POST['wishlist'])){
    if(strlen($_SESSION['id'])==0) {   
        echo "<script>alert('Login is required to wishlist a product');</script>";
    } else {
        $userid=$_SESSION['id'];    
        $query=mysqli_query($con,"select id from wishlist where userId='$userid' and productId='$pid'");
        $count=mysqli_num_rows($query);
        if($count==0){
            mysqli_query($con,"insert into wishlist(userId,productId) values('$userid','$pid')");
            echo "<script>alert('Product added in wishlist');</script>";
            echo "<script type='text/javascript'> document.location ='my-wishlist.php'; </script>";
        } else { 
            echo "<script>alert('This product is already added in your wishlist.');</script>";
        }
    }
}

// Code for Adding Product to Cart
if(isset($_POST['addtocart'])){
    if(strlen($_SESSION['id'])==0) {   
        echo "<script>alert('Login is required to add a product to the cart');</script>";
    } else {
        $userid=$_SESSION['id']; 
        $pqty=$_POST['inputQuantity'];  
        $query=mysqli_query($con,"select id,productQty from cart where userId='$userid' and productId='$pid'");
        $count=mysqli_num_rows($query);
        if($count==0){
            mysqli_query($con,"insert into cart(userId,productId,productQty) values('$userid','$pid','$pqty')");
            echo "<script>alert('Product added in cart');</script>";
            echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
        } else { 
            $row=mysqli_fetch_array($query);
            $currentpqty=$row['productQty'];
            $productqty=$pqty+$currentpqty;
            mysqli_query($con,"update cart set productQty='$productqty' where userId='$userid' and productId='$pid'");
            echo "<script>alert('Product added in cart');</script>";
            echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">
    
    <!-- title -->
    <title>Fruits and Veggie || Shop</title>
    
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

    <?php include_once('includes/header.php'); ?>

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh Fruits and Vegetables</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <a href="shop.php"><li class="active" data-filter="*">All</li></a>
                            <?php $query=mysqli_query($con,"select category.id as catid,category.categoryName,category.categoryDescription,category.creationDate,category.updationDate,tbladmin.username from category join tbladmin on tbladmin.id=category.createdBy");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>  

                            <a href="categorywise.php?cid=<?php echo $row['catid']?>"><li data-filter=".strawberry"><?php echo htmlentities($row['categoryName']);?></li></a> <?php $cnt=$cnt+1; } ?>
                            
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                <?php
                if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                $total_records_per_page = 9;
                $offset = ($page_no-1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2"; 

                $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM products ");
                $total_records = mysqli_fetch_array($result_count);
                $total_records = $total_records['total_records'];
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1;

                $query=mysqli_query($con,"select products.id as pid,products.productImage1,products.productName,products.Quantity,productAvailability,products.productPriceBeforeDiscount,products.productPrice from products order by pid desc LIMIT $offset, $total_records_per_page ");
                $cnt=1;
                while($row = mysqli_fetch_array($query)) {
                ?>
                <div class="col-lg-4 col-md-6 text-center strawberry">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="product-details.php?pid=<?php echo htmlentities($row['pid']); ?>">
                                <img src="admin/productimages/<?php echo htmlentities($row['productImage1']); ?>" alt="" width="300" height="300">
                            </a>
                        </div>
                        <h3><?php echo htmlentities($row['productName']); ?></h3>
                        <p class="product-price">
                            <span><?php echo htmlentities($row['Quantity']); ?></span>  
                            <span style="text-decoration: line-through;">$<?php echo htmlentities($row['productPriceBeforeDiscount']); ?></span> 
                            $<?php echo htmlentities($row['productPrice']); ?>
                        </p>

                        <form name="productdetails" method="post" style="display: flex; align-items: center; gap: 10px;"><br>
    <p style="padding-left: 25%; margin-top: 35px;"><input class="form-control text-center" id="inputQuantity" name="inputQuantity" type="number" value="1" min="1"
        style="width: 60px; height: 40px; text-align: center; font-size: 16px; padding: 0;" /></p>
    <input id="pid" name="pid" type="hidden" value="<?php echo htmlentities($row['pid']); ?>" />

    <?php if($row['productAvailability']=='In Stock'):?>
        <button class="btn btn-outline-dark" type="submit" name="addtocart"
            style="height: 40px; font-size: 16px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-shopping-cart"></i>
        </button>
        <button class="btn btn-outline-dark" type="submit" name="wishlist"
            style="height: 40px; font-size: 16px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-heart"></i>
        </button>
    <?php else: ?>
        <h5 style="color:red;">Out of Stock</h5>
        <button class="btn btn-outline-dark" type="submit" name="wishlist"
            style="height: 40px; font-size: 16px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-heart"></i> Wishlist
        </button>
    <?php endif; ?>
</form>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap">
                        <ul>
                            <li <?php if($page_no <= 1){ echo "class='page-item disabled'"; } ?>>
                                <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?> class="page-link">Previous</a>
                            </li>
                            <?php 
                            if ($total_no_of_pages <= 10) {       
                                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='page-link active'><a>$counter</a></li>";  
                                    } else {
                                        echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
                                    }
                                }
                            } elseif ($total_no_of_pages > 10) {
                                if ($page_no <= 4) {            
                                    for ($counter = 1; $counter < 8; $counter++) {         
                                        if ($counter == $page_no) {
                                            echo "<li class='page-link active'><a>$counter</a></li>";  
                                        } else {
                                            echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
                                        }
                                    }
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                    echo "<li><a href='?page_no=$second_last' class='page-link'>$second_last</a></li>";
                                    echo "<li><a href='?page_no=$total_no_of_pages' class='page-link'>$total_no_of_pages</a></li>";
                                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {         
                                    echo "<li><a href='?page_no=1' class='page-link'>1</a></li>";
                                    echo "<li><a href='?page_no=2' class='page-link'>2</a></li>";
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                    for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {         
                                        if ($counter == $page_no) {
                                            echo "<li class='page-link active'><a>$counter</a></li>";  
                                        } else {
                                            echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
                                        }
                                    }
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                    echo "<li><a href='?page_no=$second_last' class='page-link'>$second_last</a></li>";
                                    echo "<li><a href='?page_no=$total_no_of_pages' class='page-link'>$total_no_of_pages</a></li>";      
                                } else {
                                    echo "<li><a href='?page_no=1' class='page-link'>1</a></li>";
                                    echo "<li><a href='?page_no=2' class='page-link'>2</a></li>";
                                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                    for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='page-link active'><a>$counter</a></li>";  
                                        } else {
                                            echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
                                        }
                                    }
                                }
                            }
                            ?>
                            <li <?php if($page_no >= $total_no_of_pages){ echo "class='page-item disabled'"; } ?>>
                                <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?> class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end products -->

    <?php include_once('includes/footer.php'); ?>

    <!-- jquery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="assets/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="assets/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="assets/js/sticker.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>

</body>
</html>
