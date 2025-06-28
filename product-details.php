<?php session_start();
include_once('includes/config.php');
error_reporting(0);

//Code for Wish List
$pid=intval($_GET['pid']);
if(isset($_POST['wishlist'])){
if(strlen($_SESSION['id'])==0)
{   
echo "<script>alert('Login is required to wishlist a product');</script>";
} else{
$userid=$_SESSION['id'];    
$query=mysqli_query($con,"select id from wishlist where userId='$userid' and productId='$pid'");
$count=mysqli_num_rows($query);
if($count==0){
mysqli_query($con,"insert into wishlist(userId,productId) values('$userid','$pid')");
echo "<script>alert('Product aaded in wishlist');</script>";
  echo "<script type='text/javascript'> document.location ='my-wishlist.php'; </script>";
} else { 
echo "<script>alert('This product is already added in your wishlist.');</script>";
}
}}

//Code for Adding Product in to Cart
if(isset($_POST['addtocart'])){
if(strlen($_SESSION['id'])==0)
{   
echo "<script>alert('Login is required to add a product in to the cart');</script>";
} else{
$userid=$_SESSION['id']; 
$pqty=$_POST['inputQuantity'];  
$query=mysqli_query($con,"select id,productQty from cart where userId='$userid' and productId='$pid'");
$count=mysqli_num_rows($query);
if($count==0){
mysqli_query($con,"insert into cart(userId,productId,productQty) values('$userid','$pid','$pqty')");
echo "<script>alert('Product aaded in cart');</script>";
  echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
} else { 
$row=mysqli_fetch_array($query);
$currentpqty=$row['productQty'];
$productqty=$pqty+$currentpqty;
mysqli_query($con,"update cart set productQty='$productqty' where userId='$userid' and productId='$pid'");
echo "<script>alert('Product aaded in cart');</script>";
  echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Single Product</title>

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
	
	<?php include_once('includes/header.php');?>
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1> Product Details</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
<?php
$pid=intval($_GET['pid']);                

                $query=mysqli_query($con,"select products.id as pid,products.productImage1,products.productName,products.productDescription,products.Quantity,products.productPriceBeforeDiscount,products.productPrice,productAvailability,category.categoryName,subcategory.subcategoryName as subcatname,subcategory.id as subid,category.id as catid from products join subcategory on products.subCategory=subcategory.id  join category on products.category=category.id where  products.id='$pid'");
                $cnt=1;
                while($row = mysqli_fetch_array($query)) {
                ?>
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">

				<div class="col-md-5">
					<div class="single-product-img">
						<img src="admin/productimages/<?php echo htmlentities($row['productImage1']);?>" alt="">
					</div>
				</div>

				<div class="col-md-7">
					<div class="single-product-content">
						<h3><?php echo htmlentities($row['productName']);?></h3>
						<p class="single-product-pricing"><span><?php echo htmlentities($row['Quantity']); ?></span><font style="text-decoration: line-through;"> $<?php echo htmlentities($row['productPriceBeforeDiscount']); ?></font> - 
                            $<?php echo htmlentities($row['productPrice']); ?></p>
						<p><?php echo $row['productDescription'];?>.</p>
						<div class="single-product-form">
							<?php if($row['productAvailability']=='In Stock'):?>
								
			
							<form name="productdetails" method="post">
								<input class="form-control text-center me-3" id="inputQuantity" name="inputQuantity" type="number" value="1" style="max-width: 3rem" />
					
			
								 <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="addtocart">
                                <i class="fas fa-shopping-cart"></i>
                                Add to cart
                            </button> &nbsp;
   <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="wishlist">
                                <i class="fas fa-heart"></i>
                               Wishlist
                            </button>
                            <?php else: ?>
    <h5 style="color:red;">Out of Stock</h5>
      <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="wishlist">
                                <i class="bi bi-heart"></i>
                               Wishlist
                            </button>
<?php endif;?>  
							</form>
							
							<p><strong>Categories: </strong><?php echo htmlentities($row['categoryName']); ?>(<?php echo htmlentities($row['subcategoryName']); ?>)</p>
						</div>
		
					</div>
				</div>
			</div>
		</div>
	</div>  <?php
                }
                ?>
	<!-- end single product -->


	<?php include_once('includes/footer.php');?>
	
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