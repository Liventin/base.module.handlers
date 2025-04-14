# base.module.handlers

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
},