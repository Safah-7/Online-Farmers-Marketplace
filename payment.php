<?php session_start();
include_once('includes/config.php');
if(strlen($_SESSION['id'])==0)
{   header('location:logout.php');
}else{
if($_SESSION['address']==0):
    echo "<script type='text/javascript'> document.location ='checkout.php'; </script>";
endif;    



//Order details
if(isset($_POST['submit']))
{
$orderno= mt_rand(100000000,999999999);
$userid=$_SESSION['id'];
$address=$_SESSION['address'];
$totalamount=$_SESSION['gtotal'];
$txntype=$_POST['paymenttype'];
$txnno=$_POST['txnnumber'];
$query=mysqli_query($con,"insert into orders(orderNumber,userId,addressId,totalAmount,txnType,txnNumber) values('$orderno','$userid','$address','$totalamount','$txntype','$txnno')");
if($query)
{

$sql="insert into ordersdetails (userId,productId,quantity) select userID,productId,productQty from cart where userID='$userid';";
$sql.="update ordersdetails set orderNumber='$orderno' where userId='$userid' and orderNumber is null;";
$sql.="delete from  cart where userID='$userid'";
$result = mysqli_multi_query($con, $sql);
if ($query) {
unset($_SESSION['address']);
unset($_SESSION['gtotal']);    
echo '<script>alert("Your order successfully placed. Order number is "+"'.$orderno.'")</script>';
    echo "<script type='text/javascript'> document.location ='my-orders.php'; </script>";
} } else{
echo "<script>alert('Something went wrong. Please try again');</script>";
    echo "<script type='text/javascript'> document.location ='payment.php'; </script>";
} }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Fruits and Veggie || Cart</title>

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
						<p>Fresh and Organic</p>
						<h1>Payment</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<form method="post" name="signup">
     <div class="row">
         <div class="col-2">Total Payment</div>
         <div class="col-6"><input type="text" name="totalamount" value="<?php echo  $_SESSION['gtotal'];?>" class="form-control" readonly ></div>
     </div>
       <div class="row mt-3">
         <div class="col-2">Payment Type</div>
         <div class="col-6">

            <select class="form-control" name="paymenttype" id="paymenttype" required>
                <option value="">Select</option>
                <option value="e-Wallet">E-Wallet</option>
                <option value="Internet Banking">Internet Banking</option>
                <option value="Debit/Credit Card">Debit/Credit Card</option>
                <option value="Cash on Delivery">Cash on Delivery (COD)</option>
            </select>
         </div>
          
     </div>

       <div class="row mt-3" id="txnno">
         <div class="col-2">Transaction Number</div>
         <div class="col-6"><input type="text" name="txnnumber" id="txnnumber" class="form-control" maxlength="50"></div>
     </div>


               <div class="row mt-3">
                 <div class="col-4">&nbsp;</div>
         <div class="col-6"><input type="submit" name="submit" id="submit" class="btn btn-primary" required></div>
     </div>
 </form>
		</div>
	</div>
	<!-- end cart -->



	
	
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
<script type="text/javascript">

  //For report file
  $('#txnno').hide();
  $(document).ready(function(){
  $('#paymenttype').change(function(){
  if($('#paymenttype').val()=='Cash on Delivery')
  {
  $('#txnno').hide();
  jQuery("#txnnumber").prop('required',false);  
  } else if($('#paymenttype').val()==''){
      $('#txnno').hide();
        jQuery("#txnnumber").prop('required',false);  
  } else{
    $('#txnno').show();
  jQuery("#txnnumber").prop('required',true);  
  }
})}) 
</script>
</body>
</html> <?php } ?>