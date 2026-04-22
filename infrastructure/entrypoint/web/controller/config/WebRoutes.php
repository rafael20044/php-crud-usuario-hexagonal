<?php

class WebRoutes{

    public function __construct() {}

    /** @return array<string,array<string,string>> */
    public static function getRouter():array{
        return [
            'home' => ['method' => 'GET', 'action' => 'home'],
            'users.store' => ['method' => 'POST', 'action' => 'store'],
            'users.index' => ['method' => 'GET', 'action' => 'index'],
            'users.show' => ['method' => 'GET', 'action' => 'show'],
            'users.update' => ['method' => 'POST', 'action' => 'update'],
            'users.delete' => ['method' => 'POST', 'action' => 'delete'],

            'auth.login' => ['method' => 'GET', 'action' => 'login'],
            'auth.authenticate' => ['method' => 'POST', 'action' => 'authenticate'],
            'auth.logout' => ['method' => 'GET', 'action' => 'logout'],
            'auth.forgot' => ['method' => 'GET', 'action' => 'forgot'],
            'auth.forgot.send' => ['method' => 'POST', 'action' => 'forgot.send']
        ];
    }
}