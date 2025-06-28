<?php session_start();
include_once('includes/config.php');
if(strlen( $_SESSION["aid"])==0)
{   
header('location:logout.php');
} else {
//For Adding Products
if(isset($_POST['submit']))
{

    $pid=intval($_GET['id']);
    $category=$_POST['category'];
    $subcat=$_POST['subcategory'];
    $productname=$_POST['productName'];
     $variety=$_POST['variety'];
    $availableIn=$_POST['availablein'];
    $quantity=$_POST['quantity'];
    $productprice=$_POST['productprice'];
    $productpricebd=$_POST['productpricebd'];
    $productdescription=$_POST['productDescription'];
    $productscharge=$_POST['productShippingcharge'];
    $productavailability=$_POST['productAvailability'];
    $updatedby=$_SESSION['aid'];

$sql=mysqli_query($con,"update products set category='$category',subCategory='$subcat',productName='$productname',variety='$variety',Availablein='$availableIn',Quantity='$quantity',productPrice='$productprice',productDescription='$productdescription',shippingCharge='$productscharge',productAvailability='$productavailability',productPriceBeforeDiscount='$productpricebd',lastUpdatedBy='$updatedby' where id='$pid'");
echo "<script>alert('Product details updated successfully');</script>";
echo "<script>window.location.href='manage-products.php'</script>";
}

// Fetch Product Details for Editing
    $pid=intval($_GET['id']);
    $query=mysqli_query($con,"select * from products where id='$pid'");
    $row=mysqli_fetch_array($query);

    // Pre-select the existing values
    $savedAvailableIn = htmlentities($row['Availablein']);
    $savedQuantity = htmlentities($row['Quantity']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Fruits and Veggie | Edit Product</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/all.min.js" crossorigin="anonymous"></script>
        <script src="js/jquery-3.5.1.min.js"></script>
   <script>
function getSubcat(val) {
    $.ajax({
    type: "POST",
    url: "get_subcat.php",
    data:'cat_id='+val,
    success: function(data){
        $("#subcategory").html(data);
    }
    });
}
</script>   

    </head>
    <body>
   <?php include_once('includes/header.php');?>
        <div id="layoutSidenav">
   <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">


<?php 
$pid=intval($_GET['id']);
$query=mysqli_query($con,"select products.id as pid,products.productImage1,products.productImage2,products.productImage3,products.productName,category.categoryName,subcategory.subcategoryName as subcatname,products.postingDate,products.updationDate,subcategory.id as subid,tbladmin.username,category.id as catid,products.variety,products.Availablein,products.Quantity,products.productPrice,products.productPriceBeforeDiscount,products.productAvailability,products.productDescription,products.shippingCharge 
    from products 
    join subcategory on products.subCategory=subcategory.id 
    join category on products.category=category.id 
    join tbladmin on tbladmin.id=products.addedBy 
    where  products.id='$pid' order by pid desc");
while($row=mysqli_fetch_array($query))
{
?>                                 
<form  method="post" enctype="multipart/form-data">                                
<div class="row">
<div class="col-4">Category Name</div>
<div class="col-8">
<select name="category" id="category" class="form-control" onChange="getSubcat(this.value);" required>
<option value="<?php echo htmlentities($row['catid']);?>"><?php echo htmlentities($row['categoryName']);?></option> 
<?php $ret=mysqli_query($con,"select * from category");
while($result=mysqli_fetch_array($ret))
{?>

<option value="<?php echo $result['id'];?>"><?php echo $result['categoryName'];?></option>
<?php } ?>
</select>    
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Sub Category name</div>
<div class="col-8"><select   name="subcategory"  id="subcategory" class="form-control" required>
    <option value="<?php echo htmlentities($row['subid']);?>"><?php echo htmlentities($row['subcatname']);?>
</select>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Product Name</div>
<div class="col-8"><input type="text"    name="productName"  value="<?php echo htmlentities($row['productName']);?>" class="form-control" required>
</select>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Variety</div>
<div class="col-8"><input type="text"    name="variety"  value="<?php echo htmlentities($row['variety']);?>" class="form-control" required>
</select>
</div>
</div>
<div class="row" style="margin-top:1%;">
            <div class="col-4">Available in</div>
            <div class="col-8">
                <select name="availablein" id="availableIn" class="form-control" onchange="updateOptions()">
                    <option value="<?php echo $savedAvailableIn; ?>">
                        <?php echo $savedAvailableIn; ?>
                    </option>
                    <option value="KG">KG</option>
                    <option value="Count">Count</option>
                </select>
            </div>
        </div>

        <div class="row" style="margin-top:1%;">
            <div class="col-4">Quantity</div>
            <div class="col-8">
                <select name="quantity" id="quantity" class="form-control">
                    <option value="<?php echo $savedQuantity; ?>">
                        <?php echo $savedQuantity; ?>
                    </option>
                </select>
            </div>
        </div>
<div class="row" style="margin-top:1%;">
<div class="col-4">Product Price Before Discount</div>
<div class="col-8"><input type="text"    name="productpricebd"  value="<?php echo htmlentities($row['productPriceBeforeDiscount']);?>" class="form-control" required>
</select>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Product Price After Discount(Selling Price)</div>
<div class="col-8"><input type="text"    name="productprice"  value="<?php echo htmlentities($row['productPrice']);?>" class="form-control" required>
</select>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Product Description</div>
<div class="col-8"><textarea  name="productDescription"  placeholder="Enter Product Description" rows="6" class="form-control"><?php echo $row['productDescription'];?></textarea>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Product Shipping Charge</div>
<div class="col-8"><input type="text"    name="productShippingcharge"  value="<?php echo htmlentities($row['shippingCharge']);?>" class="form-control" required>
</select>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Product Availability</div>
<div class="col-8"><select   name="productAvailability"  id="productAvailability" class="form-control" required>
<?php $pa=$row['productAvailability'];
if($pa=='In Stock'):
?>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
<?php else: ?>
<option value="Out of Stock">Out of Stock</option>    
<option value="In Stock">In Stock</option>
<?php endif; ?>
</select>
</select>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Product Featured Image</div>
<div class="col-8"><img src="productimages/<?php echo htmlentities($row['productImage1']);?>" width="250"><br />
    <a href="change-image1.php?id=<?php echo $row['pid'];?>">Change Image</a>
</div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-4">Product Image 2</div>
<div class="col-8"><img src="productimages/<?php echo htmlentities($row['productImage2']);?>" width="250"><br />
    <a href="change-image2.php?id=<?php echo $row['pid'];?>">Change Image</a>
</div>
</div>


<div class="row" style="margin-top:1%;">
<div class="col-4">Product Image 3</div>
<div class="col-8"><img src="productimages/<?php echo htmlentities($row['productImage3']);?>" width="250"><br />
    <a href="change-image3.php?id=<?php echo $row['pid'];?>">Change Image</a>
</div>
</div>

<div class="row">
<div class="col-8"><button type="submit" name="submit" class="btn btn-primary">Update</button></div>
</div>

</form>
      
      <?php } ?>                      </div>
                        </div>
                    </div>
                </main>
          <?php include_once('includes/footer.php');?>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script>
        const savedAvailableIn = "<?php echo $savedAvailableIn; ?>";
        const savedQuantity = "<?php echo $savedQuantity; ?>";

        function updateOptions() {
            const availableIn = document.getElementById("availableIn").value;
            const quantitySelect = document.getElementById("quantity");
            quantitySelect.innerHTML = ""; // Clear existing options

            if (availableIn === "KG") {
                const kgOptions = ["100 gm", "250 gm", "500 gm", "1 KG", "2 KG", "5 KG", "10 KG"];
                kgOptions.forEach(optionText => {
                    const option = document.createElement("option");
                    option.value = optionText;
                    option.text = optionText;
                    if (optionText === savedQuantity) {
                        option.selected = true;
                    }
                    quantitySelect.appendChild(option);
                });
            } else if (availableIn === "Count") {
                for (let i = 1; i <= 10; i++) {
                    const optionText = i + " pcs";
                    const option = document.createElement("option");
                    option.value = optionText;
                    option.text = optionText;
                    if (optionText === savedQuantity) {
                        option.selected = true;
                    }
                    quantitySelect.appendChild(option);
                }
            }
        }

        // Call function on page load to ensure correct options are displayed
        document.addEventListener("DOMContentLoaded", function() {
            updateOptions();
        });
    </script>
    </body>
</html>
<?php } ?>
