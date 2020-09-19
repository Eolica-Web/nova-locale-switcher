<?php

namespace Eolica\NovaLocaleSwitcher;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

trait FindsTools
{
    public function getFirstToolOfType(string $type): ?Tool
    {
        return collect(Nova::registeredTools())
            ->first(function ($tool) use ($type) {
                return $tool instanceof $type;
            });
    }
}
