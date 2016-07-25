<?php include 'inc/header.php' ?>
<?php
$login=Session::get("cuslogin");
if($login==false){
    header("Location:login.php");
}
?>
<style>
    .payment{
        width: 500px;min-height: 200px;text-align: center;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 50px;
    }
    .payment h2{
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        padding-bottom: 10px;
    }
    .payment p{
      line-height: 25px;
      font-size: 18px;
      text-align: left;
    }
    .payment a{
        background: #ff0000 none repeat scroll 0 0;
        border-radius: 3px;
        color: #fff;
        font-size: 10px;
        padding: 5px 10px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="payment">
                <h2>
                    Success
                </h2>
                <?php
                $cmrid=Session::get('cmrid');
                $amount=$ct->payableamount($cmrid);
                if($amount){
                    $sum=0;
                    while($result=$amount->fetch_assoc()){
                        $price=$result['price'];
                        $sum=$price+$sum;
                    }
                }
                ?>
                <p>
                    Total payable account (including vat):$
                        <?php
                        
                    $vat=$sum *.1;
                    $sum=$sum+$vat;
                    echo $sum;
                    ?>
                </p>
                <p>Payment successfully.Here is your order details.....<a href="order.php">Visit Here</a></p>
            </div>
            
             <div class="clear"></div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>

