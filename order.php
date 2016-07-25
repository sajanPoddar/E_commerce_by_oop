<?php include 'inc/header.php' ?>
<?php
$login=Session::get("cuslogin");
if($login==false){
    header("Location:login.php");
}
?>
<?php
if (isset($_GET['customerid'])) {
    $id = $_GET['customerid'];
    $price = $_GET['price'];
    $time = $_GET['time'];
    $confirm = $ct->productshiftconfirm($id, $time, $price);
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
                <h2>
                    ORDER PAGE
                </h2>
                <table class="tblone">
                    <tr>
                        <th >SL</th>
                        <th >Product Name</th>
                        <th >Image</th>
                        <th > Quantity</th>
                        <th >Price</th>
                        <th >Date</th>
                        <th >Status</th>
                        <th >Action</th>
                    </tr>
                    <?php
                    $cmrid=Session::get("cmrid");
                    $getOrder = $ct->getOrderProduct($cmrid);
                    if ($getOrder) {
                        $i = 0;
                       
                        while ($result = $getOrder->fetch_assoc()) {
                            $i++;
                                ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productname'] ?></td>
                                <td><img src="admin/<?php echo $result['image'] ?>" alt=""/></td>
                                <td> <?php echo $result['quantity']?> </td>
                                <td>$<?php echo $result['price'] ?></td>
                                <td>
                                    <?php echo $fm->formatedate($result['datetime']);?>
                                </td>
                                <td><?php
                                   if($result['status']=='0'){
                                       echo 'pending';
                                   }  elseif ($result['status']=='1') {?>
                                       <a href="?customerid=<?php echo $cmrid?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['datetime'] ?>">Shifted</a>;    
                                   <?php }else{
                                       echo 'Confirm';
                                   }
                                    ?></td>
                                
                                <?php if ($result['status']=='2'){?>
                                <td><a onclick="return confirm('are you sure to delete');" href="">X</a>
                                </td>
                                    <?php } else {?>
                               <td>N/A</td>
                                    <?php }?>
                            </tr>
                            
                        <?php
                        }
                    }
                    ?>


                </table> 
                
            </div>
             <div class="clear"></div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>