<?php

class User {

    private $name;
    private $password;
    private $role;
    private $api_key;
    private $login_time;

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
            $password = md5($this->getPassword);
            $db = new DbConnect();
            $stmt = $db->connect()->query("SELECT idUser FROM user WHERE username='{$username}' and password='{$password}'");
            $user_row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                $iduser = $user_row['idUser'];
                echo $iduser . "<br>";

                $current_api_key = md5(rand(0, 999999999));
                $current_login_time = time();

                $this->setApiKey($current_api_key);
                $this->setLoginTime($current_login_time);
                $_SESSION["API_KEY"] = $this->getApiKey();
                $_SESSION["LOGIN_TIME"] = $this->getLoginTime();
                $_SESSION["IDUSER"] = $iduser;

                $stmt = $db->connect()->prepare("UPDATE user SET apikey=?, logintime=? WHERE idUser=?");
                $stmt->execute(array($this->getApiKey(), $this->getLoginTime(), $iduser));
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function isLoggedIn() {
        if ($_SESSION['API_KEY'] == $this->getApiKey()) {
            $result = time() - $_SESSION['LOGIN_TIME'];
            if ($result <= 600) {
                return true;
            } else {
                $iduser = $_SESSION["IDUSER"];

                $db = new DbConnect();
                $stmt = $db->connect()->prepare("UPDATE user SET apikey=?, logintime=? WHERE idUser=?");
                $stmt->execute(array('', 0, $iduser));
                header('location: index.php');
            }
        }
    }

    public function redirect($url) {
        header("location: $url");
    }

}

?>