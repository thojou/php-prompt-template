# PHP Prompt Template

![Static Badge](https://img.shields.io/badge/PHP_Version-%3E%3D8.1-blue)
[![CI](https://github.com/thojou/php-prompt-template/actions/workflows/ci.yml/badge.svg)](https://github.com/thojou/php-prompt-template/actions/workflows/ci.yml)
![Coverage](https://img.shields.io/badge/coverage-100%25-green)
[![License](https://img.shields.io/github/license/thojou/php-prompt-template)](./LICENSE)


The **PHP Prompt Template** is template library for PHP projects. 
It provides a basic structure for PHP libraries, including a CI pipeline, code coverage, and static analysis. 

## Requirements
* PHP version >= 8.1

## Installation

You can effortlessly install the **OpenAi PHP Client** using the popular package manager [composer](https://getcomposer.org/) to install OpenAi PHP Client.

```bash
composer require thojou/php-prompt-template
```

## Usage

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Thojou\PromptTemplate\Prompt;
use Thojou\PromptTemplate\PromptTemplate;

// Create a new prompt
$prompt = new Prompt('Hello World!');

// Render a prompt template
$template = new PromptTemplate('Hello {{name}}!');
$renderedPrompt = $template->render(['name' => 'Alice']);

echo $prompt;           // Outputs: "Hello World!"
echo $renderedPrompt;   // Outputs: "Hello Alice!"

echo $prompt->getTokenCount('gpt-3.5-turbo'); // Outputs: 3
echo join(', ', $prompt->getTokens('gpt-3.5-turbo')); // Outputs: 15496, 2159, 0
```

For more practical examples, please refer to the [examples](./examples) folder.

## License

This project is licensed under the generous and permissive [MIT license](./LICENSE).