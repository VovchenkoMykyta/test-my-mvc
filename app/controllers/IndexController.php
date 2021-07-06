<?php


namespace controllers;


use core\BaseController;
use core\View;

class IndexController extends BaseController
{
    public function index()
    {
        $view = new View();
        $view->render('index_index_view.php', 'default_view.php');
    }

}