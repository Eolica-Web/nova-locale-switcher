<?php

namespace Eolica\NovaLocaleSwitcher\Http\Controllers;

use Eolica\NovaLocaleSwitcher\FindsTools;
use Eolica\NovaLocaleSwitcher\LocaleSwitcher;

final class GetLocalesController
{
    use FindsTools;

    public function __invoke()
    {
        $localeSwitcher = $this->getFirstToolOfType(LocaleSwitcher::class);

        return response()->json(['locales' => optional($localeSwitcher)->locales() ?? []]);
    }
}
