<?php

namespace Eolica\NovaLocaleSwitcher\Http\Controllers;

use Illuminate\Http\Request;
use Eolica\NovaLocaleSwitcher\FindsTools;
use Eolica\NovaLocaleSwitcher\LocaleSwitcher;

final class SwitchLocaleController
{
    use FindsTools;

    public function __invoke(Request $request)
    {
        $localeSwitcher = $this->getFirstToolOfType(LocaleSwitcher::class);

        optional($localeSwitcher)->onSwitchLocaleHandler()($request);
    }
}
