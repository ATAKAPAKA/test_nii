<?php

namespace vendor\framework\app;

use vendor\framework\router\Route;
use vendor\framework\router\RouteDispatcher;

require $_SERVER["DOCUMENT_ROOT"] . "/vendor/framework/config/config.php";

class App
{
    public static function run()
    {
        $loadet = null;
        $RouteName = "getRoute" . ucfirst(strtolower($_SERVER["REQUEST_METHOD"]));
        $routs = Route::$RouteName();
        if (count($routs) == 0) {
            echo "<br>Ни одного маршрута не создано <br>Что бы добавить маршрут в файле 'core/route/web.php' напишите: <br>'Route::{метод(get|post)}(\"Маршрут (/main)\", \"{Имя класса}@{Вызываемый метод}\")(Далее опционально в зависимости от реализации класса)->name(\"error.404\")->middleware();'";
        }
        foreach ($routs as $routeConfig) {
            $routeDispatcher = new RouteDispatcher($routeConfig);
            $loadet = $routeDispatcher->process();
        }
        if ($loadet === false) {
            header("Location: /404");
        }
    }
}
