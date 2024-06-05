<?php

namespace src\controller;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use src\model\TodoModel;
use src\view\SmartyView;

class TodoController {
    private TodoModel $model;
    private SmartyView $view;

    public function __construct() {
        $this->model = new TodoModel();
        $this->view = new SmartyView();
    }

    /**
     * @throws Exception
     */
    public function index(): void {
        $tasks = $this->model->getTasks();
        error_log("Tasks in TodoController::index(): " . print_r($tasks, true));
        try {
            $this->view->render('index.tpl', ['tasks' => $tasks]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    #[NoReturn] public function add($task): void {
        error_log("Task to add in TodoController::add(): " . $task);
        $this->model->addTask($task);
        error_log("Tasks after adding in TodoController::add(): " . print_r($this->model->getTasks(), true));
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    #[NoReturn] public function delete($index): void {
        error_log("Index to delete in TodoController::delete(): " . $index);
        $this->model->deleteTask($index);
        error_log("Tasks after deleting in TodoController::delete(): " . print_r($this->model->getTasks(), true));
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}