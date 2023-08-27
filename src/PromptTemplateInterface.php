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

namespace Thojou\PromptTemplate;

use Stringable;

/**
 * Represents an interface for rendering prompts with placeholders.
 */
interface PromptTemplateInterface extends Stringable
{
    /**
     * Renders the template with provided parameters.
     *
     * @param array<string, scalar> $parameters Optional parameters for replacing placeholders.
     *
     * @return PromptInterface A PromptInterface instance with the rendered prompt.
     */
    public function render(array $parameters = []): PromptInterface;
}
