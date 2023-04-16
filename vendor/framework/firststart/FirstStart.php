<?php

namespace vendor\framework\firststart;

use vendor\framework\firststart\filecreator\CreatePHP;

class FirstStart
{
    private $startDir = [
        "assets",
        "assets/css",
        "assets/fonts",
        "assets/images",
        "config",
        "core",
        "core/controllers",
        "core/models",
        "core/route",
        "core/view",
        "core/view/user",
        "core/view/user/html",
        "core/view/user/blocks",
        "core/view/admin",
        "core/view/admin/html",
        "core/view/admin/blocks",
        "core/view/moder",
        "core/view/moder/html",
        "core/view/moder/blocks",
        "core/view/error",
        "core/view/error/html",
        "core/view/error/blocks",
        "core/view/email",
        "core/view/email/html",
        "core/view/email/blocks",
        "log"
    ];
    private $startFiles = [
        "config/config.php",
        "config/mail.php",
        "core/route/web.php",
        "core/controllers/MainController.php",
        "core/view/user/html/mainUI.php",
        "core/view/error/html/404UI.php"
    ];
    public function __construct(bool $need = false)
    {
        if ($need) {
            $this->createAllDir();
            $this->chechStartFile();
        }
        return $need;
    }

    private function createAllDir()
    {
        foreach ($this->startDir as $path) {
            if (!file_exists($path)) {
                mkdir($path);
            }
        }
    }

    private function chechStartFile()
    {
        $constructor = new CreatePHP();
        foreach ($this->startFiles as $file) {
            if (!file_exists($file))
                $constructor->create($file);
        }
    }
}
