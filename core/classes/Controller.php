<?php

namespace core\classes;

use Latte\Engine;

class Controller
{
    /** Carrega as view pela engine do Latte */
    public function render(string $template, array $params = [])
    {
        $latte = new Engine;

        $this->setStatusCode($params);
        $latte->setAutoRefresh(true);

        $latte->render(__DIR__ . '/../../app/views/' . $template . '.php', $params);
    }

    private function setStatusCode($params)
    {
        $code = $params['code'] ?? 200;
        http_response_code($code);
    }


    public function renderNotFound()
    {
       $this->render("not-found", ['code' => 404]);
    }
}
