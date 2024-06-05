<?php

namespace src;

class TodoController {
    public function addTask($task) {
        if (!empty($task)) {
            if (!isset($_SESSION['tasks'])) {
                $_SESSION['tasks'] = [];
            }
            $_SESSION['tasks'][] = $task;
        }
        return $this->getTasks(); // タスクリストを返す
    }

    public function getTasks() {
        return $_SESSION['tasks'] ?? [];
    }

    public function deleteTask($index): void {
        if (isset($_SESSION['tasks'][$index])) {
            unset($_SESSION['tasks'][$index]);
            $_SESSION['tasks'] = array_values($_SESSION['tasks']);
        }
    }

    public function logTasks(): void {
        error_log("Current tasks: " . print_r($_SESSION['tasks'], true));
    }
}