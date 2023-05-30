# Блоки

[Навігація](#documentation-navigation)

Структура файлів і папок для блоку така:

```php
src/blocks
  blockname
    blockname.php // render template
    block.json // block registration
    editor.js // editor JavaScript
    editor.scss // editor styles (in SCSS, to be compiled on build)
    script.js // frontend scripts
    styles.scss // frontend styles
```

Все вищезазначене скомпільовано за допомогою WP Scripts і розміщено в папці `/build`.

## Допоміжні функції, які використовуються при частковому рендерингу блоку (`blockname.php`)

```php
use function demchco\blocks\print_module;
use function demchco\blocks\print_element;
use function demchco\blocks\get_acf_fields;
use function demchco\blocks\setup_block_defaults;
```

Кожна з функцій виконуватиме завдання, яке вказується в їх імені.

-   `print_module` виводить модуль
-   `print_element` виводить елемент
-   `get_acf_fields` поверне значення, передані в поля ACF (у формі масиву)
-   `setup_block_defaults` поверне `$abs_defaults` як оновлений масив і `$abs_atts` як відформатований рядок, використовуючи такі функції:
    -   `get_block_classes` поверне класи для блоку з Gutenberg для наступного:
        -   `$block['className']`
        -   `$block['backgroundColor']`
        -   `$block['textColor']`
    -   `get_formatted_atts` поверне рядок атрибутів

## Параметри за замовчуванням

Кожен блок встановлює власні узгоджені параметри за замовчуванням. Це масив, що складається (як правило) з наступних пар ключ/значення.

-   class => масив класів
-   allowed_innerblocks => масив блоків, які можна вкладати у цьому блоці
-   id => int; встановлений ID блоку в редакторі Гутенберга
-   fields => масив полів, якщо блок візуалізується за допомогою `print_block()`

Цей масив виглядає так:

```php
$abs_defaults = [
	'class'               => [ 'demchco-block', 'demchco-block-accordion' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];
```

## Попередній вигляд блоку

Блоки відтворять свій попередній вигляд в інструменті вибору блоків Gutenberg, коли зображення попереднього перегляду блоку буде розміщено в `/assets/images/block-previews/blockname-preview.jpg`.

Для будь-яких нових блоків, які ви створюєте, вам потрібно буде додати знімок екрана цього блоку до свого проекту та оновити ім’я файлу у файлі візуалізації блоку.

## Вкладені блоки

Блоки можуть приймати внутрішні блоки. Це можна вимкнути кількома способами; найпростіше просто оновити масив `$abs_defaults` за допомогою `'allowed_innerblocks' => []`. Крім того, ви також можете встановити `'jsx' => false` всередині `block.json` цього блоку.

Внутрішні блоки можуть бути лише в одному місці – до або після часткової візуалізації вашого блоку.

«Dropzone» внутрішнього блоку буде відображено з пунктирною рамкою, щоб її було видно в адмінці. Це додається через глобальний `admin-styles.scss` в папці `./assets/global-styles`. Він буде створений автоматично разом з блоками.

**Примітка:** Не забудьте додати назви дозволених блоків до групи полів ACF, щоб ваші клієнти знали, які блоки можна використовувати.

## Навігація

-   [Огляд](Home.md)
-   [Філософія](Philosophy.md)
-   [Функції](Functions.md)
-   [Блоки](Blocks.md)
-   [Модулі](Modules.md)
-   [Елементи](Elements.md)
-   [Скрипти](Scripts.md)
-   [WP-CLI](WP-CLI.md)
