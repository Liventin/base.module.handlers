<?php

/** @noinspection PhpUnused */

namespace Base\Module\Install;


use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\SystemException;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use Base\Module\Service\Tool\ClassList;
use Base\Module\Install\Interface\Install;
use Base\Module\Install\Interface\UnInstall;
use Base\Module\Install\Interface\ReInstall;
use Base\Module\Service\Container;
use Base\Module\Service\Handlers\HandlersService as IHandlersService;

class HandlersInstaller implements Install, UnInstall, ReInstall
{
    /**
     * @return array
     * @throws NotFoundExceptionInterface
     * @throws ObjectNotFoundException
     * @throws ReflectionException
     * @throws SystemException
     */
    private function getHandlers(): array
    {
        /** @var ClassList $classList */
        $classList = Container::get(ClassList::SERVICE_CODE);
        return $classList->setSubClassesFilter([])->getFromLib('Handlers');
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ObjectNotFoundException
     * @throws ReflectionException
     * @throws SystemException
     */
    public function install(): void
    {
        /** @var IHandlersService $handlersService */
        $handlersService = Container::get(IHandlersService::SERVICE_CODE);
        $handlersService->setHandlers($this->getHandlers())->install();
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ObjectNotFoundException
     * @throws ReflectionException
     * @throws SystemException
     */
    public function unInstall(bool $saveData): void
    {
        /** @var IHandlersService $handlersService */
        $handlersService = Container::get(IHandlersService::SERVICE_CODE);
        $handlersService->setHandlers($this->getHandlers())->unInstall($saveData);
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ObjectNotFoundException
     * @throws ReflectionException
     * @throws SystemException
     */
    public function reInstall(): void
    {
        /** @var IHandlersService $handlersService */
        $handlersService = Container::get(IHandlersService::SERVICE_CODE);
        $handlersService->setHandlers($this->getHandlers())->reInstall();
    }

    public function getInstallSort(): int
    {
        return 1000;
    }

    public function getUnInstallSort(): int
    {
        return 1000;
    }

    public function getReInstallSort(): int
    {
        return 1000;
    }
}
