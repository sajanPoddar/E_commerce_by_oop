
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/format.php');
?>


<?php

class Category {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function catInsert($cat_name) {
        $cat_name = $this->fm->validation($cat_name);
        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
        if (empty($cat_name)) {
            $msg = "field must not be empty";
            return $msg;
        } else {
            $query = "insert into tbl_category (cat_name) values('$cat_name')";
            $catinsert = $this->db->insert($query);
            if ($catinsert) {
                $msg = "<span class='success'> Category inserted successfully </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category not inserted</span>";
                return $msg;
            }
        }
    }

    public function getallcat() {
        $query = "select * from tbl_category order by catid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getcatbyid($id) {
        $query = "select * from tbl_category where catid='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($cat_name, $id) {
        $cat_name = $this->fm->validation($cat_name);
        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($cat_name)) {
            $msg = "filed must not be empty";
            return $msg;
        } else {
            $query = "update tbl_category set cat_name='$cat_name' where catid='$id'";
            $catupdate = $this->db->update($query);
            if ($catupdate) {
                $msg = "<span class='success'> Category updated successfully </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category not updated</span>";
                return $msg;
            }
        }
    }

    public function delcatById($id) {
        $query = "delete from tbl_category where catid='$id'";
        $delcat = $this->db->delete($query);
        if ($delcat) {
            $msg = "<span class='success'> Category deleted successfully </span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Category not deleted</span>";
            return $msg;
        }
    }
    public function get2category(){
        $query="select * from tbl_category order by catid desc limit 2";
        $bresult=  $this->db->select($query);
        return $bresult;
    }

}
