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
    "liventin/base.module.handlers": "dev-main"
}
"repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:liventin/base.module.handlers"
    }
]
```
redirect (optional)
```
"extra": {
  "service-redirect": {
    "liventin/base.module.handlers": "module.name",
  }
}
```