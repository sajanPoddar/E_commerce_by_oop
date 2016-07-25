<?php include 'inc/header.php'; ?>
<?php
if(isset($_GET['delwlistpd'])){
    $productid=$_GET['delwlistpd'];
    $delwlist=$pd->delwlistpd($productid,$cmrid);
}
?>
<div class="main">
    <div class="content">
        <div class="cartoption">		
            <div class="cartpage">
                <h2>Wishlist</h2>
               
                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <?php
                      $cmrid=Session::get('cmrid');
                    $getcompd = $pd->checkwishlist($cmrid);
                    if ($getcompd) {
                        $i = 0;
                      
                        while ($result = $getcompd->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productname'] ?></td>
                                <td><img src="admin/<?php echo $result['image'] ?>" alt=""/></td>
                                <td>$<?php echo $result['price'] ?></td>
                               
                                <td> <a href="details.php?pdid=<?php echo $result['productid'] ?>"> Buy Now </a>
                                || <a href="?delwlistpd=<?php echo $result['productid'] ?>"> Remove </a>
                                </td>
                            </tr>
                            
                        <?php
                        }
                    }
                    ?>


                </table> 
               
            </div>
            <div class="shopping">
                <div class="shopleft" style="width:100%;text-align: center;">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
              
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>






