<?php

namespace Thojou\PromptTemplate;

class PromptTemplate implements PromptTemplateInterface
{

    public function __construct(
        private readonly string $template,
        private readonly array $parameters = []
    ) {
    }

    public function render(array $parameters = [], bool $strict = true): PromptInterface
    {
        $template = $this->template;
        $parameters = array_merge($this->parameters, $parameters);

        foreach ($parameters as $name => $value) {
            if (!is_scalar($value)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Parameter "%s" must be a scalar value, "%s" given.',
                        $name,
                        gettype($value)
                    )
                );
            }

            $template = $this->replacePlaceholder($template, $name, $value);
        }

        if ($strict) {
            $template = $this->removeMissingPlaceholder($template);
        }

        $template = $this->sanitizeEscapedPlaceholders($template);

        return new Prompt(trim($template));
    }


    public function __toString(): string
    {
        return $this->template;
    }

    private function replacePlaceholder(string $template, string $name, float|bool|int|string $value): string
    {
        return (string)preg_replace(sprintf('/(?<!\\\\){{\s*%s\s*}}/', $name), $value, $template);
    }

    private function removeMissingPlaceholder(string $template): string
    {
        return (string)preg_replace('/(?<!\\\\){{\s*\w+\s*}}/m', "", $template);
    }

    private function sanitizeEscapedPlaceholders(string $template): string
    {
        return (string)preg_replace('/\\\\([{}])/m', '$1', $template);
    }

}