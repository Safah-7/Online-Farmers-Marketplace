<?php session_start();
error_reporting(0);
include_once('includes/config.php');
if(strlen($_SESSION['id'])==0)
{   header('location:logout.php');
}else{


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Fruits and Veggie || My Orders</title>

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
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
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
						<h1>#<?php echo intval($_GET['onumber']);?> Order Details</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="cart-table-wrap">
					<div class="table-responsive">
					
						<?php
$uid=$_SESSION['id'];
$orderno=intval($_GET['onumber']);
$ret=mysqli_query($con,"select *,orders.id as orderid from orders 
left join addresses on addresses.id=orders.addressId
    where orders.userId='$uid' and orders.orderNumber='$orderno'");
while ($row=mysqli_fetch_array($ret)) {?>
       <table class="table table-bordered" border="1">
<tr>
    <th>Order Number</th>
    <td><?php echo htmlentities($row['orderNumber']);?></td>
</tr>
<tr>
    <th>Order Date</th>
    <td><?php echo htmlentities($row['orderDate']);?></td>
</tr>
<tr>
    <th>Total Amount</th>
    <td><?php echo htmlentities($row['totalAmount']);?></td>
</tr>
<tr>
    <th>Txn Type</th>
    <td><?php echo htmlentities($row['txnType']);?></td>
</tr>
<tr>
    <th>Txn Number</th>
    <td><?php echo htmlentities($row['txnNumber']);?></td>
</tr>
<tr>
    <th>Status</th>
    <td><?php $ostatus=$row['orderStatus'];
                    if( $ostatus==''): echo "Not Processed Yet";
                        else: echo $ostatus; endif;?>
                            <br />
<a href="javascript:void(0);" onClick="popUpWindow('track-order.php?oid=<?php echo $row['orderid'];?>');" title="Track order"> Track order
</a>

                        </td>
</tr>
    </table>
    </div>
					</div>
				</div>
<div class="col-lg-6 col-md-12">
					<div class="cart-table-wrap">
	 <table class="table table-bordered" border="1">
<tr>
    <th>Billing Address</th>
    <td><address><?php echo htmlentities($row['billingAddress']);?><br />
<?php echo htmlentities($row['biilingCity']);?>,<?php echo htmlentities($row['billingState']);?><br />
<?php echo htmlentities($row['billingPincode']);?>, <?php echo htmlentities($row['billingCountry']);?>
</address>
    </td>
</tr>
<tr>
    <th>Shipping Address</th>
    <td><address><?php echo htmlentities($row['shippingAddress']);?><br />
<?php echo htmlentities($row['shippingCity']);?>,<?php echo htmlentities($row['shippingState']);?><br />
<?php echo htmlentities($row['shippingPincode']);?>, <?php echo htmlentities($row['shippingCountry']);?>
</address>
    </td>
</tr>
<tr><td colspan="2"><a href="javascript:void(0);" onClick="popUpWindow('cancelorder.php?oid=<?php echo $row['orderid'];?>');" title="Cancel Order" class="btn-upper btn btn-danger">Canel this Order
</a></td></tr>
    </table>
    </div><?php } ?>
					</div>
				
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
	 <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="4"><h4>Order Products / Items</h4></th>
                </tr>
            </thead>
            <tr>
                <thead>
                    <th>Product</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    
                    <th>Quantity</th>
                    <th>Total Amount</th>
                     <th>Shipping Charge</th>
                    
                </thead>
            </tr>
            <tbody>
<?php
$ret=mysqli_query($con,"select products.productName as pname,products.productName as proid,products.productName,products.shippingCharge ,products.productImage1 as pimage,products.productPrice as pprice,ordersdetails.productId as pid,ordersdetails.id as cartid,products.productPriceBeforeDiscount,ordersdetails.quantity from ordersdetails join products on products.id=ordersdetails.productId where ordersdetails.userId='$uid'  and ordersdetails.orderNumber='$orderno'");
$num=mysqli_num_rows($ret);
    if($num>0)
    {
while ($row=mysqli_fetch_array($ret)) {

?>

                <tr>
                    <td class="col-md-2"><img src="admin/productimages/<?php echo htmlentities($row['pimage']);?>" alt="<?php echo htmlentities($row['pname']);?>" width="100" height="100"></td>
                    <td>
                       <a href="product-details.php?pid=<?php echo htmlentities($pd=$row['pid']);?>"><?php echo htmlentities($row['pname']);?></a></td>
<td>
                           <span style="text-decoration: line-through;">$<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                            <span>$<?php echo htmlentities($row['pprice']);?></span>
                    </td>
                    <td><?php echo htmlentities($row['quantity']);?></td>
                  
                     <td><?php echo htmlentities($totalamount=$row['quantity']*$row['pprice']);?></td>
          <td><?php echo htmlentities($tshipping=$row['shippingCharge']);?></td>
                </tr>
            
                <?php $grantotal+=$totalamount;
                $gtshipping+=$tshipping; } ?>
<tr>
    <th colspan="4">Grand Total</th>
    <th colspan="2"><?php echo $grantotal+$gtshipping;?></th>
</tr>
                <?php } else{ ?>
                <tr>
                    <td style="font-size: 18px; font-weight:bold; color:red;">Invalid Request

                    </td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
					</div>
		</div>
	</div>
	<!-- end cart -->



		</div>

	</div>
	
	
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
</html> <?php } ?>