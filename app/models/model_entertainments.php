<?php

class Model_Entertainments extends Model
{
    public function get_data_by_param($param)
    {
        $marker = glob("entertainment/AR/markers/$param.*")[0];
        $model = glob("entertainment/AR/models/$param.*")[0];
        $str = file_get_contents("entertainment/AR/templates/marker.php");
        $str = str_replace("#MARKER", $marker, $str);
        $str = str_replace("#MODEL", $model, $str);
        return $str;
    }
}