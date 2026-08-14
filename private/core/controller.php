<?php

class Controller
{
    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        require "../private/views/" . $name . ".view.php";
    }


    public function model($name)
    {
        require_once "../private/models/" . $name . ".php";

        return new $name();
    }
}