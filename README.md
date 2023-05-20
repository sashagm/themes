<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/dt/sashagm/themes" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/v/sashagm/themes" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/l/sashagm/themes" alt="License"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/github/languages/code-size/sashagm/themes" alt="Code size"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/stars/sashagm/themes" alt="Code size"></a>
</p>


## Управление темами сайта с помощью пакета для Laravel
Наш пакет предоставляет удобный способ работы с мульти темами для вашего сайта. Вы можете легко создавать и изменять темы, а также управлять ими через наш интерфейс.

### Оглавление:

- [Установка](#установка)
- [Использование](#использование)
- [Дополнительные возможности](#дополнительные-возможности)
- [Тестирование](#тестирование)
- [Лицензия](#лицензия)

#### Установка

Для установки пакета необходимо выполнить команды:

- composer require sashagm/themes
- php artisan themes:install

#### Использование

1. Для начала давайте определим нашу вспомогательную конфигурацию в `/config/custom.php`:

```php

 'admin_prefix' => 'admin', // Укажите префикс для роутов
```

2. Вспомогательная конфигурация `/config/themes.php` будет автоматически пересобираться каждый раз при активации ативной темы.

3. Настроить тему в соответствии с вашими потребностями.

4. Активируйте вашу тему.


#### Дополнительные возможности

Наш пакет предоставляет ряд дополнительных возможностей, которые могут быть полезны при работе с темами:

- `php artisan themes:install` - Данная команда установит все необходимые компоненты пакета (Управление темами).
- `php artisan themes:create` - Данная команда создаст описание новой темы для сайта.
- `php artisan themes:delete {id}` - Данная команда удалит тему сайта.'.
- `php artisan themes:get {id}` - Данная команда выведет информацию о тему сайта.

#### Тестирование

Для проверки работоспособности можно выполнить специальную команду:

- ./vendor/bin/phpunit --configuration phpunit.xml

#### Лицензия

Themes - это программное обеспечение с открытым исходным кодом, лицензированное по [MIT license](LICENSE.md ).
