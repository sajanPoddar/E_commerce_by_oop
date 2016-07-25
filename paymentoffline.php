<?php include 'inc/header.php' ?>
<?php
$login=Session::get("cuslogin");
if($login==false){
    header("Location:login.php");
}
?>
<?php
if(isset($_GET['orderid'])&& $_GET['orderid']=='order'){
    $cmrid=Session::get('cmrid');
    $insertproduct=$ct->orderproduct($cmrid);
     $delData=$ct->delcustomercart();
     header('Location:success.php');
}
?>
<style>
    .division{
        width: 50%;
        float: left;
    }
    .tblone{
        width: 500px;
        margin: 0px auto;
             border: 2px solid ghostwhite;
       
    }
    .tblone tr td{
        text-align: justify;
    }
    .tbltwo{
        float: right; text-align: left;width: 50%;border: 2px solid #ddd; margin-right: 14px; margin-top: 12px;
    }
    .tbltwo tr td{
        text-align: justify; padding: 5px 10px;
    }
    .ordernow{padding-bottom: 30px;}
    .ordernow a{
        width: 200px; margin: 20px auto 0; text-align: center; padding: 5px; font-size: 30px; display: block; background: #ff0000;
        color: #fff; border-radius: 3px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="division">
                 <table class="tblone">
                    <tr>
                        <th >No</th>
                        <th >Product</th>
                        <th >Price</th>
                        <th >Quantity</th>
                        <th >Total Price</th>
                        
                    </tr>
                    <?php
                    $getPro = $ct->getCartProduct();
                    if ($getPro) {
                        $i = 0;
                        $qty=0;
                        $sum = 0;
                        while ($result = $getPro->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productname'] ?></td>
                                <td>$<?php echo $result['price'] ?></td>
                                <td><?php echo $result['quantity'] ?></td>
                                 <td>$<?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total;
                                    ?></td>
                                
                            </tr>
                            <?php
                            $qty=$qty+$result['quantity'];
                            $sum = $sum + $total;
//                             Session::set('qty', $qty);
//                            Session::set('sum', $sum);
                            ?>
                        <?php
                        }
                    }
                    ?>


                </table> 
                 <?php
                $getdata = $ct->checkCarttable();
                if ($getdata) {
                    ?>
                <table class="tbltwo">
                        <tr>
                            <th>Sub Total : </th>
                            <td>$<?php echo $sum ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>quantity :</th>
                            <td><?php
                                  echo $qty;
                                ?></td>
                        </tr>
                         <tr>
                            <th>Grand Total :</th>
                            <td><?php
                                $vat = $sum * .1;
                                $gtotal = $sum + $vat;
                                echo $gtotal;
                                ?></td>
                        </tr>
                    </table>
                <?php
                }?>
            </div>
            <div class="division">
                 <?php
            $id=Session::get('cmrid');
            $getdata=$cmr->getcustomerdata($id);
            if($getdata){
                while ($result=$getdata->fetch_assoc()){
              
            ?>
            <table class="tblone">
                <tr>
                    <td colspan="3">
                        Your profile details
                    </td>
                </tr>
                <tr>
                    <td width='25%'>
                        Name
                    </td>
                    <td width='5%'>
                        :
                    </td>
                    <td>
                        <?php echo $result['name']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Phone
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                         <?php echo $result['phone']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <?php echo $result['email']?>
                    </td>
                </tr>
                <tr>
                    <td>
                       Country
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                         <?php echo $result['country']?>
                    </td>
                </tr>
                <tr>
                    <td>
                       City
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                         <?php echo $result['city']?>
                    </td>
                </tr>
                <tr>
                    <td>
                       Address 
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <?php echo $result['address']?>
                    </td>
                </tr>
                 <tr>
                    <td>
                       Zip-code 
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <?php echo $result['zip']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        <a href="editprofile.php">Update Profile details</a>
                    </td>
                </tr>
                
            </table>
            <?php
            }}
            ?>
            </div>
             
        </div>
    </div>
    <div class="ordernow"><a href="?orderid=order">Order</a></div>
</div>
<?php include 'inc/footer.php'; ?>

