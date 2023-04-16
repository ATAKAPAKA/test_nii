
use vendor\framework\router\Route;

Route::get("/", "MainController@displayMainPages")->name("user.mainUI");
Route::get("/404", "MainController@error404");
