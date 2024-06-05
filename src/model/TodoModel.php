<?php

namespace src\model;

class TodoModel {
    public function getTasks() {
        $tasks = $_SESSION['tasks'] ?? [];
        error_log("Tasks in TodoModel::getTasks(): " . print_r($tasks, true));
        return $tasks;
    }

    public function addTask($task): void {
        if (!empty($task)) {
            if (!isset($_SESSION['tasks'])) {
                $_SESSION['tasks'] = [];
            }
            $_SESSION['tasks'][] = $task;
            error_log("Task added in TodoModel::addTask(): " . $task);
            error_log("Tasks after adding in TodoModel::addTask(): " . print_r($_SESSION['tasks'], true));
        }
    }

    public function deleteTask($index): void {
        if (isset($_SESSION['tasks'][$index])) {
            error_log("Task to delete in TodoModel::deleteTask(): " . $_SESSION['tasks'][$index]);
            unset($_SESSION['tasks'][$index]);
            $_SESSION['tasks'] = array_values($_SESSION['tasks']);
            error_log("Tasks after deleting in TodoModel::deleteTask(): " . print_r($_SESSION['tasks'], true));
        }
    }
}