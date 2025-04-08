<?php

namespace Base\Module\Service\Handlers;


interface HandlersService
{
    public const SERVICE_CODE = 'base.module.handlers.service';

    public function setHandlers(array $handlers): self;

    public function install(): void;

    public function unInstall(bool $saveData): void;

    public function reInstall(): void;
}
