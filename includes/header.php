<!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="index.php">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                               
                                <li><li class="current-list-item"><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                             
                              
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="shop.php">Shop</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop.php">All</a></li>
                                        <?php $query=mysqli_query($con,"select category.id as catid,category.categoryName,category.categoryDescription,category.creationDate,category.updationDate,tbladmin.username from category join tbladmin on tbladmin.id=category.createdBy");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>  
                                        <li><a href="categorywise.php?cid=<?php echo $row['catid']?>"><?php echo htmlentities($row['categoryName']);?></a></li><?php $cnt=$cnt+1; } ?>
                                      
                                    </ul>
                                </li>
                                <?php if($_SESSION['id']==0){?>
                                  <li style="color: white;font-weight: bolder;">Users
                                    <ul class="sub-menu">
                                        <li><a href="login.php">Login</a></li>
                                        <li><a href="registration.php">Registration</a></li>
                                    </ul>
                                </li>
                                <li class="current-list-item"><a href="admin/index.php">Admin</a></li>
                                <?php } else {?>
                                  <li style="color: white;font-weight: bolder;">My Account
                                    <ul class="sub-menu">
                                       
                                        <li><a href="profile.php">Profile</a></li>
                                        <li><a href="setting.php">Change Password</a></li>
                                         <li><a href="my-orders.php">Order</a></li>
                                        <li><a href="manage-addresses.php">Addresses</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                                <li><a href="my-wishlist.php">Wishlist</a></li>
                                <?php } ?> 
                                <li>
                                    <div class="header-icons">
                                        <?php 
$uid=$_SESSION['id'];
                        $ret=mysqli_query($con,"select sum(productQty) as qtyy from cart where userId='$uid'");
$result=mysqli_fetch_array($ret);
$cartcount=$result['qtyy'];
                        ?>
                                        <a class="shopping-cart" href="my-cart.php"><i class="fas fa-shopping-cart"></i> <?php if($cartcount==0):?>
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        <?php else: ?>
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $cartcount; ?></span>
                            <?php endif;?></a>

                                        <a class="mobile-hide search-bar-icon" href="my-wishlist.php"><i class="fas fa-heart"></i></a>
                                    </div>
                                </li>
                                  
                            </ul>
                        </nav>
                    
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->
    
   
