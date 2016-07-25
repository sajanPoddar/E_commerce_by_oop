<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['pdid']) || $_GET['pdid'] == NULL) {
    echo "<script>window.location='404.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['pdid']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addcart = $ct->addCart($quantity, $id);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
    $productid = $_POST['productid'];
    $insertcom = $pd->insertcomparedata($productid, $cmrid);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {

    $savewlist = $pd->savewlistdata($id, $cmrid);
}
?>
<style>
    .mybutton{
        width: 100px;
        margin-right: 50px;
        float: left;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">	
<?php
$getPd = $pd->getSingleProduct($id);
if ($getPd) {
    while ($result = $getPd->fetch_assoc()) {
        ?>
                        <div class="grid images_3_of_2">
                            <img src="admin/<?php echo $result['image'] ?>" alt="" />
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?php echo $result['productname'] ?> </h2>

                            <div class="price">
                                <p>Price: <span>$<?php echo $result['price'] ?></span></p>
                                <p>Category: <span><?php echo $result['cat_name'] ?></span></p>
                                <p>Brand:<span><?php echo $result['brandname'] ?></span></p>
                            </div>
                            <div class="add-cart">
                                <form action="" method="post">
                                    <input type="number" class="buyfield" name="quantity" value="1"/>
                                    <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                                </form>				
                            </div>
                            <span style="color:red; font-size: 18px;"> <?php
                if (isset($addcart)) {
                    echo $addcart;
                }
                ?></span>
                                <?php
                                if (isset($insertcom)) {
                                    echo $insertcom;
                                }
                                 if (isset($savewlist)) {
                                    echo $savewlist;
                                }
                                ?>
                            <?php
                            $login = Session::get("cuslogin");
                            if ($login == TRUE) {
                                ?>                
                                <div class="add-cart">
                                    <div class="mybutton">
                                        <form action="" method="post">
                                            <input type="hidden" class="buyfield" name="productid" value="<?php echo $result['productid'] ?>"/>
                                            <input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
                                        </form>	
                                    </div>
                                    <div class="mybutton">
                                        <form action="" method="post">

                                            <input type="submit" class="buysubmit" name="wlist" value="Add to List"/>
                                        </form>	
                                    </div>
                                </div>
        <?php } ?>
                        </div>
                        <div class="product-desc">
                            <h2>Product Details</h2>
                            <p><?php echo $result['body'] ?></p>
                        </div>
        <?php
    }
}
?>
            </div>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                <?php
                $getallcat = $cat->getallcat();
                if ($getallcat) {
                    while ($result = $getallcat->fetch_assoc()) {
                        ?>
                            <li><a href="productbycat.php?catid=<?php echo $result['catid'] ?>"><?php echo $result['cat_name'] ?></a></li>
                        <?php }
                    } ?>
                </ul>

            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>



