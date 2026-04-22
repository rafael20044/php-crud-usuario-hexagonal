<?php


final class View
{

    public function __construct() {}

    public static function render(string $template, array $data = []): void
    {
        $file = __DIR__ . '/view/' . $template . '.php';

        if (!file_exists($file)) {
            throw new RuntimeException("View file {$file} not found");
        }

        extract($data, EXTR_SKIP);

        require $file;
    }

    public static function redirect(string $route): void
    {
        header('Location: ?route=' . urlencode($route));
        exit;
    }
}
