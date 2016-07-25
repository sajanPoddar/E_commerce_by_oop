<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php 
            $getbrand=$pd->get2brand();
            if($getbrand){
                while($bresult=$getbrand->fetch_assoc()){
                         
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <?php 
                $id=$bresult['brandid'];
                $getproductbybrandid=$pd->get1profrombrand($id);
                if($getproductbybrandid){
                    while($presult=$getproductbybrandid->fetch_assoc()){
                                 
                ?>
                
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?pdid=<?php echo $presult['productid']?>"> <img src="admin/<?php echo $presult['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $bresult['brandname'];?></h2>
                    <p><?php echo $fm->textShorten($presult['body'])?></p>
                    <div class="button"><span><a href="details.php?pdid=<?php echo $presult['productid']?>">Add to cart</a></span></div>
                </div>
                <?php }}?>
            </div>			
           
            <?php }}?>
        </div>
        <div class="section group">
              <?php 
            $getcategory=$cat->get2category();
            if($getcategory){
                while($cresult=$getcategory->fetch_assoc()){
                         
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                  <?php 
                $id=$cresult['catid'];
                $getproductbycatid=$pd->get1profromcategory($id);
                if($getproductbycatid){
                    while($presult=$getproductbycatid->fetch_assoc()){
                                 
                ?>
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?pdid=<?php echo $presult['productid']?>"> <img src="admin/<?php echo $presult['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2><?php echo $cresult['cat_name']?></h2>
                    <p><?php echo $fm->textShorten($presult['body'])?></p>
                    <div class="button"><span><a href="details.php?pdid=<?php echo $presult['productid']?>">Add to cart</a></span></div>
                </div>
                <?php }}?>
            </div>			
            <?php }}?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt=""/></li>
                    <li><img src="images/2.jpg" alt=""/></li>
                    <li><img src="images/3.jpg" alt=""/></li>
                    <li><img src="images/4.jpg" alt=""/></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>

