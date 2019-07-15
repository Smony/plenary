<?php namespace Kitsoft\Plenary\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Plenary Session Back-end Controller
 */
class PlenarySession extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Kitsoft.Plenary', 'plenary', 'plenarysession');
    }
}
