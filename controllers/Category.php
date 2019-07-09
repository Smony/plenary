<?php namespace Kitsoft\Plenary\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Mail;
use Flash;

/**
 * Category Back-end Controller
 */
class Category extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $bodyClass = 'compact-container breadcrumb-fancy';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Kitsoft.Plenary', 'plenary', 'category');
    }

    public function onSendMail()
    {
        $vars = ['name' => 'Vasya'];

        Mail::send(['raw' => 'Hello, {{ name }}'], $vars, function ($message) {
            $message->from('vova.symonchuk@gmail.com', 'vova');
            $message->to('dev.symonchuk@gmail.com', 'dev');
        });

        if (count(Mail::failures()) == 0) {
            Flash::success(e(trans('kitsoft.plenary::lang.category.success-mail')));
        } else {
            throw new \AjaxException(['X_OCTOBER_ERROR_MESSAGE' => e(trans('kitsoft.plenary::lang.category.error-mail'))]);
        }
    }
}
