<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

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
