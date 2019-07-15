<?php namespace Kitsoft\Plenary;

use App;
use Backend;
use Illuminate\Support\Facades\Mail;
use System\Classes\PluginBase;
use Event;
use Lang;

/**
 * Plenary Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'KitSoft.References'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'kitsoft.plenary::lang.plugin.name',
            'description' => 'kitsoft.plenary::lang.plugin.description',
            'author' => 'Vladymyr Symonchuk',
            'icon' => 'icon-users'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('plenary:count', 'KitSoft\Plenary\Console\MyCommand');
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
//        echo Lang::get('kitsoft.plenary::lang.plugin.name');

        /* Event::listen('kitsoft.plenary::public', function (&$title, &$published) {
             $title = strtoupper($title) . '- category';
             $published = true;
         });*/

        App::make('KitSoft\Plenary\Extensions\PersonExtension');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Kitsoft\Plenary\Components\Country' => 'country',
            'Kitsoft\Plenary\Components\Planeries' => 'listPlenaries',
            'Kitsoft\Plenary\Components\Plenary' => 'plenary',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     *
     */
    public function registerPermissions()
    {
        return [
            'kitsoft.plenary.plenary.create' => [
                'tab' => 'kitsoft.plenary::lang.plugin.name',
                'label' => 'kitsoft.plenary::lang.create'
            ],
            'kitsoft.plenary.plenary.index' => [
                'tab' => 'kitsoft.plenary::lang.plugin.name',
                'label' => 'kitsoft.plenary::lang.index'
            ],
            'kitsoft.plenary.category.index' => [
                'tab' => 'kitsoft.plenary::lang.category.name',
                'label' => 'kitsoft.plenary::lang.category_name'
            ],
            'kitsoft.plenary.category.create' => [
                'tab' => 'kitsoft.plenary::lang.category.name',
                'label' => 'kitsoft.plenary::lang.category_name'
            ],
            'kitsoft.plenary.plenarysession.index' => [
                'tab' => 'kitsoft.plenary::lang.plenarysession.name',
                'label' => 'kitsoft.plenary::lang.plenarysession'
            ],
            'kitsoft.plenary.plenarysession.create' => [
                'tab' => 'kitsoft.plenary::lang.plenarysession.name',
                'label' => 'kitsoft.plenary::lang.plenarysession'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'plenary' => [
                'label' => 'kitsoft.plenary::lang.plugin.name',
                'url' => Backend::url('kitsoft/plenary/plenary'),
                'icon' => 'icon-users',
                'permissions' => ['kitsoft.plenary.*'],
                'order' => 100,
                'sideMenu' => [
                    'newPlenary' => [
                        'label' => 'kitsoft.plenary::lang.add',
                        'icon' => 'icon-plus',
                        'url' => Backend::url('kitsoft/plenary/plenary/create'),
                        'permissions' => ['kitsoft.plenary.plenary.create'],
                    ],
                    'plenary' => [
                        'label' => 'kitsoft.plenary::lang.plugin.name',
                        'icon' => 'icon-users',
                        'url' => Backend::url('kitsoft/plenary/plenary/index'),
                        'permissions' => ['kitsoft.plenary.plenary.index']
                    ],
                    'plenarysession' => [
                        'label' => 'kitsoft.plenary::lang.plenarysession.name',
                        'icon' => 'icon-briefcase',
                        'url' => Backend::url('kitsoft/plenary/plenarysession'),
                        'permissions' => ['kitsoft.plenary.plenarysession.index']
                    ],
                    'category' => [
                        'label' => 'kitsoft.plenary::lang.category.name',
                        'icon' => 'icon-list-ul',
                        'url' => Backend::url('kitsoft/plenary/category'),
                        'permissions' => ['kitsoft.plenary.category.index']
                    ]
                ],

            ],
        ];

    }

    /**
     * Registers mail templates
     *
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'kitsoft.plenary::mail.plenary' => 'Hello Plenary.',
            'kitsoft.plenary::mail.county' => 'country.',
//            'kitsoft.plenary::testing' => 'Hi test.',
        ];
    }

    /**
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Plenary Settings',
                'description' => '',
                'category' => 'Plenary',
                'icon' => 'icon-leaf',
                'class' => 'KitSoft\Plenary\Models\Settings',
                'order' => 500,
            ]
        ];
    }

    /**
     * Register twig filters and functions
     * @return array
     */
    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'get_public_category' => ['KitSoft\Plenary\Twig\Functions', 'category']
            ],
            'filters' => [
                'str_to_upper' => ['KitSoft\Plenary\Twig\MyFilters', 'StrToUpper']
            ]
        ];
    }

    /**
     * registerFormWidgets
     * @return array
     */
    public function registerFormWidgets()
    {
        return [
            'KitSoft\Plenary\FormWidgets\Formbox' => [
                'label' => 'Formbox field',
                'code' => 'formbox'
            ]
        ];
    }

    /**
     * registerReportWidgets
     * @return array
     */
    public function registerReportWidgets()
    {
        return [
            'KitSoft\Plenary\ReportWidgets\TestingTest' => [
                'label' => 'Testing',
                'context' => 'test'
            ]
        ];
    }

}
