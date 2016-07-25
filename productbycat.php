<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location='404.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
}
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Latest from Category</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getCpd=$pd->getallProbycatid($id);
            if($getCpd){
                while ($result=$getCpd->fetch_assoc()){
                    
                
            
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?pdid=<?php echo $result['productid'] ?>"><img src="admin/<?php echo $result['image']?>" alt="" width="180px" height="200px" /></a>
                <h2><?php echo $result['productname']?></h2>
                <p><?php echo $fm->textShorten($result['body'],10)?></p>
                <p><span class="price">$<?php echo $result['price']?></span></p>
                <div class="button"><span><a href="details.php?pdid=<?php echo $result['productid'] ?>" class="details">Details</a></span></div>
            </div>
            <?php }}?>
        </div>



    </div>
</div>
<?php include 'inc/footer.php'; ?>




