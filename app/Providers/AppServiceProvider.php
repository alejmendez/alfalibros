<?php

namespace alfalibros\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('usuario', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){3}$/i', $value);
        });

        Validator::extend('nombre', function($attribute, $value, $parameters, $validator) {
            return preg_match('/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/i', $value);
        });

        Validator::extend('telefono', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^\d{4}\-\d{3}\-\d{4}$/i', $value);
        });

        Validator::extend('password', function($attribute, $value, $parameters, $validator) {
            return preg_match('/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $value);
        });

        Form::component('bsText', 'components.form.text', ['name', 'value', 'attributes']);
        Form::component('bsTextarea', 'components.form.textarea', ['name', 'value', 'attributes']);
        Form::component('bsNumber', 'components.form.number', ['name', 'value', 'attributes']);
        Form::component('bsPassword', 'components.form.password', ['name', 'value', 'attributes']);

        Form::component('bsSelect', 'components.form.select', ['name', 'value', 'default', 'attributes']);
        Form::component('bsModalBusqueda', 'components.modalBusqueda', ['value', 'attributes']);
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
}
