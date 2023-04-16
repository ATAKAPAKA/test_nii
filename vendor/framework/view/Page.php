<?php

namespace vendor\framework\view;

class Page
{
    public string $pageUI = "moder.moderUI";
    public string $title = "";
    public string $description = "";
    public string $keywords = "";
    public string $ogUrl = "https://o-polyakova.ru/";
    public string $ogDescription = "";
    public string $ogImage = "";
    public string $ogTitle = "";
    private $header = USER_BLOCKS . "header.php";
    private $head = USER_BLOCKS . "head.php";
    private $footer = USER_BLOCKS . "footer.php";
    private $mobile_bur = USER_BLOCKS . "mobilebur.php";
    public array $formData = [];
    public array $pageData = [];

    public function __construct(string $pageUI = "user.mainUI", ...$data)
    {
        $this->pageUI = $pageUI;
        foreach ($data as $key => $item) {
            $this->$key = $item;
        }
    }

    private function checkIncluses($php)
    {
        
    }

    private function createPattern($path)
    {
        $cache = $_SERVER["DOCUMENT_ROOT"] . "/vendor/framework/view/cache.php";
        $fp = fopen($path, 'r+');
        $php = fread($fp, filesize($path));
        fclose($fp);
        $php = str_replace("{{", "<? echo ", $php);
        $php = str_replace("}}", " ?>", $php);
        $php = str_replace("{{", "<? echo ", $php);
        $php = str_replace("}}", " ?>", $php);
        $fp = fopen($cache, 'r+');
        ftruncate($fp, 0);
        fwrite($fp, $php);
        fclose($fp);
        return $cache;
    }

    private function includeBlocks($includes)
    {
        if ($this->pageUI != "") {
            foreach ($includes as $item) {
                if (is_readable($item)) {
                    include $this->createPattern($item);
                }
            }
        } else {
            include_once $this->encodePath("error.noUI");
        }
    }

    public function getContent()
    {
        $srv = $_SERVER["DOCUMENT_ROOT"];
        $includes = [
            $srv . $this->head,
            $srv . $this->header,
            $this->encodePath($this->pageUI),
            $srv . $this->mobile_bur,
            $srv . $this->footer
        ];
        ob_start();
        $this->includeBlocks($includes);
        $html = ob_get_contents();
        ob_end_clean();
        // header("Content-Security-Policy: default-src https:");
        return $html;
    }

    private function encodePath(string $str)
    {
        $str = $_SERVER['DOCUMENT_ROOT'] . PATH_VIEW . str_replace('.', '/html/', $str) . ".php";
        if (!is_readable($str)) {
            $str = "error.noUI";
            $str = $_SERVER['DOCUMENT_ROOT'] . PATH_VIEW . str_replace('.', '/html/', $str) . ".php";
        }
        return $str;
    }
}
