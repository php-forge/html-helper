<p align="center">
    <a href="https://github.com/php-forge/html-helper" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/121752654?s=200&v=4" height="100px">
    </a>
    <h1 align="center">Awesome HTML Helpers Code Generator for PHP.</h1>
    <br>
</p>

<p align="center">
    <a href="https://github.com/php-forge/html-helper/actions/workflows/build.yml" target="_blank">
        <img src="https://github.com/php-forge/html-helper/actions/workflows/build.yml/badge.svg" alt="PHPUnit">
    </a>
    <a href="https://codecov.io/gh/php-forge/html-helper" target="_blank">
        <img src="https://codecov.io/gh/php-forge/html-helper/branch/main/graph/badge.svg?token=MF0XUGVLYC" alt="Codecov">
    </a>
    <a href="https://dashboard.stryker-mutator.io/reports/github.com/php-forge/html-helper/main" target="_blank">
        <img src="https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fphp-forge%2Fhtml-helper%2Fmain" alt="Infection">
    </a>
    <a href="https://github.com/php-forge/html-helper/actions/workflows/static.yml" target="_blank">
        <img src="https://github.com/php-forge/html-helper/actions/workflows/static.yml/badge.svg" alt="Psalm">
    </a>
    <a href="https://shepherd.dev/github/php-forge/html-helper" target="_blank">
        <img src="https://shepherd.dev/github/php-forge/html-helper/coverage.svg" alt="Psalm Coverage">
    </a>
    <a href="https://github.styleci.io/repos/764671311?branch=main">
        <img src="https://github.styleci.io/repos/764671311/shield?branch=main" alt="Style ci">
    </a>    
</p>

HTML Helper is a PHP library that simplifies the creation of HTML elements. It provides a set of classes to generate
HTML attributes, encode content, sanitize HTML content, and more.


## Installation

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```shell
composer require --prefer-dist php-forge/html-helper:^0.1
```

or add

```json
"php-forge/html-helper": "^0.1"
```

to the require section of your `composer.json` file. 

## Usage

### Add CSS classes

The `CssClasses::class` helper can be used to add CSS classes to an HTML element.

The method accepts three parameters:

- `attributes:` (array): The HTML attributes of the element.
- `classes:` (array|string): The CSS classes to add.
- `overwrite:` (bool): Whether to overwrite the `class` attribute or not. For default, it is `false`.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\CssClasses;

private array $attributes = [];

$classes = CssClasses::add($this->attributes, ['btn', 'btn-primary', 'btn-lg']);
```

Overwriting the `class` attribute:

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\CssClasses;

private array $attributes = ['class' => 'btn'];

$classes = CssClasses::add($this->attributes, ['btn-primary', 'btn-lg'], true);
```

### Convert regular expression to pattern

The `Utils::class` helper can be used to normalize a regular expression.

The method accepts one parameter:

- `regexp:` (string): The pattern to normalize.
- `delimiter:` (string): The delimiter to use. For default, it is `null`.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Utils;

$pattern = Utils::convertToPattern('/([a-z0-9-]+)/im'); // return: `([a-z0-9-]+)`
```

### Encode content

The `Encode::class` helper can be used to encode HTML content.

The method accepts tree parameters:

- `content:` (string): The content to encode.
- `doubleEncode:` (bool): Whether to double encode the content or not. For default, it is `true`.
- `charset:` (string): The charset to use. For default, it is `UTF-8`.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Encode;

$content = Encode::html('<script>alert("Hello, World!")</script>');
```

### Encode value

The `Encode::class` helper can be used to encode HTML value.

The method accepts tree parameters:

- `value:` (string): The value to encode.
- `doubleEncode:` (bool): Whether to double encode the value or not. For default, it is `true`.
- `charset:` (string): The charset to use. For default, it is `UTF-8`.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Encode;

$value = Encode::value('<script>alert("Hello, World!")</script>');
```

### Get short class name

The `Utils::class` helper can be used to get the short class name.

The method accepts one parameter:

- `class:` (string): The class name to get the short name.
- `suffix:` (string): Whether to append the `::class` suffix to the class name. 
  For default, it is `true`. If it is `false`, the method will return the short name without the `::class` suffix.
- `lowercase:` (bool): Whether to convert the class name to lowercase or not. 
  For default, it is `false`.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Utils;

$shortName = Utils::getShortClassName('PHPForge\Html\Helper\Utils'); // return: `Utils::class`
```

### Generate arrayable name

The `ArrayableName::class` helper can be used to generate an arrayable name.

The method accepts one parameter:

- `name:` (string): The name to generate.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Utils;

$name = Utils::generateArrayableName('name');
```

### Generate input id

The `Utils::class` helper can be used to generate an input id.

The method accepts tree parameters:

- `fieldModel:` (string): The name of the field model.
- `property:` (string): The name of the property.
- `charset:` (string): The charset to use. For default, it is `UTF-8`.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Utils;

$id = Utils::generateInputId('user', 'name');
```

### Generate input name

The `Utils::class` helper can be used to generate an input name.

The method accepts tree parameters:

- `fieldModel:` (string): The name of the field model.
- `property:` (string): The name of the property.
- `arrayable:` (bool): Whether the name is arrayable or not. For default, it is `false`.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Utils;

$name = Utils::generateInputName('user', 'name');
```

### Sanitize content

The `Sanitize::class` helper can be used to sanitize HTML content.

The method accepts one parameter:

- `content:` (...string|RenderInterface): The content to sanitize. It can be a string or an object that implements the
  `RenderInterface::class`.  

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Sanitize;

$content = Sanitize::html('<script>alert("Hello, World!")</script>');
```

### Render HTML attributes

The `Attributes::class` helper can be used to `render` HTML attributes in a programmatic way.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Attributes;

$attributes = Attributes::render(
    [
        'class' => 'btn btn-primary',
        'id' => 'submit-button',
        'disabled' => true,
    ]
);
```

### Render Template

The `Template::class` helper can be used to render a template.

The method accepts two parameters:

- `template:` (string): The template to render.
- `tokenValues:` (array): The token values to replace in the template.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Template;

$template = '{{prefix}}\n{{tag}}\n{{suffix}}';
$tokenValues = [
    '{{prefix}}' => 'prefix',
    '{{tag}}' => '<div>content</div>',
    '{{suffix}}' => 'suffix',
];

$content = Template::render($template, $tokenValues);
```

> `\n` is a new line character, and it is used to separate the tokens in the template.

### Validate value in list

The `Validator::class` helper can be used to validate a value in a list.

The method accepts tree parameters:

- `value:` (mixed): The value to validate.
- `exceptionMessage:` (string): The exception message to throw if the value is not in the list.
- `list:` (...string): The list to validate the value.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Validator;

$value = Validator::inList('php', 'The value is not in the list.', 'php', 'javascript', 'typescript');
```

### Validate value iterable

The `Validator::class` helper can be used to validate an iterable value. If the value is not iterable or `null`, the
method will throw an `InvalidArgumentException`.

The method accepts one parameter:

- `value:` (mixed): The value to validate.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Validator;

$value = Validator::iterable([1, 2, 3]);
```

### Validate value numeric

The `Validator::class` helper can be used to validate a numeric value. If the value is not numeric or `null`, the method
will throw an `InvalidArgumentException`.

The method accepts one parameter:

- `value:` (mixed): The value to validate.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Validator;

$value = Validator::numeric(1);
```

### Validate value scalar

The `Validator::class` helper can be used to validate a scalar value. If the value is not scalar or `null`, the method
will throw an `InvalidArgumentException`.

The method accepts one parameter:

- `value:` (...mixed): The value to validate.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Validator;

$value = Validator::scalar('Hello, World!');
```

### Validate value string

The `Validator::class` helper can be used to validate a string value. If the value is not a string or `null`, the method
will throw an `InvalidArgumentException`.

The method accepts one parameter:

- `value:` (mixed): The value to validate.

```php
<?php

declare(strict_types=1);

use PHPForge\Html\Helper\Validator;

$value = Validator::string('Hello, World!');
```

## Testing

[Check the documentation testing](docs/testing.md) to learn about testing.

## Support versions

[![PHP81](https://img.shields.io/badge/PHP-%3E%3D8.1-787CB5)](https://www.php.net/releases/8.1/en.php)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Our social networks

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/Terabytesoftw)
