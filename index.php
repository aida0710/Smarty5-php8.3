<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

use src\SmartyView;
use Smarty\Exception as ExceptionAlias;
use Smarty\Extension\CoreExtension;
use Smarty\Extension\DefaultExtension;
use Smarty\Smarty;

$smarty = new SmartyView();

$smarty->setTemplateDir( ROOT . '/templates/' );
$smarty->setCompileDir( ROOT . 'data/cache/templates/' );
$smarty->setExtensions([
    new CoreExtension(),
    new DefaultExtension(),
]);

if (!is_writable(ROOT . 'data/cache/templates/')) {
    die('Cache directory is not writable.');
}

//$smarty->addPluginsDir( ROOT . 'libs/smarty-plugins/' );

session_start();

try {
    $smarty->setCaching(Smarty::CACHING_OFF);

    $smarty->display('extends:layouts/layout.tpl|index.tpl');
} catch (ExceptionAlias|Exception $e ) {
    die( $e->getMessage() );
}