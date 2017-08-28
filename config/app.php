<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Framework Service Providers...
         */
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Arc\Console\CommandServiceProvider::class,
        Arc\Cron\CronServiceProvider::class,
        Arc\CustomPostTypes\CustomPostTypeServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        MakeWeb\REAXMLImporter\Providers\ActionServiceProvider::class,
        MakeWeb\REAXMLImporter\Providers\ActivationServiceProvider::class,
        MakeWeb\REAXMLImporter\Providers\AdminServiceProvider::class,
        MakeWeb\REAXMLImporter\Providers\AssetServiceProvider::class,
        MakeWeb\REAXMLImporter\Providers\CustomPostTypeServiceProvider::class,
        MakeWeb\REAXMLImporter\Providers\DiviModuleServiceProvider::class,
        MakeWeb\REAXMLImporter\Providers\ImporterServiceProvider::class,
        MakeWeb\REAXMLImporter\Providers\RouteServiceProvider::class,
    ]
];
