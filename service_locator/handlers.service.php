<?php

defined('B_PROLOG_INCLUDED') || die;

$moduleId = basename(__DIR__);

return [
    $moduleId . '.class.list' => [
        'className' => Base\Module\Src\Handlers\HandlersService::class,
        'constructorParams' => [
            $moduleId
        ],
    ],
];
