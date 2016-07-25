<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?>
﻿<?php include '../classes/Brand.php'; ?>    
<?php include '../classes/Category.php'; ?>
<?php
if (!isset($_GET['pdid']) || $_GET['pdid'] == NULL) {
    echo "<script>window.location='productlist.php';</script>";
} else {
    $id = $_GET['pdid'];
}
$pd = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updatepd = $pd->productUpdate($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
        if (isset($updatepd)) {
            echo $updatepd;
        }
        ?>

        <div class="block">    
            <?php
            $getpd = $pd->getpdbyid($id);
            if ($getpd) {
                while ($presult = $getpd->fetch_assoc()) {
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="productname" value="<?php echo $presult['productname'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="catid">
                                        <option>Select Category</option>
                                        <?php
                                        $cat = new Category();
                                        $getcat = $cat->getallcat();
                                        if ($getcat) {
                                            while ($result = $getcat->fetch_assoc()) {
                                                ?>
                                                <option
                                                <?php if ($presult['catid'] == $result['catid']) { ?>
                                                        selected="selected"
                                                    <?php } ?>
                                                    value="<?php echo $result['catid'] ?>"><?php echo $result['cat_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Brand</label>
                                </td>
                                <td>
                                    <select id="select" name="brandid">
                                        <option>Select Brand</option>
                                        <?php
                                        $brand = new Brand();
                                        $getallbrand = $brand->getallbrand();
                                        if ($getallbrand) {
                                            while ($result = $getallbrand->fetch_assoc()) {
                                                ?>
                                                <option <?php if ($presult['brandid'] == $result['brandid']) { ?> selected="selected"<?php } ?> value="<?php echo $result['brandid'] ?>"><?php echo $result['brandname'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $presult['body'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input type="text" name="price" value="<?php echo $presult['price'] ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                            <tr>
                                <td></td>
                                <td>
                                    <img src="<?php echo $presult['image'] ?>" alt="" width="200px" height="200px"> 

                                </td>

                            </tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="type">
                                        <option>Select Type</option>

                                        <option   <?php if ($presult['type'] == '0') { ?>  selected="selected" <?php } ?> value="0">Featured</option>
                                        <option <?php if ($presult['type'] == '1') { ?> selected="selected"<?php } ?> value="1">General</option>



                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>


