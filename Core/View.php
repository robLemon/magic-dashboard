<?php

namespace Core;

/**
 * Class View
 * @package Core
 */
class View
{
    /**
     * Render a view file
     *
     * @param string $view
     * @param array $args
     * @throws \Exception
     */
    public static function render($view, array $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template
     * @param array $args
     */
    public static function renderTemplate($template, array $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}
