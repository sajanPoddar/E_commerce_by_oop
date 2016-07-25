<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../helpers/format.php');
?>



<?php

class Customer {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function customerRegistration($data) {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
        if ($name == '' || $address == '' || $city == '' || $country == '' || $zip == '' || $phone == '' || $email == '' || $pass == '') {
            $msg = "<span class='error'> field must not be empty!!</span>";
            return $msg;
        }

        $query = "select * from tbl_customer where email='$email' limit 1";
        $mailcheck = $this->db->select($query);
        if ($mailcheck != FALSE) {
            echo "<span class='error'> Email already exit </span>";
        } else {
            $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,pass)VALUES('$name','$address','$city','$country','$zip','$phone','$email','$pass')";
            $cmrinsert = $this->db->insert($query);
            if ($cmrinsert) {
                $msg = "<span class='success'> Customer inserted successfully </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer not inserted</span>";
                return $msg;
            }
        }
    }

    public function customerLogin($data) {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
        if (empty($email) || empty($pass)) {
            $msg = "<span style='color:red; font size=16px;'> field must not be empty!!</span>";
            return $msg;
        }
        $query = "select * from tbl_customer where email='$email' and pass='$pass'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = mysqli_fetch_array($result);
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                Session::set('cuslogin', true);
                Session::set('cmrid', $value['id']);
                Session::set('cmrname', $value['name']);

                header('Location:index.php');
            } else {
                $msg = "<span style='color:red;font size=16px;'>No Result Found</span>";
                return $msg;
            }
        } else {
            $msg = "<span style='color:red; font size=16px;'>Email and password don't match</span>";

            return $msg;
        }
    }
   
    public function getcustomerdata($id){
         $query = "select * from tbl_customer where id='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function updateprofile($data,$id){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']); 
          if ($name == '' || $address == '' || $city == '' || $country == '' || $zip == '' || $phone == '' || $email == '' ) {
            $msg = "<span class='error'> field must not be empty!!</span>";
            return $msg;
        }  else {
            $query = "update tbl_customer set name='$name', address='$address',city='$city', country='$country',zip='$zip', phone='$phone', email='$email' where id='$id' ";

                    $updated_rows = $this->db->update($query);
                    if ($updated_rows) {
                        return "<span class='success'>Customer profile updated Successfully.</span>";
                    } else {
                        return "<span class='error'>Customer profile Not updated !</span>";
                    }
        }
        
    }
    public function getcusbyid($id){
        
    }
}
