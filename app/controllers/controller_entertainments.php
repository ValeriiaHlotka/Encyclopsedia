<?php


class Controller_Entertainments extends Controller
{
    function __construct()
    {
        $this->model = new Model_Entertainments();
        $this->view = new View();
    }

    function action_show($param)
    {
        $data = $this->model->get_data_by_param($param);
        $this->view->generate('view_entertainments.php', 'view_template.php', $data);
    }
}