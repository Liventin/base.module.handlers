# base.module.handlers

<table>
<tr>
<td>
<a href="https://github.com/Liventin/base.module">Bitrix Base Module</a>
</td>
</tr>
</table>

install | update

```
"require": {
    "liventin/base.module.handlers": "^1.0.0"
}
```
redirect (optional)
```
"extra": {
  "service-redirect": {
    "liventin/base.module.handlers": "module.name",
  }
}
```

PhpStorm Live Template 
```php
<?php
namespace ${MODULE_PROVIDER_CAMMAL_CASE}\\${MODULE_CODE_CAMMAL_CASE}\Handlers;

use ${MODULE_PROVIDER_CAMMAL_CASE}\\${MODULE_CODE_CAMMAL_CASE}\Service\Handlers\Handler;

class HandlerExample
{
    #[Handler(module: 'main', event: 'OnBeforeUserAdd')]
    public static function onUserAdd(array &${DS}fields): void
    {
        // logic
    }
}

```

## Вкладка «Обработчики» в опциях модуля

Вместе с пакетом `base.module.options.provider.table` при установке в опции модуля
добавляется вкладка **«Обработчики»** с реестром обработчиков:

- строка на каждый обработчик модуля: модуль/событие, класс, метод, статус
  (установлен/не установлен), приоритет;
- по клику на строку раскрывается список **всех** зарегистрированных в системе
  обработчиков этого события (включая чужие модули), отсортированных по приоритету;
- собственные обработчики модуля визуально подсвечены.
