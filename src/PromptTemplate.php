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

use InvalidArgumentException;

use function is_array;
use function join;

/**
 * Represents a template for rendering prompts with placeholders.
 */
class PromptTemplate implements PromptTemplateInterface
{
    /**
     * PromptTemplate constructor.
     *
     * @param string|array<string>  $template   The template string containing placeholders.
     * @param array<string, scalar> $parameters Optional initial parameters for the template.
     * @param string                $joinToken  The token to join the template if $template is an array
     */
    public function __construct(
        private readonly string|array $template,
        private readonly array $parameters = [],
        private readonly string $joinToken = "\n"
    ) {
    }

    /**
     * Renders the template with provided parameters.
     *
     * @param array<string, scalar> $parameters Optional parameters for replacing placeholders.
     * @param bool                  $strict     Whether to remove missing placeholders in strict mode.
     *
     * @return PromptInterface A PromptInterface instance with the rendered prompt.
     * @throws InvalidArgumentException If a parameter is not a scalar value.
     */
    public function render(array $parameters = [], bool $strict = true): PromptInterface
    {
        $template = (string)$this;
        $parameters = array_merge($this->parameters, $parameters);

        foreach ($parameters as $name => $value) {
            if (!is_scalar($value)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'Parameter "%s" must be a scalar value, "%s" given.',
                        $name,
                        gettype($value)
                    )
                );
            }

            $template = $this->replacePlaceholder($template, $name, (string)$value);
        }

        if ($strict) {
            $template = $this->removeMissingPlaceholder($template);
        }

        $template = $this->sanitizeEscapedPlaceholders($template);

        return new Prompt(trim($template));
    }

    /**
     * Returns the string representation of the template.
     *
     * @return string The string representation of the template.
     */
    public function __toString(): string
    {
        return is_array($this->template) ? join($this->joinToken, $this->template) : $this->template;
    }

    /**
     * Replaces a placeholder with the provided value in the template.
     *
     * @param string $template The template string.
     * @param string $name     The name of the placeholder.
     * @param string $value    The value to replace the placeholder with.
     *
     * @return string The template with the replaced placeholder.
     */
    private function replacePlaceholder(string $template, string $name, string $value): string
    {
        return (string)preg_replace(sprintf('/(?<!\\\\){{\s*%s\s*}}/', $name), $value, $template);
    }

    /**
     * Removes missing placeholders from the template in strict mode.
     *
     * @param string $template The template string.
     *
     * @return string The template with missing placeholders removed.
     */
    private function removeMissingPlaceholder(string $template): string
    {
        return (string)preg_replace('/(?<!\\\\){{\s*\w+\s*}}/m', "", $template);
    }

    /**
     * Sanitizes escaped placeholders in the template.
     *
     * @param string $template The template string.
     *
     * @return string The template with sanitized escaped placeholders.
     */
    private function sanitizeEscapedPlaceholders(string $template): string
    {
        return (string)preg_replace('/\\\\([{}])/m', '$1', $template);
    }

}
