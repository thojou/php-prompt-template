<?php

namespace Thojou\PromptTemplate;

use Yethee\Tiktoken\EncoderProvider;

class Prompt implements PromptInterface
{
    public function __construct(
        private readonly string $prompt
    ) {
    }

    public function __toString(): string
    {
        return $this->prompt;
    }

    public function getTokens(string $model): array
    {
        return (new EncoderProvider())->getForModel($model)->encode($this->prompt);
    }

    public function getTokenCount(string $model): int
    {
        return count($this->getTokens($model));
    }
}
