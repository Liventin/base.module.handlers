<?php

defined('B_PROLOG_INCLUDED') || die;

$moduleId = basename(__DIR__);

return [
    $moduleId . '.handlers.service' => [
        'className' => Base\Module\Src\Handlers\HandlersService::class,
        'constructorParams' => [
            $moduleId
        ],
    ],
];
