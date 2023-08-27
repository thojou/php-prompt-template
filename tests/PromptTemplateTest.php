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

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Thojou\PromptTemplate\PromptTemplate;

class PromptTemplateTest extends TestCase
{
    /**
     * @param array<string, scalar> $params
     * @dataProvider providePromptTemplateData
     */
    public function testPromptTemplate(string $template, array $params, string $expected): void
    {
        $promptTemplate = new PromptTemplate($template);
        $this->assertEquals($expected, $promptTemplate->render($params));
        $this->assertEquals($template, $promptTemplate);
    }

    /**
     * @return array<string, array<int, array<string, scalar>|string>>
     */
    public static function providePromptTemplateData(): array
    {
        return [
            'no_space_in_placeholder' => ['What is the color of a {{fruit}}?', ['fruit' => 'banana'], 'What is the color of a banana?'],
            'one_space_in_placeholder' => ['What is the color of a {{ fruit }}?', ['fruit' => 'banana'], 'What is the color of a banana?'],
            'left_space_in_placeholder' => ['What is the color of a {{  fruit}}?', ['fruit' => 'banana'], 'What is the color of a banana?'],
            'right_space_in_placeholder' => ['What is the color of a {{fruit  }}?', ['fruit' => 'banana'], 'What is the color of a banana?'],
            'multi_space_in_placeholder' => ['What is the color of a {{  fruit   }}?', ['fruit' => 'banana'], 'What is the color of a banana?'],
            'multi_param_in_template' => ['What is the {{ attribute }} of a {{ fruit }}?', ['attribute' => 'color', 'fruit' => 'banana'], 'What is the color of a banana?'],
            'escaped_placeholder' => ['What is the \{{ attribute }} of a {{ fruit }}? Do you also like {{fruit}}?', ['fruit' => 'banana'], 'What is the {{ attribute }} of a banana? Do you also like banana?'],
            'duplicated_param_in_template' => ['What is the {{ attribute }} of a {{ fruit }}? Do you also like {{fruit}}?', ['attribute' => 'color', 'fruit' => 'banana'], 'What is the color of a banana? Do you also like banana?'],
            'missing_param' => ['What is the {{ attribute }} of a {{ fruit }}? Do you also like {{fruit}}?', ['fruit' => 'banana'], 'What is the  of a banana? Do you also like banana?'],
        ];
    }

    public function testNonStrictRendering(): void
    {
        $promptTemplate = new PromptTemplate("Hello {{name}}!");
        $this->assertEquals("Hello {{name}}!", $promptTemplate->render([], false));
    }

    public function testWithDefaultParameters(): void
    {
        $promptTemplate = new PromptTemplate("Hello {{name}}! Today is {{ day }}.", ['day' => 'Monday', 'name' => 'John']);
        $this->assertEquals("Hello Jane! Today is Monday.", $promptTemplate->render(['name' => 'Jane']));
    }

    public function testInvalidParameterType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Parameter "name" must be a scalar value, "array" given.');

        $promptTemplate = new PromptTemplate("Hello {{name}}!");

        $promptTemplate->render(['name' => []]); // @phpstan-ignore-line
    }
}
