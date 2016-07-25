<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/format.php');
?>
<?php

class Brand {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function brandInsert($brandName) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if (empty($brandName)) {
            $msg = "field must not be empty";
            return $msg;
        } else {
            $query = "insert into tbl_brand (brandname) values('$brandName')";
            $brandinsert = $this->db->insert($query);
            if ($brandinsert) {
                $msg = "<span class='success'> Brand inserted successfully </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand not inserted</span>";
                return $msg;
            }
        }
    }

    public function getallbrand() {
        $query = "select * from tbl_brand order by brandid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBrandById($id) {
        $query = "select * from tbl_brand where brandid='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function brandUpdate($brandName, $id) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($brandName)) {
            echo "<span class='error'>Field must not be empty</span>";
        } else {

            $query = "update tbl_brand set brandname='$brandName' where brandid='$id'";
            $updatebrand = $this->db->update($query);
            if ($updatebrand) {
                $msg = "<style={color:green; font-size:18px;}>Brand updated successfully</style>";
                return $msg;
            } else {
                $msg = "Brand is not updated";
                return $msg;
            }
        }
    }

    public function delBrandById($id) {
        $query = "delete from tbl_brand where brandid='$id'";
        $delbrand = $this->db->delete($query);
        if ($delbrand) {
            $msg = "<span class='success'> Brand deleted successfully </span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Brand not deleted</span>";
            return $msg;
        }
    }

}
