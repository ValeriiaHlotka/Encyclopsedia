<?php


class Controller_Subject extends Controller
{
    function __construct()
    {
        $this->model = new Model_Subject();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_subjects.php', 'view_template.php', $data);
    }

    function action_item($id) {
        $data = $this->model->get_data_by_param($id);
        $this->view->generate('view_subject.php', 'view_template.php', $data);
    }
}