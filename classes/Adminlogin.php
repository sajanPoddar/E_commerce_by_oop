
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Session.php');
Session::checkLogin();


include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php

class Adminlogin {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function adminLogin($adminUser, $adminPass) {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        if (empty($adminUser) || empty($adminPass)) {
            $loginmsg = "username and password not empty";
            return $loginmsg;
        } else {
            $query = "select * from tbl_admin where adminUser='$adminUser' and adminpass='$adminPass' ";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                Session::set('adminlogin', true);
                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                header('Location:index.php');
            } else {
                $loginmsg = "username and password not match";
                return $loginmsg;
            }
        }
    }

}
