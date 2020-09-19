<?php

namespace Eolica\NovaLocaleSwitcher;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

final class LocaleSwitcher extends Tool
{
    private $locales;
    private $onSwitchLocaleHandler;

    public function __construct(array $locales = [], $component = null)
    {
        $this->setLocales($locales);

        parent::__construct($component);
    }

    public function boot()
    {
        if (count($this->locales()) > 0) {
            Nova::script('locale-switcher', __DIR__.'/../dist/js/tool.js');
        }
    }

    public function setLocales(array $locales)
    {
        $this->locales = $locales;

        return $this;
    }

    public function onSwitchLocale(callable $handler)
    {
        $this->onSwitchLocaleHandler = $handler;

        return $this;
    }

    public function locales()
    {
        return $this->locales;
    }

    public function onSwitchLocaleHandler(): callable
    {
        return $this->onSwitchLocaleHandler;
    }
}
