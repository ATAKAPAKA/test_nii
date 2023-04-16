
namespace core\controllers;

use vendor\framework\view\Page;
use vendor\framework\controller\Controller;

class MainController extends Controller
{
    public function displayMainPages($name = "", array $data = [])
    {
        $data = ["title" => "Start",
        "description" => "",
        "keywords" => ""];
        return (new Page($name, ...$data))->getContent();
    }    
    
    public function error404()
    {
        echo "404";
    }
}
