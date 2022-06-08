<?php

require_once "Database.php";
class Model_Rating extends Model
{
    public function get_data_by_param($param)
    {
        $connection = new Database();
        if ($param === "read")
            $data = $connection->Query('SELECT count(viewing.`ID`) as count, user.`nickname` as user from viewing right join user on viewing.user = user.id group by user.`nickname` order by count desc');
        else if ($param === "unlocked")
            $data = $connection->Query('SELECT count(unlocked.`ID`) as count, user.`nickname` as user from unlocked right join user on unlocked.user = user.id group by user.`nickname` order by count desc');
        else if ($param === "account")
            $data = $connection->Query('SELECT user.`account` as account, user.`nickname` as user from user order by account desc');

        if ($data) {
            return $data;
        } else
            return false;
    }
}