<?php

namespace vendor\framework\firststart\filecreator;

class CreatePHP
{
    public function create($fileName)
    {
        $papka = explode('/', $fileName);
        $path = "";
        foreach ($papka as $name) {
            if (!strpos($name, '.')) {
                $path .= $name;
                if (!file_exists($path)) {
                    mkdir($path);
                }
                $path .= '/';
            } else {
                $handle = fopen($path . $name, "c");
                if (!strpos($path . $name, 'html')) {
                    $txt = "<?php";
                }
                ob_start();
                if (is_readable("vendor/framework/base/$name")) {
                    include "vendor/framework/base/$name";
                }
                $txt .= ob_get_contents();
                ob_end_clean();
                fwrite($handle, $txt);
                fclose($handle);
            }
        }
        return $handle;
    }
}
