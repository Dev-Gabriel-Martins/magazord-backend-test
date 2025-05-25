<?php 
namespace app\controlles;

use core\classes\Controller;

class HomeController extends Controller
{
    public function index()
    {
        echo "<h1>Estamos dentro da controller</h1>";
    }
}

