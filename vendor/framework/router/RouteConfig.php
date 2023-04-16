<?
namespace vendor\framework\router;


class RouteConfig{

    public string $route;
    public string $controller;
    public string $action;
    public string $name;
    public string $midlleware;

    public function __construct(string $route, string $controller, string $action) {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function midlleware(string $midlleware)
    {
        $this->midlleware = $midlleware;
        return $this;
    }
}