
<?php include '../classes/Category.php'; ?>

<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location='catlist.php';</script>";
} else {
    $id = $_GET['catid'];
}
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_name = $_POST['cat_name'];
    $updatecat = $cat->catUpdate($cat_name, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($updatecat)) {
                echo $updatecat;
            }
            ?>
            <?php
            $getcat = $cat->getcatbyid($id);
            if ($getcat) {
                while ($result = $getcat->fetch_assoc()) {
                    ?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="cat_name" value="<?php echo $result['cat_name'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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
<?php include 'inc/footer.php'; ?>