

<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/format.php');
?>




<?php

class Cart {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function addCart($quantity, $id) {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productid = mysqli_real_escape_string($this->db->link, $id);
        $sid = session_id();
        $pquery = "select * from tbl_product where productid='$productid'";
        $result = $this->db->select($pquery)->fetch_assoc();
        $productname = $result['productname'];
        $price = $result['price'];
        $image = $result['image'];
        $chquery = "select * from tbl_cart where productid='$productid' and sid='$sid' ";
        $getpro = $this->db->select($chquery);
        if ($getpro) {
            $msg = "product already added";
            return $msg;
        } else {


            $query = "INSERT INTO tbl_cart(sid,productid,productname,price,quantity,image) VALUES ('$sid','$productid','$productname','$price','$quantity','$image')";
            $cartinsert = $this->db->insert($query);
            if ($cartinsert) {
                header("Location:cart.php");
            } else {
                header("Location:404.php");
            }
        }
    }

    public function getCartProduct() {
        $sid = session_id();
        $query = "select * from tbl_cart where sid='$sid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCart($cartid, $quantity) {
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $query = "update tbl_cart set quantity='$quantity' where cartid='$cartid'";
        $updatequantity = $this->db->update($query);
        if ($updatequantity) {
               header("Location:cart.php");
        } else {
            $msg = "quantity is not updated successfully";
            return $msg;
        }
    }

    public function delProfromcart($id) {
        $query = "delete from tbl_cart where cartid='$id'";
        $delpro = $this->db->delete($query);
        if ($delpro) {
            echo '<script>window.location="cart.php"</script>';
        } else {
            $msg = "<span class='error'>Product not deleted</span>";
            return $msg;
        }
    }

    public function checkCarttable() {
         $sid = session_id();
        $query = "select * from tbl_cart where sid='$sid'";
        $result = $this->db->select($query);
        return $result;
    }
     public function delcustomercart(){
        $sid=  session_id();
        $query="delete from tbl_cart where sid='$sid'";
        $this->db->delete($query);
    }
    public function orderproduct($cmrid){
        $sid=  session_id();
        $query = "select * from tbl_cart where sid='$sid'";
        $getpro = $this->db->select($query);
        if($getpro){
            while($result=$getpro->fetch_assoc()){
                $productid=$result['productid'];
                $productname=$result['productname'];
                 $quantity=$result['quantity'];
                  $price=$result['price']*$quantity;
                   $image=$result['image'];
                $query = "INSERT INTO tbl_order(cmrid,productid,productname,quantity,price,image) VALUES ('$cmrid','$productid','$productname','$quantity','$price','$image')";
            $orderinsert = $this->db->insert($query);     
            }
        }
    }
    public function payableamount($cmrid){
         $query = "select price from tbl_order where cmrid='$cmrid'  ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getOrderProduct($cmrid){
         $query = "select * from tbl_order where cmrid='$cmrid' order by datetime desc  ";
        $result = $this->db->select($query);
        return $result;
    }
    public function checkOrder($cmrid){
          $query = "select * from tbl_order where cmrid='$cmrid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getallorderproduct(){
          $query = "select * from tbl_order order by datetime ";
        $result = $this->db->select($query);
        return $result;
    }
    public function productshift($id,$time,$price){
        $query = "update tbl_order set status='1' where cmrid='$id' and datetime='$time' and price='$price' ";
        $updatequantity = $this->db->update($query);
        if ($updatequantity) {
              $msg = " is  updated successfully";
              return $msg;
        } else {
            $msg = "quantity is not updated successfully";
            return $msg;
        }
    }
    public function delproductshift($id,$time,$price){
        $query = "delete from tbl_order where cmrid='$id' and datetime='$time' and price='$price'";
        $delpro = $this->db->delete($query);
        if ($delpro) {
           $msg = "<span class='success'>Product deleted</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Product not deleted</span>";
            return $msg;
        }
    }
    public function productshiftconfirm($id, $time, $price){
         $query = "update tbl_order set status='2' where cmrid='$id' and datetime='$time' and price='$price' ";
        $updatequantity = $this->db->update($query);
        if ($updatequantity) {
              $msg = " is  updated successfully";
              return $msg;
        } else {
            $msg = "quantity is not updated successfully";
            return $msg;
        }
    }
    }
