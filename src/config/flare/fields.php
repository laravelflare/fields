<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Flare Fields
    |--------------------------------------------------------------------------
    |
    | This array of Field classes allows you to define all of the
    | available field types that you have available.
    |
    | You can add your own custom field types here, replace or even remove
    | some of the defaults. Each type requires a unique key in order to
    | allow you to reference the class in a shorthand fashion.
    |
    */
    'types' => [
        'autocomplete' => \LaravelFlare\Fields\Types\AutoCompleteField::class,
        'checkbox' => \LaravelFlare\Fields\Types\CheckboxField::class,
        'date' => \LaravelFlare\Fields\Types\DateField::class,
        'datetime' => \LaravelFlare\Fields\Types\DateTimeField::class,
        'email' => \LaravelFlare\Fields\Types\EmailField::class,
        'file' => \LaravelFlare\Fields\Types\FileField::class,
        'image' => \LaravelFlare\Fields\Types\ImageField::class,
        'password' => \LaravelFlare\Fields\Types\PasswordField::class,
        'radio' => \LaravelFlare\Fields\Types\RadioField::class,
        'select' => \LaravelFlare\Fields\Types\SelectField::class,
        'textarea' => \LaravelFlare\Fields\Types\TextareaField::class,
        'text' => \LaravelFlare\Fields\Types\TextField::class,
        'textmask' => \LaravelFlare\Fields\Types\TextMaskField::class,
        'time' => \LaravelFlare\Fields\Types\TimeField::class,
        'wysiwyg' => \LaravelFlare\Fields\Types\WysiwygField::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Field Options
    |--------------------------------------------------------------------------
    |
    | Configuration for specific Field Types.
    |
    */
    'options' => [

        /**
         * Map Field Options.
         *
         * Google API Key is required for the map field.
         */
        'map' => [
            'google_api_key' => null,
        ],

    ],
];
