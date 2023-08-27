<?php

declare(strict_types=1);

/*
 * This file is part of PHP Prompt Template.
 *
 * (c) Thomas Joußen <tjoussen91@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Thojou\PromptTemplate\Tests;

use PHPUnit\Framework\TestCase;
use Thojou\PromptTemplate\Prompt;
use Thojou\PromptTemplate\PromptInterface;

class PromptTest extends TestCase
{
    public function testPrompt(): void
    {
        $prompt = new Prompt('Hello World!');

        $this->assertInstanceOf(PromptInterface::class, $prompt);
        $this->assertEquals('Hello World!', $prompt);
        $this->assertEquals([9906, 4435, 0], $prompt->getTokens('gpt-3.5-turbo'));
        $this->assertSame(3, $prompt->getTokenCount('gpt-3.5-turbo'));
    }
}
