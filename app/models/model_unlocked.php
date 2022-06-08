<?php

require_once "Database.php";
class Model_Unlocked extends Model
{
    public function get_data()
    {
        $connection = new Database();
        $unlocked = $connection->Query('SELECT unlocked.ID as id, entertainment.`MarkerLink` as marker, entertainment.`Name` as name from entertainment, unlocked where unlocked.entertainment = entertainment.id and unlocked.`User` = '. $_SESSION['ID'] . ' order by unlocked.date desc');
        if ($unlocked) {
            $name = basename($unlocked[0][0][1]);
            $name = substr($name, 0, strpos($name, '.'));
            foreach (glob("media/images/".$name.".*") as $filename) {
                $unlocked[0][0][] = $filename;
            }
            return $unlocked[0];
        } else
            return false;
    }

    public function get_data_by_param($param)
    {
        $connection = new Database();
        $unlocked = $connection->Query('SELECT unlocked.ID, entertainment.`MarkerLink`, entertainment.`ModelLink`, entertainment.`Name`, entertainment.id from entertainment, unlocked where unlocked.entertainment = entertainment.id and unlocked.ID = '. $param . ' order by unlocked.date desc');
        if ($unlocked) {
            $name = basename($unlocked[0][0][1]);
            $name = substr($name, 0, strpos($name, '.'));
            foreach (glob("media/images/".$name.".*") as $filename) {
                $unlocked[0][0][] = $filename;
            }
            foreach (glob("media/markers/".$name.".*") as $filename)
            {
                $unlocked[0][0][] = "/".$filename;
            }
            $url = "https://encyclopsedia.azurewebsites.net/entertainments/show/".$name;
            $unlocked[0][0][] = $url;
            if (!glob("media/qr/$name.*"))
            {
                include "QR.php";
                $qr = new QR();
                $qr->URL($url);
                $qr->saveImage("media/qr/$name.png");
            }
            $unlocked[0][0][] = "/media/qr/$name.png";
            return $unlocked[0];
        } else
            return false;
    }
}