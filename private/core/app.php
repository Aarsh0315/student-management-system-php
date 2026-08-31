<?php


class App
{
    protected $controller = "Landing";

    protected $method = "index";

    protected $params = array();


    public function __construct()
    {
        $URL = $this->getURL();

        // ...


        /* =========================
           CONTROLLER
        ========================= */

        if (!empty($URL[0])) {

            $controllerName = ucfirst($URL[0]);

            $controllerFile =
                "../private/controllers/"
                . $controllerName
                . ".php";


            if (file_exists($controllerFile)) {

                $this->controller = $controllerName;

                unset($URL[0]);

            }

        }


        /* =========================
           LOAD CONTROLLER
        ========================= */

        require_once "../private/controllers/"
            . $this->controller
            . ".php";


        $this->controller = new $this->controller;


        /* =========================
           METHOD
        ========================= */

        if (isset($URL[1])) {

            if (method_exists(
                $this->controller,
                $URL[1]
            )) {

                $this->method = $URL[1];

                unset($URL[1]);

            }

        }


        /* =========================
           PARAMETERS
        ========================= */

        $this->params =
            $URL
            ? array_values($URL)
            : [];


        /* =========================
           CALL CONTROLLER
        ========================= */

        call_user_func_array(
            [
                $this->controller,
                $this->method
            ],
            $this->params
        );
    }


    private function getURL()
    {
        if (isset($_GET['url'])) {

            $url = trim($_GET['url'], "/");

            return explode("/", $url);

        }

        return [];
    }
}