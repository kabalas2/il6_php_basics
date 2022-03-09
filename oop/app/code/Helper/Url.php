<?php

declare(strict_types=1);

namespace Helper;

class Url
{
    /**
     * @param string $route
     */
    public static function redirect(string $route): void
    {
        header('Location: ' . BASE_URL . $route);
        exit;
    }

    /**
     * @param string $path
     * @param string|null $parm
     * @return string
     */
    public static function link(string $path, ?string $parm = null): string
    {
        $link = BASE_URL . $path;
        if ($parm !== null) {
            $link .= '/' . $parm;
        }
        return $link;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function slug(string $string): string
    {
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string);
        return $string;
    }
}
