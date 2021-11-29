<?php

require_once "Database.php";
class Model_Profile extends Model
{
    public function get_data()
    {
        if (array_key_exists('ID', $_SESSION)) {
            $connection = new Database();
            $user = $connection->Select('user', '*', 1, '`ID`='.$_SESSION['ID']);
            if ($user) {
                return $user;
            } else return false;
        } else return false;
    }
}