<?php

defined('B_PROLOG_INCLUDED') || die;

return [
    'base.module.handlers.service' => [
        'className' => Base\Module\Src\Handlers\HandlersService::class,
        'constructorParams' => [
            'base.module'
        ],
    ],
];
