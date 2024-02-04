<?php

require_once __DIR__ . '/DataSource.php';

class Member
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        $this->ds = new DataSource();
    }

    function getMemberById($memberId)
    {
        $query = "select * FROM registered_users WHERE id = ?";
        $paramType = "i";
        $paramArray = array($memberId);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);

        return $memberResult;
    }

    function getMemberByUsername($username)
    {
        $query = "select * FROM registered_users WHERE user_name = ?";
        $paramType = "s";
        $paramArray = array($username);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);

        return $memberResult;
    }

    function getMemberByEmail($email)
    {
        $query = "SELECT * FROM registered_users WHERE email = ?";
        $paramType = "s";
        $paramArray = array($email);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);

        return $memberResult;
    }

    public function processLogin($username, $password) {
        $query = "SELECT * FROM registered_users WHERE user_name = ? OR email = ?";
        $paramType = "ss";
        $paramArray = array($username, $username);
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
        if(!empty($memberResult)) {
            $hashedPassword = $memberResult[0]["password"];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["userId"] = $memberResult[0]["id"];
                return true;
            }
        }
        return false;
    }

    public function processRegister($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO registered_users SET user_name = ?, email = ?, password = ?";
        $paramType = "sss";
        $paramArray = array($username, $email, $hashedPassword);
        $registerResult = $this->ds->insert($query, $paramType, $paramArray);
        return $registerResult;
    }

    public function createCode() {
        $stringSpace = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $pieces = [];
        $max = strlen($stringSpace) - 1;
        for($i=0; $i<8; ++$i) {
            $pieces[] = $stringSpace[random_int(0,$max)];
        }
        return implode('',$pieces);
    }

    public function saveCode($email, $code) {
        $query = "UPDATE registered_users SET code = ? WHERE  email = ?";
        $paramType = "ss";
        $paramArray = array($code, $email);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        return $memberResult;
    }

    public function checkCode($email, $code) {
        $query = "SELECT code FROM registered_users WHERE email = ?";
        $paramType = "s";
        $paramArray = array($email);
        $result = $this->ds->select($query, $paramType, $paramArray);

        $savedCode = $result[0]["code"];
        $_SESSION["savedCode"] = $savedCode;
        if ($savedCode == $code) {
            $hashedPassword = password_hash($code, PASSWORD_BCRYPT);
            $query = "UPDATE registered_users SET password = ? , code = '' WHERE  email = ?";
            $paramType = "ss";
            $paramArray = array($hashedPassword , $email);
            $memberResult = $this->ds->insert($query, $paramType, $paramArray);
            return true;
        }
        return false;
    }

    public function saveKey($email, $key, $expDate) {
        $query = "INSERT INTO password_reset_temp SET `email` = ? , `key` = ? , `expDate` = ?";
        $paramType = "sss";
        $paramArray = array($email, $key, $expDate);
        $memberResult = $this->ds->insert($query, $paramType, $paramArray);
        return $memberResult;
    }
    
    public function checkKey($email, $key) {
        $query = "SELECT `key` FROM password_reset_temp WHERE `email` = ?";
        $paramType = "s";
        $paramArray = array($email);
        $result = $this->ds->select($query, $paramType, $paramArray);

        $savedKey = $result[0]["key"];
        if ($savedKey == $key) {
            return true;
        }
        return false;
    }

    public function getKey($email) {
        $query = "SELECT * FROM password_reset_temp WHERE email = ?";
        $paramType = "s";
        $paramArray = array($email);
        $result = $this->ds->select($query, $paramType, $paramArray);
        if (! empty($result)) {
            return $result;
        }
    }

    public function updatePassword($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE registered_users SET password = ? WHERE  email = ?";
        $paramType = "ss";
        $paramArray = array($hashedPassword , $email);
        $memberResult = $this->ds->update($query, $paramType, $paramArray);

        $query = "DELETE FROM password_reset_temp WHERE email = ?";
        $paramType = "s";
        $paramArray = array($email);
        $result = $this->ds->delete($query, $paramType, $paramArray);            

    }

}
