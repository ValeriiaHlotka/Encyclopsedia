<?php


class Controller_Post extends Controller
{
    function __construct()
    {
        $this->model = new Model_Post();
        $this->view = new View();
    }

    function action_index()
    {}

    function action_item($id) {
        $data = $this->model->get_data_by_param($id);
        $this->view->generate('view_post.php', 'view_template.php', $data);
    }
}