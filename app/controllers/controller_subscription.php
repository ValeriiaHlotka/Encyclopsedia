<?php


class Controller_Subscription extends Controller
{
    function action_index()
    {
        $this->view->generate('view_subscription.php', 'view_template.php');
    }
}