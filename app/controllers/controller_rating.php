<?php


class Controller_Rating extends Controller
{
    function __construct()
    {
        $this->model = new Model_Rating();
        $this->view = new View();
    }

    function action_index()
    {
        $this->action_read();
    }

    function action_read()
    {
        $data = $this->model->get_data_by_param("read");
        $this->view->generate('view_rating.php', 'view_template.php', $data);
    }

    function action_unlocked()
    {
        $data = $this->model->get_data_by_param("unlocked");
        $this->view->generate('view_rating.php', 'view_template.php', $data);
    }

    function action_account()
    {
        $data = $this->model->get_data_by_param("account");
        $this->view->generate('view_rating.php', 'view_template.php', $data);
    }
}