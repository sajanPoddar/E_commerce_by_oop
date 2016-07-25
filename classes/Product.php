<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php

class Product {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function productInsert($data, $file) {
        $productname = mysqli_real_escape_string($this->db->link, $data['productname']);
        $catid = mysqli_real_escape_string($this->db->link, $data['catid']);
        $brandid = mysqli_real_escape_string($this->db->link, $data['brandid']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;
        if ($productname == '' || $catid == '' || $brandid == '' || $body == '' || $price == '' || $file_name == '' || $type == '') {
            $msg = "<span class='error'> field must not be empty!!</span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productname,catid,brandid,body,price,image,type)VALUES('$productname','$catid','$brandid','$body','$price','$uploaded_image','$type')";
            $pdinsert = $this->db->insert($query);
            if ($pdinsert) {
                $msg = "<span class='success'> Product inserted successfully </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product not inserted</span>";
                return $msg;
            }
        }
    }

    public function getAllProduct() {
        $query = "select p.*, c.cat_name, b.brandname from tbl_product as p, tbl_category as c, tbl_brand as b where p.catid=c.catid and p.brandid=b.brandid order by p.productid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getpdbyid($id) {
        $query = "select p.*, c.cat_name, b.brandname from tbl_product as p, tbl_category as c, tbl_brand as b where p.catid=c.catid and p.brandid=b.brandid and p.productid='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file, $id) {
        $productname = mysqli_real_escape_string($this->db->link, $data['productname']);
        $catid = mysqli_real_escape_string($this->db->link, $data['catid']);
        $brandid = mysqli_real_escape_string($this->db->link, $data['brandid']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;
        if ($productname == '' || $catid == '' || $body == '' || $brandid == '' || $price == '' || $type == '') {
            echo "<span class='error'> field must not be empty!!</span>";
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    $msg = "<span class='error'>Image Size should be less then 1MB!</span>";
                    return $msg;
                } elseif (in_array($file_ext, $permited) === false) {
                    return "<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "update tbl_product set productname='$productname', catid='$catid',brandid='$brandid', body='$body',price='$price', image='$uploaded_image', type='$type' where productid='$id' ";

                    $updated_rows = $this->db->update($query);
                    if ($updated_rows) {
                        return "<span class='success'>Data updated Successfully.</span>";
                    } else {
                        return "<span class='error'>Data Not updated !</span>";
                    }
                }
            } else {
                $query = "update tbl_product set productname='$productname', catid='$catid',brandid='$brandid', body='$body',price='$price', type='$type' where productid='$id' ";

                $updated_rows = $this->db->update($query);
                if ($updated_rows) {
                    return "<span class='success'>Data updated Successfully.</span>";
                } else {
                    return "<span class='error'>Data Not updated !</span>";
                }
            }
        }
    }

    public function delpdById($id) {
        $query = "select * from tbl_product where productid='$id'";
        $getdata = $this->db->select($query);
        if ($getdata) {
            while ($delimage = $getdata->fetch_assoc()) {
                $dellink = $delimage['image'];
                unlink($dellink);
            }
        }
        $query = "delete from tbl_product where productid='$id'";
        $delquery = $this->db->delete($query);
        if ($delquery) {
            echo "<script> alert('data deleted successfully');"
            . "window.location='productlist.php';"
            . "</script>";
        } else {
            echo "<script> alert('data not deleted!!);</script>";
            echo "<script> window.location='productlist.php';</script>";
        }
    }

    public function getFeaturedProduct() {
        $query = "select * from tbl_product where type='0' order by productid desc limit 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getNewProduct() {
        $query = "select * from tbl_product  order by productid desc limit 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct($id) {
        $query = "select p.*, c.cat_name, b.brandname from tbl_product as p, tbl_category as c, tbl_brand as b where p.catid=c.catid and p.brandid=b.brandid and p.productid='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get2brand() {
        $query = "select * from tbl_brand order by brandid desc limit 2";
        $bresult = $this->db->select($query);
        return $bresult;
    }

    public function get1profrombrand($id) {
        $query = "select * from tbl_product where brandid='$id' order by productid desc limit 1";
        $presult = $this->db->select($query);
        return $presult;
    }

    public function get1profromcategory($id) {
        $query = "select * from tbl_product where catid='$id' order by catid desc limit 1";
        $presult = $this->db->select($query);
        return $presult;
    }

    public function getallProbycatid($id) {
        $query = "select * from tbl_product where catid='$id' order by catid desc ";
        $presult = $this->db->select($query);
        return $presult;
    }

    public function insertcomparedata($cmprid, $cmrid) {
        $cquery = "select * from tbl_compare where cmrid='$cmrid' and productid='$cmprid'";
        $check = $this->db->select($cquery);
        if ($check) {
            return "<span class='error'> Already added !</span>";
        }

        $query = "select * from tbl_product where productid='$cmprid'";
        $getpro = $this->db->select($query);
        if ($getpro) {
            while ($result = $getpro->fetch_assoc()) {
                $productid = $result['productid'];
                $productname = $result['productname'];

                $price = $result['price'];
                $image = $result['image'];
                $query = "INSERT INTO tbl_compare(cmrid,productid,productname,price,image) VALUES ('$cmrid','$productid','$productname','$price','$image')";
                $orderinsert = $this->db->insert($query);
                if ($orderinsert) {
                    return "<span class='success'>added to compare</span>";
                } else {
                    return "<span class='error'>not added!</span>";
                }
            }
        }
    }

    public function getCompareProduct($cmrid) {
        $query = "select * from tbl_compare where cmrid='$cmrid' order by id desc ";
        $result = $this->db->select($query);
        return $result;
    }

    public function delcomparedata($cmrid) {
        $query = "delete from tbl_compare where cmrid='$cmrid'";
        $deldata = $this->db->delete($query);
    }

    public function savewlistdata($id, $cmrid) {
        
        $cquery = "select * from tbl_wlist where cmrid='$cmrid' and productid='$id'";
        $check = $this->db->select($cquery);
        if ($check) {
            return "<span class='error'> Already added !</span>";
        }
        $pquery = "select * from tbl_product where productid='$id'";
        $result = $this->db->select($pquery)->fetch_assoc();
        if ($result) {

            $productid = $result['productid'];
            $productname = $result['productname'];
            $price = $result['price'];
            $image = $result['image'];
            $query = "INSERT INTO tbl_wlist(cmrid,productid,productname,price,image) VALUES ('$cmrid','$productid','$productname','$price','$image')";
            $orderinsert = $this->db->insert($query);
            if ($orderinsert) {
                return "<span class='success'>added.check wlist page</span>";
            } else {
                return "<span class='error'>not added!</span>";
            }
        }
    }
    public function checkwishlist($cmrid){
         $query = "select * from tbl_wlist where cmrid='$cmrid' order by id desc ";
        $result = $this->db->select($query);
        return $result;
    }
    public function delwlistpd($productid,$cmrid){
          $query = "delete from tbl_wlist where cmrid='$cmrid' and productid='$productid'";
        $deldata = $this->db->delete($query);
    }

}
