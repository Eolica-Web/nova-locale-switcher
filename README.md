# Laravel Nova Locale Switcher Tool

This tool provides a simple header dropdown to quickly switch between locales. This tool does not have any concrete implementation, so is up to you of what happens when a locale is selected from the dropdown.

![Nova Locale Switcher](https://raw.githubusercontent.com/Eolica-Web/nova-locale-switcher/master/docs/screenshots/screenshot_1.png)

## Installation

``` bash
composer require eolica/nova-locale-switcher
```

If you were using our `tramuntana-studio/nova-locale-switcher` package, please modify it accordingly.

## Usage

We will demonstrate how tu use this tool with a simple example. First, you must register the tool in `NovaServiceProvider` under tools.

``` php
use Illuminate\Http\Request;

public function tools()
{
    return [
        \Eolica\NovaLocaleSwitcher\LocaleSwitcher::make()
            ->setLocales(config('nova.locales'))
            ->onSwitchLocale(function (Request $request) {
                $locale = $request->post('locale');

                if (array_key_exists($locale, config('nova.locales'))) {
                    $request->user()->update(['locale' => $locale]);
                }
            }),
    ];
}
```

The `setLocales` method expects an associative array, the key being the locale code and the value the name of the locale. In this example, we set the locales from de `nova.php` config file:

``` php
return [

    // Rest of Nova configuration

    ...

    /*
    |--------------------------------------------------------------------------
    | Nova Locales
    |--------------------------------------------------------------------------
    */

    'locales' => [
        'en' => 'English',
        'de' => 'Deutsch',
        'es' => 'Español',
    ],
];
```

For handling the locale switching we must pass a `callable` to the `onSwitchLocale` method, in this example we update the current user locale field (this is a custom field that we added to the model) with the locale that we receive from the Request object.

Now, for setting the application locale we can do it inside the `boot` method of the `NovaServiceProvider` by using the `Nova::serving()` method:

``` php
use Laravel\Nova\Events\ServingNova;

final class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function (ServingNova $event) {
            $user = $event->request->user();

            if (array_key_exists($user->locale, config('nova.locales'))) {
                app()->setLocale($user->locale);
            }
        });
    }

    ...
}
```

This is one of many solutions you can use, the important thing is that you can switch to another type of implementation without depending on an external package.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover a security vulnerability within this package, please send an email at dllobellmoya@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
