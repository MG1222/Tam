<?php

namespace Library\Core;

use JetBrains\PhpStorm\NoReturn;

class AbstractController
{
    public function display(string $template, array $data = []): void
    {
        // transform keys of $data to variables
        extract($data);
        

        require "src/App/View/layout.phtml";
    }
    
    #[NoReturn] public function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit();
    }
}