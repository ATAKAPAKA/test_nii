<?

use vendor\framework\app\App;
use vendor\framework\firststart\FirstStart;

require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
$config = "config/config.php";
$route = "core/route/web.php";
// new FirstStart(true);
include_once $config;
include_once $route;

session_start();
// if (!isset($_SESSION["id"])) {
// }
$_SESSION["id"] = session_id();

$thisSession = session_id();

if ($_SESSION["id"] == $thisSession) {
    App::run();
} else {
    echo "false";
    return;
}
