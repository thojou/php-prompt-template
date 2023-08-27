<?php

declare(strict_types=1);

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
