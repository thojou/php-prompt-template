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
