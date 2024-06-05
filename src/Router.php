<?php

namespace src;

use Exception;
use src\controller\TodoController;

class Router {

    /**
     * @throws Exception
     */
    public function route($method, $uri): void {
        error_log("Routing: Method: " . $method . ", URI: " . $uri);

        if ($method === 'GET' && $uri === '/') {
            $controller = new TodoController();
            try {
                $controller->index();
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
        } else if ($method === 'POST') {
            if (isset($_POST['task'])) {
                $controller = new TodoController();
                $controller->add($_POST['task']);
            } else if (isset($_POST['delete'])) {
                $controller = new TodoController();
                $controller->delete($_POST['delete']);
            } else {
                error_log("Invalid POST request: " . print_r($_POST, true));
            }
        } else {
            error_log("No route found for: Method: " . $method . ", URI: " . $uri);
        }
    }
}