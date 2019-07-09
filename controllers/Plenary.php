<?php namespace Kitsoft\Plenary\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Event;
use KitSoft\Plenary\Classes\PlenaryHelpers;
use Cache;
use Mail;

/**
 * Plenary Back-end Controller
 */
class Plenary extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        '@KitSoft.TagsManager.Behaviors.ControllerBehavior',
        'Backend.Behaviors.ImportExportController',
        '@KitSoft.Plenary.Behaviors.PlenaryFieldsController',
        'Backend.Behaviors.ReorderController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $importExportConfig = 'config_import_export.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Kitsoft.Plenary', 'plenary', 'plenary');
    }
}
