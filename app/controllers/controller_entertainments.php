<?php


class Controller_Entertainments extends Controller
{
    function action_index()
    {
        $this->view->generate('', 'view_entertainments.php');
    }
}