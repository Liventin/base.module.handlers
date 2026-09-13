<?php

namespace Base\Module\Options\TabHandlers;

use Base\Module\Options\TabHandlers;
use Base\Module\Service\Options\Option;
use Bitrix\Main\Localization\Loc;

class SeparatorHandlersRegistry implements Option
{
    public static function getId(): string
    {
        return 'handlers_separator';
    }

    public static function getName(): string
    {
        return Loc::getMessage('MODULE_OPTION_HANDLERS_SEPARATOR_TITLE');
    }

    public static function getType(): string
    {
        return 'separator';
    }

    public static function getTabId(): string
    {
        return TabHandlers::getId();
    }

    public static function getSort(): int
    {
        return 100;
    }

    public static function getParams(): array
    {
        return [];
    }
}
