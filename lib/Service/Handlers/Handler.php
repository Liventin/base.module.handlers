<?php

namespace Base\Module\Service\Handlers;


use Attribute;

/**
 * @warning Имя метода-обработчика не должно совпадать с именем события
 * (сравнение без учёта регистра): такой метод HandlersService вызовет как
 * резолвер имени события (без аргументов), а не зарегистрирует как обработчик.
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Handler
{
    public function __construct(
        public readonly string $module,
        public readonly string $event,
        public readonly int $sort = 100,
    ) {
    }
}
