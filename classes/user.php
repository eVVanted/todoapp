<?php
class User {

    private function __construct() {
    }
    private function __clone() {}

    public static function register($email,$password) {
        $db = DB::getConnection();
        $email=$db->real_escape_string($email);
        $password=password_hash($db->real_escape_string($password),PASSWORD_DEFAULT);

        $query="INSERT INTO `users` (email,password) VALUES ('$email','$password')";
        if ($db->query($query) === TRUE) {
            $user_id = $db->insert_id;
            $result['error'] = false;
            $result['message'] = '';
            setcookie('logged_in_user',$email);
            setcookie('logged_in_user_id',$user_id);
            setcookie('is_logded_in',true);

        } elseif("Duplicate entry '$email' for key 'email'" === $db->error) {
            $result['error'] = true;
            $result['message'] = 'User with this email already exists.';
        } else {
            $result['error'] = true;
            $result['message'] = $db->error;
        }
        return $result;
    }

    public static function isUserValid($email,$password){
        $db = DB::getConnection();
        $email=$db->real_escape_string($email);
        $query = "SELECT * FROM `users` WHERE `email` = '$email'";
        $db_result = $db->query($query);
        if($db_result->num_rows == 1){
            $row = $db_result->fetch_array(MYSQLI_ASSOC);
            if(password_verify($password,$row['password'])){
                $result['error'] = false;
                $result['message'] = '';
                setcookie('logged_in_user',$row['email']);
                setcookie('logged_in_user_id',$row['id']);
                setcookie('is_logded_in',true);
            }else{
                $result['error'] = true;
                $result['message'] = 'You provided invalid email or password.';
            }
        } else {
            $result['error'] = true;
            $result['message'] = 'User with this email does not exist.';
        }
//
//        $count=mysql_num_rows($result);
//        if($count == 1){
//            setcookie('login',$username);
//            setcookie('islogged',true);
//            $dsatz = mysql_fetch_assoc($result);
//            setcookie('my_id', $dsatz['id']);
//            header("location:list.php");
//        } else {
//            unset($_COOKIE['login']);
//            setcookie('login', false);
//            setcookie('islogged',false);
//            setcookie('id',false);
//            echo "Wrong Username or Password, try again!";
//        }
        return $result;
    }
}

