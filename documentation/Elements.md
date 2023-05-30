# Elements

[Навігація](#documentation-navigation)

Елементи — це найменші компоненти на атомарному рівні. Вони відображаються функцією `print element()`. Вони є будівельними частинками модулів і блоків.

## Anchor Element

Елемент прив’язки — можна використовувати для посилання на іншу сторінку або розділ на тій самій сторінці.

```php
<?php
print_element( 'anchor', [
    'text'      => 'Anchor Text',
    'href'      => 'https://example.com',
    'target'    => '_blank',
    'class'     => [ 'wds-element', 'wds-element-anchor' ],
] );
?>
```

## Badge Element

Елемент значка складається з простих елементів html, які можна використовувати для відображення мітки або статусу.

```php
<?php
print_element( 'badge', [
    'class'         => [ 'wds-element', 'wds-element-badge' ],
	'id'            => '',
	'text'          => 'Badge Text',
	'href'          => '',
	'target'        => '',
	'type'          => 'default',
	'icon'          => [],
	'icon_position' => 'after', // before, after.
] );
?>
```

## Blockquote Element

Елемент blockquote складається з простих елементів html, які можна використовувати для відображення цитати.

```php
<?php
print_element( 'blockquote', [
	'class' => [ 'wds-element', 'wds-element-blockquote' ],
	'id'    => '',
	'cite'  => '',
	'quote' => '',
] );
?>
```

## Button Element

Можна використовувати для відображення кнопки.

```php
<?php
print_element( 'button', [
	'class'         => [ 'wds-element', 'wds-element-button' ],
	'id'            => '',
	'title'         => '',
	'href'          => '',
	'target'        => '',
	'type'          => '',
	'icon'          => [],
	'icon_position' => 'after', // before, after.
	'role'          => '',
	'aria'          => [
		'controls' => '',
		'disabled' => '',
		'expanded' => '',
		'label'    => '',
	],
] );
?>
```

## Content Element

Можна використовувати для відображення вмісту.

```php
<?php
print_element( 'content', [
	'class'   => [ 'wds-element', 'wds-element-content' ],
	'id'      => '',
	'content' => '',
] );
?>
```

## Heading Element

Можна використовувати для відображення заголовка. Ви можете визначити рівень заголовка, передавши параметр `level`.

```php
<?php
print_element( 'heading', [
	'class' => [ 'wds-element', 'wds-element-heading' ],
	'id'    => '',
	'text'  => false,
	'level' => 2,
] );
?>
```

## Icon Element

Можна використовувати для відображення піктограми SVG.

```php
<?php
print_element( 'icon', [
	'class'    => [ 'wds-element', 'wds-element-icon' ],
	'svg_args' => [],
] );
?>
```

## Image Element

Для відображення зображення можна використовувати ідентифікатор вкладення або URL-адресу зображення.

```php
<?php
print_element( 'image', [
	'class'         => [ 'wds-element', 'wds-element-image' ],
	'attachment_id' => false,
	'src'           => false,
	'size'          => 'large',
	'loading'       => 'lazy',
	'alt'           => '',
] );
?>
```

## Input Element

Можна використовувати для відображення поля введення. Ви можете визначити тип введення, передавши параметр `type`.

```php
<?php
print_element( 'input', [
	'class'       => [ 'wds-element', 'wds-element-button' ],
	'type'        => 'text',
	'name'        => '',
	'value'       => '',
	'placeholder' => false,
	'disabled'    => false,
	'required'    => false,
] );
?>
```

## Label Element

Можна використовувати для відображення мітки.

```php
<?php
print_element( 'label', [
	'class' => [ 'wds-element', 'wds-element-button' ],
	'text'  => false,
	'for'   => false,
] );
?>
```

## Logo Element

Можна використовувати для відображення логотипу. Елемент логотипу використовує глобальний логотип сайту, що встановлений в настроювачі теми.

```php
<?php
print_element( 'logo', [
	'class'     => [ 'wds-element', 'wds-element-logo' ],
	'logo_name' => '',
	'loading'   => 'eager',
	'alt'       => get_bloginfo( 'name' ) . ' logo',
] );
?>
```

## Select Element

Можна використовувати для відображення поля вибору. Природно, параметри передаються як масив параметра `options`.

```php
<?php
print_element( 'select', [
	'class'    => [ 'wds-element', 'wds-element-select' ],
	'name'     => false,
	'value'    => false,
	'disabled' => false,
	'required' => false,
	'options'  => [],
] );
?>
```

## TextArea Element

Можна використовувати для відображення поля textarea.

```php
<?php
print_element( 'textarea', [
	'class'       => [ 'wds-element', 'wds-element-textarea' ],
	'name'        => '',
	'value'       => '',
	'placeholder' => false,
	'disabled'    => false,
	'required'    => false,
	'readonly'    => false,
] );
?>
```

## Навігація

-   [Огляд](Home.md)
-   [Філософія](Philosophy.md)
-   [Функції](Functions.md)
-   [Блоки](Blocks.md)
-   [Модулі](Modules.md)
-   [Елементи](Elements.md)
-   [Скрипти](Scripts.md)
-   [WP-CLI](WP-CLI.md)
