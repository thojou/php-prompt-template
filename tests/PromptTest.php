<?php

namespace Thojou\PromptTemplate\Tests;

use PHPUnit\Framework\TestCase;
use Thojou\PromptTemplate\Prompt;
use Thojou\PromptTemplate\PromptInterface;

class PromptTest extends TestCase
{
    public function testPrompt()
    {
        $prompt = new Prompt('Hello World!');

        $this->assertInstanceOf(PromptInterface::class, $prompt);
        $this->assertEquals('Hello World!', $prompt);
        $this->assertEquals([9906, 4435, 0], $prompt->getTokens('gpt-3.5-turbo'));
        $this->assertSame(3, $prompt->getTokenCount('gpt-3.5-turbo'));
    }
}
