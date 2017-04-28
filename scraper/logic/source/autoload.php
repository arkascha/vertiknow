<?php

namespace VertiKnow\Scraper;

spl_autoload_register(function ($class_name) {
    $class_path = sprintf(
        './logic/source/%s.php',
         str_replace('_', '/', substr($class_name, strrpos($class_name, '\\')+1))
    );
    if (file_exists($class_path)) {
        include $class_path;
    }
});
