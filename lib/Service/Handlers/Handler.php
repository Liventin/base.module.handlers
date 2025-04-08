<?php

namespace Base\Module\Service\Handlers;


use Attribute;

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
