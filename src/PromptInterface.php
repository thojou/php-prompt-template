<?php

declare(strict_types=1);

namespace Thojou\PromptTemplate;

use Stringable;

/**
 * Represents an interface for text prompt functionality.
 */
interface PromptInterface extends Stringable
{
    /**
     * Gets the token IDs for the provided language model.
     *
     * @param non-empty-string $model The language model name.
     *
     * @return array<int, int> An array of token IDs.
     */
    public function getTokens(string $model): array;

    /**
     * Gets the count of tokens for the provided language model.
     *
     * @param non-empty-string $model The language model name.
     *
     * @return int The count of tokens.
     */
    public function getTokenCount(string $model): int;
}
