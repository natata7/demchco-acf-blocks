# DEMCHCO ACF Blocks

With the advent of Gutenberg in WordPress, Advanced Custom Fields stepped up to help make the process of creating custom blocks easier and faster. This plugin creates a set of custom blocks with basic styles for you to customize.

## Documentation

You'll find information around installation and getting started below. Start there to get everything installed and working. Once that's done, [go here for more detailed documentation](./documentation/Home.md).

## Included Blocks

This plugin includes the following blocks:

-   Accordion
-   Call to Action
-   Cards (Repeater, up to 3)
-   Carousel
-   Logo Grid
-   Quotes
-   Side-by-Side
-   Tabs

WDS ACF Blocks is bundled with [Style Lint](https://stylelint.io/), [ESLint](https://eslint.org/), and [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) linting rulesets – plus, it passes both WCAG 2.1AA and Section 508 standards out of the box. This plugin uses WP Scripts to handle the build process for the blocks.

To better manage ACF Field Groups, the plugin supports [synchronized JSON](https://www.advancedcustomfields.com/resources/synchronized-json/) for Advanced Custom Fields.


## Getting Started

### Prerequisites

Because the plugin compiles and bundles assets via NPM scripts, basic knowledge of the command line and the following dependencies are required: [Node LTS](https://nodejs.org) and NPM.

> #### IMPORTANT
>
> This plugin relies entirely on Advanced Custom Fields _Pro_ 6.0+ for WordPress. The Pro version is _required_, along with a version _greater_ than > 6.0 - it will not work with any ACF 5.x version. Additonally, the WebDevStudios theme `wd_s` is _required_ - there are dependencies in the theme that this plugin relies on.


## Installation

Follow these steps:

From the command line, change directories to your new plugin directory:

```bash
cd /plugins/demchco-acf-blocks
```

Install plugin dependencies and trigger an initial build:

```bash
npm i
```

### NPM Scripts

From the command line, type any of the following to perform an action:

`npm run build` - Compile and build all assets.

`npm run start` - Automatically compile the SCSS & Tailwind to CSS; minifies the JS. This will also build all the blocks using WP Scripts.

