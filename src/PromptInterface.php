<?php

namespace Thojou\PromptTemplate;

interface PromptInterface extends \Stringable
{
    public function getTokenCount(string $model): int;
}
