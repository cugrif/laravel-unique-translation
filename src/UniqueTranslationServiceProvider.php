<?php

namespace CodeZero\UniqueTranslation;

use Illuminate\Support\ServiceProvider;
use Validator;

class UniqueTranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_translation', UniqueTranslationValidator::class . '@validate');
        Validator::replacer('unique_translation', function ($message, $attribute, $rule, $parameters) {
            $locale = $this->parseLocaleFromAttr($attribute);
            return str_replace(':locale', $locale, $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function parseLocaleFromAttr($attr)
    {
        $parts = explode('.', $attr);
        $locale = array_pop($parts);
        return $locale;
    }


}
