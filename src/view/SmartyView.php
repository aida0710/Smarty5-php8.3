<?php

namespace src\view;

use Smarty\Exception;
use Smarty\Extension\CoreExtension;
use Smarty\Extension\DefaultExtension;
use Smarty\Smarty;

class SmartyView {
    private Smarty $smarty;

    public function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('./templates/');
        $this->smarty->setCompileDir('./cache/templates/');
        $this->smarty->setExtensions([
            new CoreExtension(),
            new DefaultExtension(),
        ]);

        if (!file_exists('./cache/templates/')) {
            mkdir('./cache/templates/', 0700, true);
        }

        if (!is_writable('./cache/templates/')) {
            die('キャッシュ ディレクトリは書き込み可能ではありません');
        }
    }

    /**
     * @throws \Exception
     */
    public function render($template, $data = []): void {
        $this->smarty->assign($data);
        try {
            $this->smarty->display($template);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}