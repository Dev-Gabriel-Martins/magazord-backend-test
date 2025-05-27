<?php

namespace core\classes;

use Latte\Engine;

class Controller
{
    /** Carrega as view pela engine do Latte */
    public function render(string $template, array $params = [])
    {
        $latte = new Engine;
        //$latte->setTempDirectory(__DIR__ . '/../../app/views/build/');
        $latte->render(__DIR__ . '/../../app/views/' . $template . '.latte', $params);
    }

}