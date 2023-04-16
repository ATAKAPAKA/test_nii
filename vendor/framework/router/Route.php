<?
namespace vendor\framework\router;

class Route{

    private static array $routeGet = [];
    private static array $routePost = [];
    private static array $routePut = [];
    private static array $routeDelete = [];
    private static array $routeHead = [];
    private static array $routeOptions = [];
    private static array $routePatch = [];
    // private static array $routeView = [];
    
    public static function get(string $requestUrl, string $class_metod = ""): RouteConfig
    {
        $class_metod = explode('@', $class_metod);
        $routConfig = new RouteConfig($requestUrl, "core\controllers\\".$class_metod[0], $class_metod[1]);
        self::$routeGet[] = $routConfig;
        return $routConfig;
    }

    public static function post(string $requestUrl, string $class_metod = ""): RouteConfig
    {
        $class_metod = explode('@', $class_metod);
        $routConfig = new RouteConfig($requestUrl, "core\controllers\\".$class_metod[0], $class_metod[1]);
        self::$routePost[] = $routConfig;
        return $routConfig;
    }

    public static function put(string $requestUrl, string $class_metod = ""): RouteConfig
    {
        $class_metod = explode('@', $class_metod);
        $routConfig = new RouteConfig($requestUrl, "core\controllers\\".$class_metod[0], $class_metod[1]);
        self::$routePut[] = $routConfig;
        return $routConfig;
    }

    public static function delete(string $requestUrl, string $class_metod = ""): RouteConfig
    {
        $class_metod = explode('@', $class_metod);
        $routConfig = new RouteConfig($requestUrl, "core\controllers\\".$class_metod[0], $class_metod[1]);
        self::$routeDelete[] = $routConfig;
        return $routConfig;
    }

    public static function head(string $requestUrl, string $class_metod = ""): RouteConfig
    {
        $class_metod = explode('@', $class_metod);
        $routConfig = new RouteConfig($requestUrl, "core\controllers\\".$class_metod[0], $class_metod[1]);
        self::$routeHead[] = $routConfig;
        return $routConfig;
    }

    public static function options(string $requestUrl, string $class_metod = ""): RouteConfig
    {
        $class_metod = explode('@', $class_metod);
        $routConfig = new RouteConfig($requestUrl, "core\controllers\\".$class_metod[0], $class_metod[1]);
        self::$routeOptions[] = $routConfig;
        return $routConfig;
    }

    public static function patch(string $requestUrl, string $class_metod = ""): RouteConfig
    {
        $class_metod = explode('@', $class_metod);
        $routConfig = new RouteConfig($requestUrl, "core\controllers\\".$class_metod[0], $class_metod[1]);
        self::$routePatch[] = $routConfig;
        return $routConfig;
    }
    
    // public static function view(string $requestUrl, array $class_metod = []): RouteConfig
    // {
    //     $routConfig = new RouteConfig($requestUrl, $class_metod[0], $class_metod[1]);
    //     self::$routePost[] = $routConfig;
    //     return $routConfig;
    // }

    public static function redirect()
    {
        
    }

    public static function getRouteGet(): array
    {
        return  self::$routeGet;
    }

    public static function getRoutePost(): array
    {
        return  self::$routePost;
    }

    // public static function getRouteView(): array
    // {
    //     return  self::$routeGet;
    // }
}