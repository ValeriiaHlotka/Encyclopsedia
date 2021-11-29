<?php


class Controller_Search_Result extends Controller
{
    function __construct()
    {
        $this->model = new Model_Search_Results();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_search_result.php', 'view_template.php', $data);
    }
}