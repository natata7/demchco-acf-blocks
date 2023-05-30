# Огляд

[Навігація](#documentation-navigation)

Для правильної роботи цього плагіна потрібен ACF 6.0+ [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/).

## Доступні блоки

-   [Accordion](#accordion)
-   [Cards (Repeater)](#cards-repeater)
-   [Carousel](#carousel)
-   [Logo Grid](#logo-grid)
-   [Quotes](#quotes)
-   [Side-by-Side](#side-by-side)
-   [Tabs](#tabs)

## Як визначаються та реєструються блоки

Блоки в плагіні Demchco ACF Blocks використовують новий (WordPress версії 5.8 і вище) метод реєстрації `block.json`.

## Особливості блоків

Кожен блок ACF підтримує наступне:

-   Колір фону (з використанням керування кольором фону Гутенберга)
-   Колір тексту (з використанням керування кольором тексту Гутенберга)
-   Внутрішні блоки (якщо дозволено в параметрах блоку)

Ці параметри є доповненням до рідних налаштувань Gutenberg:

- Спеціальні класи CSS
- Якір HTML (ID)
- Переміщення блоку Drag-n-Drop

## Рекомендації та найкращі практики

Щоб стилізувати ці блоки разом із темою, рекомендований наступний підхід.

Глобальні стилі (шрифти, кольори тощо) слід додати до SCSS вашої теми.

Глобальні стилі блоків слід додати до `/assets/global-styles/frontend-styles.scss` (і/або `admin-styles.scss`, залежно від обставин).

Стилі блоків із обмеженою областю слід додати до `style.scss` або `editor.scss` кожного блоку відповідно.

## Створення блоків Гутенберга за допомогою плагіна ACF Blocks

### Реєстрація блоку

У файлі `block.json` (у нашому випадку `/src/blocks/block-name/block.json`) реєструється блок разом із налаштуванням його параметрів.

```json
{
	"name": "demchco/accordion",
	"title": "Accordion",
	"description": "A block used to show an Accordion.",
	"editorStyle": "file:./editor.css",
	"editorScript": "file:./editor.js",
	"style": "file:./style-script.css",
	"script": "file:./script.js",
	"category": "Demchco",
	"icon": "table-row-before",
	"apiVersion": 2,
	"keywords": [ "accordion", "block" ],
	"acf": {
		"mode": "auto",
		"renderTemplate": "accordion.php"
	},
	"supports": {
		"align": false,
		"anchor": true,
		"color": true,
		"customClassName": true,
		"jsx": true
	},
	"example": {
		"attributes": {
			"mode": "preview",
			"data": {
				"_is_preview": "true"
			}
		}
	}
}
```

### Збірка

Ви можете побачити, що міститься в `block.json` і файли в папці `/src/blocks/block-name/` - це буде створено WP Scripts і скопійовано (разом зі скомпільованими стилями та сценаріями) до тієї самої папки всередині `/build/`.

Починаючи з WordPress 5.8, WordPress дозволяє реєструвати блок за допомогою файлу `block.json`. Зазвичай він розміщується в папці, яка містить усі файли блоку. Розробники ACF називають це ["портативний блок"](https://gladdy.uk/blog/2022/07/24/creating-portable-acf-blocks/) (хоча він не такий портативний, як можна сподіватись). Усі файли в папці будь-якого блоку повинні містити всі елементи для його компіляції, мінімізації та/або збірки – після цього скрипти перемістять їх до папки `/build`, здебільшого з тією самою структурою. Це робиться за допомогою пакета NPM `"@wordpress/scripts` і сценарію NPM `wp scripts`.

### Назва блоку

```json
"name": "demchco/accordion",
```

Важливо відзначити, що кожен блок повинен мати простір імен. У цьому прикладі ім’я записане як `"name": "namespace/blockname"`. Наш простір імен — `demchco`; назва блоку - `accordion`. Технічно ви можете не використовувати простір імен, і ACF автоматично використовуватиме замість нього простір імен `acf`.

### ACF атрибути

```json
"acf": {
	"mode": "auto",
	"renderTemplate": "accordion.php"
},
```

**Mode**
Цей параметр дає змогу вказати, як блок відображатиметься під час його додавання до Gutenberg.

Варіанти: `preview`, `edit`, `auto`.

**Render Template**
`renderTemplate` повідомляє WordPress, з яким файлом відобразити цей блок. Оскільки файл знаходиться в тій же папці (у цьому випадку), що й `block.json`, шлях не потрібен.

### Функціонал, що підтримує блок

```json
"supports": {
	"align": false,
	"anchor": true,
	"color": true,
	"customClassName": true,
	"jsx": true
},
```

#### align

Align слід залишити як `false`. Класи `.alignwide`, `.alignfull` тощо не функціональні для блоків у модулі ACF Blocks, оскільки ми вручну визначаємо вирівнювання блоків у SCSS.

#### anchor

Дає змогу вказати, чи бажаєте ви, щоб ваш блок підтримував поле `anchor`, дозволяючи вам визначити спеціальний ідентифікатор для цього блоку.
[Документація WP](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/#anchor)

#### color

Дозволяє вказати, чи бажаєте ви, щоб ваш блок підтримував елементи керування блоком `color`, увімкнувши параметри кольору фону та кольору тексту. Кольори будуть отримані з кольорів теми, визначених у `theme.json`.
[Документація WP](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/#color)

#### customClassName

Дозволяє вказати, чи бажаєте ви, щоб ваш блок підтримував поле блоку `customClassName`, дозволяючи користувачеві додавати власні класи до блоку в редакторі Gutenberg.
[Документація WP](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/#customclassname)

#### jsx

Це дозволяє компоненту `<InnerBlocks />` функціонувати в Gutenberg. Якщо це вимкнено, внутрішні блоки перестануть працювати для цього блоку.
[Документація WP](https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/nested-blocks-inner-blocks/)

### Стилі та скрипти блоку

```json
"editorStyle": "file:./editor.css",
"editorScript": "file:./editor.js",
"style": "file:./style-script.css",
"script": "file:./script.js",
```

Це файли, які WordPress підʼєднає разом з вашим зареєстрованим блоком. Ви можете мати окремі стилі та сценарії як для передньої, так і для внутрішньої частини WordPress.

`"editorStyle": "file:./editor.css"` і `"editorScript": "file:./editor.js",` завантажуватимуться **лише** в області адміністратора WordPress, однак `"style ": "file:./style-script.css",` і `"script": "file:./script.js",` завантажуватимуться як на фронт-енді, так і у бек-енді WordPress.

Ви також можете підключити раніше зареєстровані сценарії за допомогою їх опису (тобто:`'my-super-admin-javascript'`) або комбінації опису/назви файлу.[Докладніше.](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#editor-script)

#### Категорії блоків

Додати спеціальну категорію блоку так само просто, як підключитися до `block_categories_all` ([введено в WordPress 5.8](https://developer.wordpress.org/reference/hooks/block_categories_all/)). Роблячи це, ми можемо визначити спеціальну категорію в `block.json`, щоб ми могли зберігати наші блоки на власній поличці в меню блоків.

Категорія блоку зареєстрована в `/inc/helpers/register-block-category.php`, код показано нижче.

```php
<?php

add_filter(
	'block_categories_all',
	function( $categories ) {

		// Adding a new category.
		$categories[] = array(
			'slug'  => 'demchco',
			'title' => 'Demchco Blocks',
		);

		return $categories;
	}
);
```

Вибрати цю категорію так само просто, як додати нову категорію до свого блоку:

```json
"category": "demchco",
```

Ви можете повернутися до стандартного значення, встановивши для блоку `"category": "theme",`, або оновити її, замінивши title категорії.

## Block Details

**Внутрішні блоки:** усі ці блоки підтримують `<InnerBlocks />`, який відображатиметься (за замовчуванням) над самими елементами блоку. Блоки `core/heading` і `core/paragraph` дозволені як `<InnerBlocks />`. Дозволені внутрішні блоки та їх розташування можна налаштувати на свій смак.

### Accordion

Блок «Акордеон» дозволяє додавати кілька елементів «акордеон» до блоку, який відображатиметься в одному стовпці.

### Announcement

Блок для відображення анонсів подій у тексті публікацій.
**Має жорсткі залежності від структури полів теми spravdi.**

### Cards Repeater

Блок ретранслятора карток використовує повторювач, щоб ви могли додавати до блоку скільки завгодно карток. Елементи, які підтримуються кожною карткою:

-   Image
-   Eyebrow
-   Heading
-   Meta
-   Content
-   Button

### Carousel

Блок каруселі дозволяє створювати до 12 слайдів у каруселі. Під капотом використовується [Swiper](https://swiperjs.com).

### Crosslink

Блок для відображення картки публікації у тексті публікацій.
**Має жорсткі залежності від структури полів теми spravdi.**

### Logo Grid

The Logo Grid Block allows you to add as many logos as you wish - they will be displayed in a grid.

### Quotes

The Quotes Block allows you to add as many quotes as you wish - they will be displayed stacked.

### Side-by-Side

Блок Side-by-Side дозволяє створювати три різні комбінації макетів. Медіа + текст. Текст + Медіа. Або Text + Text через редактор WYSIWYG і поле завантаження медіа.

## Навігація

-   [Огляд](Home.md)
-   [Філософія](Philosophy.md)
-   [Функції](Functions.md)
-   [Блоки](Blocks.md)
-   [Модулі](Modules.md)
-   [Елементи](Elements.md)
-   [Скрипти](Scripts.md)
-   [WP-CLI](WP-CLI.md)
