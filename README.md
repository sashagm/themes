<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/dt/sashagm/themes" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/v/sashagm/themes" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/l/sashagm/themes" alt="License"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/github/languages/code-size/sashagm/themes" alt="Code size"></a>
<a href="https://packagist.org/packages/sashagm/themes"><img src="https://img.shields.io/packagist/stars/sashagm/themes" alt="Code size"></a>

[![PHP Version](https://img.shields.io/badge/PHP-%2B8-blue)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-%2B10-red)](https://laravel.com/)

</p>

## Управление темами сайта с помощью пакета для Laravel

Наш пакет предоставляет удобный способ работы с мульти темами для вашего сайта. Вы можете легко создавать и изменять темы, а также управлять ими через наш интерфейс. Вы можете быстро переключаться между темами выбрав любую из ваших добавленых вариантов.

### Оглавление:

- [Требования](#требования)
- [Установка](#установка)
- [Использование](#использование)
  - [Настройка маршрутов](#настройка-маршрутов)
  - [Добавление ассетов](#добавление-ассетов)
  - [Настройка рендора](#настройка-рендора)
  - [Права доступа](#права-доступа)
  - [Кастомный гард](#кастомный-гард)
  - [Получение данных](#получение-данных)
  - [Способ вывода](#способ-вывода)
- [Дополнительные возможности](#дополнительные-возможности)
- [Тестирование](#тестирование)
- [Лицензия](#лицензия)

#### Требования

Основные требования для установки и корректной работы:

- `PHP` >= 8.0
- `Laravel` >= 10.x || 11.x
- `Composer` >= 2.4.x

#### Установка

Для установки пакета необходимо выполнить команды:

- composer require sashagm/themes
- php artisan themes:install

#### Использование

1. Для начала давайте определим нашу вспомогательную конфигурацию в `/config/custom.php`:

```php
    'admin_prefix'      => 'admin', // Префикс для маршрутов

    'check'             => [

        'active'        => true, // True Разрешить проверку или false Пропускать проверку
        'guard'         => 'web', // Укажите через какой гард будет работать

        'save_colum'    => 'id', // Поле для группы/роли или прав
        'save_value'    => [
            1, 2, 3
        ], // добавляем массив значений

    ],
```

2. Вспомогательная конфигурация `/config/themes.php` будет автоматически пересобираться каждый раз при активации ативной темы. Её лучше не трогать и не изменять для корректной работы.

3. Настроить тему в соответствии с вашими потребностями.

4. Активируйте вашу тему.

5. Чтобы понять какая текущая тема установлена просто вызовете константу `Themes`.

#### Настройка маршрутов

Для удобства и группировки маршрутов можно добавить данный код в `/routes/web.php`.
Данный код будет подключать файл маршрутов в зависимости от выбранной текущей темы.

```php

if (Themes){ require __DIR__ ."/". Themes .".php"; }

```

#### Настройка рендора

Для контроллеров так же все просто настраивается, для метода рендора можно использовать такой подход:
В данном случае подключит файл `Название темы/main/index.blade.php`.

```php

    view(Themes.'main.index');

```

#### Добавление ассетов

Если у вас используется один шаблон и несколько тем можно указать добавление ассетов:

```php

 <link href="{{ Themes.'/css/style.css' }}" rel="stylesheet" />

 <script src="{{ Themes.'/js/app.js' }}"></script>

```

#### Права доступа

Если необходимо ограничить доступ можно в конфигурации `/config/custom.php` изменить права доступа в разделе `check`:

```php

    'check'             => [

        'active'        => true, // True Разрешить проверку или false Пропускать проверку
        'guard'         => 'web', // Укажите через какой гард будет работать

        'save_colum'    => 'id', // Поле для группы/роли или прав
        'save_value'    => [
            1, 2, 3
        ], // добавляем массив значений

    ],

```

Добавляем массив с значениями для разных вариаций. Например для данного примера показано что пользователи с id `1,2,3` имеют права доступа.
Так же можно указать не id а roles, тогда можно настроить на группы/роли пользователей например `Админ, Модер, Редактор`.

#### Кастомный гард

Если необходимо использовать кастомный гард можно в конфигурации `/config/custom.php` изменить в разделе `check` за это отвечает параметр `guard` по дефолту настроен на `web` и возвращает текущего аутентифицированного пользователя для стандартной охраны web. Это используется для аутентификации пользователей, которые входят через веб-интерфейс.

Если указать кастомный гард то будет возвращать текущего аутентифицированного пользователя для охраны с именем кастомного гарда. Охрана с именем кастомного гарда может быть настроена в файле конфигурации Laravel для использования другой базы данных или другой модели пользователя.

Таким образом можно изменять подходящий гард для проверки прав доступа для Middleware тем.

#### Получение данных

Метод `getActiveThemeTitle()` возвращает заголовок текущей активной темы, если она существует.

Метод `getActiveThemeDescription()` возвращает описание текущей активной темы, если она существует.

Метод `getThemeInfo()` возвращает общую информацию о текущей активной теме, включая заголовок, описание, автора и версию.

Для вызова этих методов можно использовать следующий код:

```php
// получить заголовок текущей активной темы
$title = Themes::getActiveThemeTitle();

// получить описание текущей активной темы
$description = Themes::getActiveThemeDescription();

// получить общую информацию о текущей активной теме
$info = Themes::getThemeInfo();
```

Здесь мы используем статические методы модели Themes, чтобы получить нужную информацию о текущей активной теме. Для каждого метода мы вызываем соответствующий статический метод и сохраняем результат в переменную.

#### Способ вывода

Теперь вы можете дополнительно использовать варианты вызовов: `Themes`, `$app->themes()`, `$app->themes->get()` для получения текущей темы.

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

Themes - это программное обеспечение с открытым исходным кодом, лицензированное по [MIT license](LICENSE.md).
