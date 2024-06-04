<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

use Smarty\Smarty;
use src\SmartyView;
use Smarty\Exception as ExceptionAlias;
use Smarty\Extension\CoreExtension;
use Smarty\Extension\DefaultExtension;

$smarty = new SmartyView();

$smarty->setTemplateDir( './templates/' );
$smarty->setCompileDir( './cache/templates/' );

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

//$smarty->addPluginsDir( ROOT . 'libs/smarty-plugins/' );

session_start();

try {
    $smarty->setCaching(Smarty::CACHING_OFF);

    $smarty->display('extends:layouts/layout.tpl|index.tpl');
} catch (ExceptionAlias|Exception $e ) {
    die( $e->getMessage() );
}