<?php

namespace core\controllers;

use core\models\Company;
use core\models\Products;
use vendor\framework\controller\Controller;
use vendor\framework\view\Page;

class MainController extends Controller
{
    public function displayMainPages($name = "", array $data = [])
    {
        $data = [
            "title" => "Список компаний",
            "description" => "",
            "keywords" => "",
            "pageData" => Company::select("id", "name", "director", "status", "inn", "ogrn", "address", "profit")->get()
        ];
        return (new Page($name, ...$data))->getContent();
    }

    public function error404()
    {
        return "404";
    }

    public function displayCompany($id = [])
    {
        $company = $this->noData(Company::find($id));
        if (!$company) {
            header("Location: /404");
            die;
        }
        $data = [
            "title" => $company["name"],
            "description" => $company["description"],
            "pageData" => [
                "products" => Products::select("*")->where("company_id", $id)->get(),
                "company" => $company
            ]
        ];
        return (new Page("user.companyUI", ...$data))->getContent();
    }

    public function displayProduct($id = [])
    {
        $product = $this->noData(Products::find($id));
        if (!$product) {
            header("Location: /404");
            die;
        }
        $data = [
            "title" => $product["name"],
            "description" => $product["description"],
            "keywords" => str_replace(';', ',', str_replace('"', '', $product["key_words"])),
            "pageData" => [
                "product" => $product
            ]
        ];
        return (new Page("user.productUI", ...$data))->getContent();
    }

    private function noData($serch)
    {
        foreach ($serch as $key => $item) {
            if ($item == null || $item == 0 || $item == '-') {
                $serch[$key] = "Нет данных";
            }
        }
        return $serch;
    }
}
