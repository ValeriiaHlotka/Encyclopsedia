<?php

require_once "Database.php";
class Model_Subscription extends Model
{
    public function get_data()
    {
        if (array_key_exists('ID', $_SESSION))
        {
            $connection = new Database();
            $account = $connection->Query('SELECT user.`Account`, subscriptions.`id`, plan.`name` from user,subscriptions,plan where subscriptions.user = user.id and subscriptions.`id` = plan.`id` and subscriptions.`end` > "'.date('Y-m-d H:i:s').'" and user.`ID` = '.$_SESSION['ID']);
            if ($account) {
                return $account[0][0];
            }
            else return false;
        } else return false;
    }
}