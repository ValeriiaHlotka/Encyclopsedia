<?php


class Controller_Unlocked extends Controller
{
    function __construct()
    {
        $this->model = new Model_Unlocked();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_unlocked.php', 'view_template.php', $data);
    }
}