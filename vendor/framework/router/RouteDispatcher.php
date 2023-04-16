<?

namespace vendor\framework\router;

use Exception;

class RouteDispatcher
{

    private RouteConfig $routeConfig;
    private string $requestUri = '/';
    private array $parametrMap = [];
    private array $parametrRequesMap = [];

    public function __construct(RouteConfig $routeConfig)
    {
        $this->routeConfig = $routeConfig;
    }

    public function process()
    {
        $this->saveRequestUri();
        $this->setParametrMap();
        $this->makeRegexRequest();
        if(@$this->requestUri[0] != '?'){
            return $this->run();
        }
    }

    private function saveRequestUri()
    {   
        if(isset($_SERVER["REQUEST_URI"])){
            if(isset($_SERVER["REQUEST_URI"][1]) && $_SERVER["REQUEST_URI"][1] == '/'){
                header("Location: /404");
                exit;
            }
            $this->requestUri = $this->cleaner($_SERVER["REQUEST_URI"]);
            $this->routeConfig->route = $this->cleaner($this->routeConfig->route);
        }
    }

    private function cleaner(string $str): string
    {
        return preg_replace("/(^\/)|(\/$)/", "", $str);;
    }

    private function setParametrMap()
    {
        $routeArray = explode('/', $this->routeConfig->route);
        foreach ($routeArray as $key => $value) {
            if (preg_match("/{.*}/", $value)) {
                $this->parametrMap[$key] = preg_replace("/(^{)|(}$)/", "", $value);
            }
        }
    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);
        foreach ($this->parametrMap as $key => $value) {
            if (!isset($requestUriArray[$key])) {
                return;
            }
            $this->parametrRequesMap[$value] = $requestUriArray[$key];
            $requestUriArray[$key] = "{.*}";
        }
        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    private function prepareRegex()
    {
        $this->requestUri = str_replace('/', "\/", $this->requestUri);
    }

    private function run()
    {
        if (preg_match("/$this->requestUri/", $this->routeConfig->route)) {
            try{
                $this->render();
            }
            catch(Exception $e){
                $e->getMessage();
            }
            finally{
                die;
            }
        }
        return false;
    }

    private function render()
    {
        $className = $this->routeConfig->controller;
        $action = $this->routeConfig->action;
        if(isset($this->routeConfig->name)){
            $name = $this->routeConfig->name;
            if($name != ""){
                $this->parametrRequesMap["name"] = $name;
            }
        }
        if(method_exists($className, $action)){
            echo (new $className)->$action(...$this->parametrRequesMap);
        }
        else{
            throw new Exception("Метод $action не существует в классе $className");
        }
    }
}
