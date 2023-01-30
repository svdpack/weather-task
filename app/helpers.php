<?php


use App\Core\ResponseJson;


if (!function_exists('response')) {
    function response(): ResponseJson
    {
        return new ResponseJson();
    }
}


if (!function_exists('env')) {
    function env(string $nameEnv, $default = null): mixed
    {
        return $_ENV[$nameEnv] ?? $default;
    }
}


if (!function_exists('isDebug')) {

    function isDebug(): bool
    {
        return env('APP_DEBUG', false);
    }
}

if (!function_exists('dd')) {
    function dd(...$args): void
    {
        if (!isDebug()) {
            return;
        }

        dump(...$args);
        die();
    }
}

if (!function_exists('dump')) {
    if (!isDebug()) {
        return;
    }

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


if (!function_exists('DateToMysql')) {

    /**
     * Функція, яка конвертує дату дд.мм.рр в рр-мм-дд
     *
     * @param $date  - дата
     * @return string -  дата Mysql
     */
    function DateToMysql($date): string
    {
        $dateArr = explode(".", $date);
        $newDate = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];

        return $newDate;
    }
}