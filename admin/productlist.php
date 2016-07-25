<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include '../classes/Product.php';
include_once '../helpers/format.php';
?>
<?php
$pd = new Product();
if (isset($_GET['pdid'])) {
    $id = $_GET['pdid'];
    $delpd = $pd->delpdById($id);
}
$fm = new format();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <?php
        if (isset($delpd)) {
            echo $delpd;
        }
        ?>

        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Product name</th>
                        <th>category</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getpd = $pd->getAllProduct();
                    if ($getpd) {
                        $i = 0;
                        while ($result = $getpd->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productname'] ?></td>
                                <td><?php echo $result['cat_name'] ?></td>
                                <td> <?php echo $result['brandname'] ?></td>
                                <td><?php echo $fm->textshorten($result['body']) ?></td>
                                <td><?php echo $result['price'] ?></td>
                                <td><img src="<?php echo $result['image'] ?>" height="40px" width="40px"></td>
                                <td> <?php
                                    if ($result['type'] == 0) {
                                        echo 'featured';
                                    } else {
                                        echo 'general';
                                    }
                                    ?></td>
                                <td><a href="productedit.php?pdid=<?php echo $result['productid'] ?>">Edit</a> || <a onclick="return confirm('are u sure to delete?');" href="?pdid=<?php echo $result['productid'] ?>">Delete</a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
