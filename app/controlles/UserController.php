<?php 

namespace app\controlles;

use core\classes\Controller;

class UserController extends Controller
{
    public function index()
    {
        echo "<h1>Estamos dentro da controller User</h1>";
    }

    public function show($id)
    {
        echo "<h1>User: $id</h1>";
    }
}