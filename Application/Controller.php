<?php

namespace Application;


abstract class Controller
{
    protected $view;
    protected $messages;

    abstract function index();

    public function __construct()
    {
        $this->view = new View();
        //$this->_messages = new \Plasticbrain\FlashMessages\FlashMessages();
    }

    public function redirect($url = array())
    {
        $path = "";
        if ($url["controller"]) {
            $path .= $url["controller"];
        }
        if ($url["action"]) {
            $path .= "/" . $url["action"];
        }
        return APP_URL . $path;
        //header("LOCATION: ".APP_URL.$path);
    }

}