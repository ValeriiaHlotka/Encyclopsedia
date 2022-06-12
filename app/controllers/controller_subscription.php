<?php


class Controller_Subscription extends Controller
{
    function __construct()
    {
        $this->model = new Model_Subscription();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_subscription.php', 'view_template.php', $data);
    }
}