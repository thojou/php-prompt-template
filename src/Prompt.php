<?php

declare(strict_types=1);

namespace Thojou\PromptTemplate;

use Yethee\Tiktoken\EncoderProvider;

/**
 * Represents a prompt for generating text using various language models.
 */
class Prompt implements PromptInterface
{
    /**
     * Prompt constructor.
     *
     * @param string $prompt The text prompt to be used for generating text.
     */
    public function __construct(
        private readonly string $prompt
    ) {
    }

    /**
     * Returns the string representation of the prompt.
     *
     * @return string The string representation of the prompt.
     */
    public function __toString(): string
    {
        return $this->prompt;
    }

    /**
     * Gets the token IDs for the provided language model.
     *
     * @param non-empty-string $model The language model name.
     *
     * @return array<int, int> An array of token IDs.
     */
    public function getTokens(string $model): array
    {
        return (new EncoderProvider())->getForModel($model)->encode($this->prompt);
    }

    /**
     * Gets the count of tokens for the provided language model.
     *
     * @param non-empty-string $model The language model name.
     *
     * @return int The count of tokens.
     */
    public function getTokenCount(string $model): int
    {
        return count($this->getTokens($model));
    }
}
