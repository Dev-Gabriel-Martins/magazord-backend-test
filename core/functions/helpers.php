<?php

/*
 * Implementação do "Dump and Die" para depuração. 
 */
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

load_env();

/**
 * Carrega variáveis do arquivo .env para $GLOBALS['DOT_ENV'].
 *
 * @param string $path Caminho para o arquivo .env
 * @return void
 */
function load_env(string $path = __DIR__ . '/../../.env'): void
{
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue;
        }
        [$name, $value] = array_map('trim', $parts);
        $GLOBALS['DOT_ENV'][$name] = $value;
    }
}

/*
 * Busca uma variável do .env carregada.
 */
function env($key, $default = false)
{   
    return isset($GLOBALS['DOT_ENV'][$key]) ? $GLOBALS['DOT_ENV'][$key] : $default;
}
