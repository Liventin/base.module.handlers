<?php

/** @noinspection PhpUnused */

namespace Base\Module\Src\Handlers;

use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\SystemException;
use ReflectionClass;
use ReflectionException;
use Base\Module\Service\Handlers\HandlersService as IHandlersService;
use Base\Module\Service\LazyService;

#[LazyService(serviceCode: IHandlersService::SERVICE_CODE, constructorParams: ['moduleId' => LazyService::MODULE_ID])]
class HandlersService implements IHandlersService
{
    private string $moduleId;
    private ?object $handlerAttribute = null;
    private array $handlers = [];
    private const OPTION_NAME = 'event_handlers';

    public function __construct(string $moduleId)
    {
        $this->moduleId = $moduleId;
    }

    /**
     * @return void
     * @throws ArgumentOutOfRangeException
     * @throws SystemException
     */
    public function install(): void
    {
        $this->unInstall(false);

        $eventManager = EventManager::getInstance();
        $existingHandlers = [];

        foreach ($this->handlers as $handler) {
            $handlerKey = $this->getHandlerKey($handler);

            $eventManager->registerEventHandler(
                $handler['module'],
                $handler['event'],
                $this->moduleId,
                $handler['class'],
                $handler['method'],
                $handler['sort']
            );

            $existingHandlers[$handlerKey] = $handler;
        }

        Option::set($this->moduleId, self::OPTION_NAME, serialize($existingHandlers));
    }

    /**
     * @throws SystemException
     */
    public function unInstall(bool $saveData): void
    {
        $eventManager = EventManager::getInstance();
        $handlers = $this->getStoredHandlers();

        foreach ($handlers as $handler) {
            $eventManager->unRegisterEventHandler(
                $handler['module'],
                $handler['event'],
                $this->moduleId,
                $handler['class'],
                $handler['method']
            );
        }

        Option::delete($this->moduleId, ['name' => self::OPTION_NAME]);
    }

    /**
     * @return void
     * @throws ArgumentOutOfRangeException
     * @throws SystemException
     */
    public function reInstall(): void
    {
        $this->install();
    }

    private function getStoredHandlers(): array
    {
        $serialized = Option::get($this->moduleId, self::OPTION_NAME);
        if (empty($serialized)) {
            return [];
        }

        $handlers = unserialize($serialized, ['allowed_classes' => false]);
        return is_array($handlers) ? $handlers : [];
    }

    private function getHandlerKey(array $handler): string
    {
        return md5(
            $handler['module'] . '|' .
            $handler['event'] . '|' .
            $handler['class'] . '|' .
            $handler['method']
        );
    }

    /**
     * @throws ReflectionException
     */
    public function setHandlers(array $handlers): self
    {
        foreach ($handlers as $className) {
            $reflection = new ReflectionClass($className);
            foreach ($reflection->getMethods() as $method) {
                if (!$method->isStatic()) {
                    continue;
                }

                $attributes = $method->getAttributes();
                foreach ($attributes as $attribute) {
                    $handler = $attribute->newInstance();
                    if (!isset($handler->module, $handler->event, $handler->sort)) {
                        continue;
                    }

                    if ($this->handlerAttribute &&
                        ($this->handlerAttribute->module !== $handler->module ||
                            $this->handlerAttribute->event !== $handler->event)) {
                        continue;
                    }

                    $this->handlers[] = [
                        'module' => $handler->module,
                        'event' => $handler->event,
                        'sort' => $handler->sort,
                        'class' => $className,
                        'method' => $method->getName(),
                    ];
                }
            }
        }

        usort($this->handlers, static fn($a, $b) => $a['sort'] <=> $b['sort']);
        return $this;
    }
}
