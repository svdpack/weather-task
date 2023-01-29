<?php

if (!function_exists('dd')) {
    function dd(...$args): void
    {
        dump(...$args);
        die();
    }
}

if (!function_exists('dump')) {
    function dump(...$args): void
    {
        foreach ($args as $arg) {
            echo "<pre style='background-color: black; color: #56f62e; padding: 3px;'>";
            ob_start();
            if (empty($arg)) {
                var_dump($arg);
            } else {
                if (is_string($arg)) {
                    echo '"'.$arg.'"';
                } else {
                    print_r($arg);
                }
            }

            $content = ob_get_clean();
            echo htmlspecialchars($content);
            echo "</pre>";
        }
    }
}