<?php


class Controller_Profile extends Controller
{
    function __construct()
    {
        $this->model = new Model_Profile();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_profile.php', 'view_template.php', $data);
    }
}