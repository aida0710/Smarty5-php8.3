<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use Smarty\Exception as ExceptionAlias;
use Smarty\Extension\CoreExtension;
use Smarty\Extension\DefaultExtension;
use Smarty\Smarty;
use src\SmartyView;
use src\TestFunctions;
use src\TodoController;

$smarty = new SmartyView();
$smarty->setTemplateDir('./templates/');
$smarty->setCompileDir('./cache/templates/');
$smarty->setExtensions([
    new CoreExtension(),
    new DefaultExtension(),
]);

if (!file_exists('./cache/templates/')) {
    mkdir('./cache/templates/', 0700, true);
}

if (!is_writable('./cache/templates/')) {
    die('キャッシュ ディレクトリは書き込み可能ではありません');
}

(new TestFunctions())->allExecuteFunction();

session_start();

$todoController = new TodoController();

// タスクの追加処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $tasks = $todoController->addTask($task);
    $todoController->logTasks();
    header("Location: index.php"); // タスクの追加後にリダイレクト
    exit();
} else {
    $tasks = $todoController->getTasks();
    $todoController->logTasks();
}
$todoController->logTasks();

// タスクの削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $index = $_POST['delete'];
    $todoController->deleteTask($index);
}

// タスクリストの取得
$tasks = $todoController->getTasks();

try {
    $smarty->setCaching(Smarty::CACHING_OFF);
    $smarty->assign('tasks', $tasks);
    $smarty->display('extends:layouts/layout.tpl|index.tpl');
} catch (ExceptionAlias|Exception $e) {
    die($e->getMessage());
}