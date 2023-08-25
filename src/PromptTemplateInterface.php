<?php

namespace Thojou\PromptTemplate;

interface PromptTemplateInterface extends \Stringable
{
    public function render(array $parameters = []): PromptInterface;
}