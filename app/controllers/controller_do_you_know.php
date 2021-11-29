<?php


class Controller_Do_You_Know extends Controller
{
    function __construct()
    {
        $this->model = new Model_Do_You_Know();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_do_you_know.php', 'view_template.php', $data);
    }
}