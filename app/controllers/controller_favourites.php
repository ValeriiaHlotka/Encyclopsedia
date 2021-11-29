<?php


class Controller_Favourites extends Controller
{
    function __construct()
    {
        $this->model = new Model_Favourites();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('view_favourites.php', 'view_template.php', $data);
    }
}