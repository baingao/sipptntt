<?php

class User {

    private $id_user;
    private $name;
    private $password;
    private $role;
    private $api_key;
    private $login_time;

    function setIdUser($input_id_user) {
        $this->id_user = $input_id_user;
    }

    function getIdUser() {
        return $this->id_user;
    }
    
    function setName($input_name) {
        $this->name = $input_name;
    }

    function getName() {
        return $this->name;
    }

    function setPassword($input_password) {
        $this->password = $input_password;
    }

    function getPassword() {
        return $this->password;
    }

    function setRole($input_role) {
        $this->role = $input_role;
    }

    function getRole() {
        return $this->role;
    }
    
    function getRoleAsString() {
        $role =  $this->role;
        switch ($role) {
            case 0 : $role_string = "GUEST";
                break;
            case 1 : $role_string = "FRONTDESK";
                break;
            case 2 : $role_string = "ANALISA";
                break;
            case 3 : $role_string = "DATA";
                break;
            case 4 : $role_string = "SUPERVISOR";
                break;
            case 5 : $role_string = "ADMIN";
                break;
            case 6 : $role_string = "SUPER";
                break;
        }
        return $role_string;
    }
    
    public static function roleAsString($input_role) {
        switch ($input_role) {
            case 0 : $role_string = "GUEST";
                break;
            case 1 : $role_string = "FRONTDESK";
                break;
            case 2 : $role_string = "ANALISA";
                break;
            case 3 : $role_string = "DATA";
                break;
            case 4 : $role_string = "SUPERVISOR";
                break;
            case 5 : $role_string = "ADMIN";
                break;
            case 6 : $role_string = "SUPER";
                break;
        }
        return $role_string;
    }

    function setApiKey($input_api_key) {
        $this->api_key = $input_api_key;
    }

    function getApiKey() {
        return $this->api_key;
    }

    function setLoginTime($input_login_time) {
        $this->login_time = $input_login_time;
    }

    function getLoginTime() {
        return $this->login_time;
    }

    function login() {
        try {
            $username = $this->getName();
            $password = md5($this->getPassword());
            $db = new DbConnect();
            $stmt = $db->connect()->query("SELECT idUser, role FROM user WHERE username='{$username}' and password='{$password}'");
            $user_row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                $iduser = $user_row['idUser'];
                $current_role = $user_row['role'];
//                echo $iduser . "<br>";

                $current_api_key = md5(rand(0, 999999999));
                $current_login_time = time();

                $this->setIdUser($iduser);
                $this->setApiKey($current_api_key);
                $this->setLoginTime($current_login_time);
                $this->setRole($current_role);

                $stmt = $db->connect()->prepare("UPDATE user SET apikey=?, logintime=? WHERE idUser=?");
                $stmt->execute(array($this->getApiKey(), $this->getLoginTime(), $iduser));
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function isLoggedIn($id_user=0, $api_key=0, $login_time=0) {
        $db = new DbConnect();
        $stmt = $db->connect()->query("SELECT idUser, apiKey, loginTime FROM user where idUser={$id_user}");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result!=null) {
            if ($api_key==$result['apiKey']) {
                if ((time()-$result['loginTime'])<=600) {
                    return true;
                } 
            }
        } else {
            return false;
//            session_unset();
//            session_destroy();
//            header('location: index.php');
        }   
    }

    public function redirect($url) {
        header("location: $url");
    }

}

?>