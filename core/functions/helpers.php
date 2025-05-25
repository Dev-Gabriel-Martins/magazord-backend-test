<?php

/*
 * Minha implementação do "Dump and Die" para depuração. 
 */

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}