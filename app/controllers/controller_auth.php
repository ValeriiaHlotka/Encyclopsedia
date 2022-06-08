<?php


class Controller_Auth extends Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {
        $this->view->generate('view_auth.php', 'view_template.php');
    }
}