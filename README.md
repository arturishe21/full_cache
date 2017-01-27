
В composer.json добавляем в блок require
```json
 "vis/full_cache": "1.*"
```

Выполняем
```json
composer update
```

Добавляем в app.php в массив providers
```php
  Vis\Compare\CompareServiceProvider::class,
```

Использование
сверху
```php
    use Vis\Compare\Facades\Compare;
```

методы:
```php

```
