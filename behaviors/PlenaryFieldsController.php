<?php namespace KitSoft\Plenary\Behaviors;

use ApplicationException;
use Db;
use Event;
use Config;
use October\Rain\Extension\ExtensionBase;
use Request;

/**
 * Class PlenaryFieldsController
 * @package KitSoft\Plenary\Behaviors
 */
class PlenaryFieldsController extends ExtensionBase
{
    protected $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;

        $this->extendFieldsBefore();
//        $this->extendFields();

        $this->extendColumns();
//        $this->extendRemoveColumns();

    }

    protected function extendFieldsBefore()
    {
        Event::listen('backend.form.extendFieldsBefore', function ($controller) {
            $controller->fields['category'] = [
                'label' => 'kitsoft.plenary::lang.category_name',
                'tab' => "Category",
                'span' => "auto",
                'nameFrom' => "title",
                'descriptionFrom' => "description",
                'type' => 'relation',
                'emptyOption' => '-- no category --'
            ];
            $controller->fields['categories'] = [
                'label' => 'kitsoft.plenary::lang.category_name',
                'tab' => "Category",
                'span' => "auto",
                'type' => 'formbox',
            ];
        });
    }

    protected function extendFields()
    {
        Event::listen('backend.form.extendFields', function ($controller) {
            $controller->addTabFields([
                'category' => [
                    'label' => 'kitsoft.plenary::lang.category_name',
                    'tab' => "Category",
                    'span' => "auto",
                    'nameFrom' => "title",
                    'descriptionFrom' => "description",
                    'type' => 'relation'
                ],
                'categories' => [
                    'label' => 'kitsoft.plenary::lang.category_name',
                    'tab' => "Category",
                    'span' => "auto",
                    'type' => 'formbox',
                ],
            ]);
        });
    }

    protected function extendColumns()
    {
        Event::listen('backend.list.extendColumns', function ($controller) {
            $controller->addColumns([
                'slug' => [
                    'label' => 'Рядок в URL',
                    'type' => 'text',
                ]
            ]);
        });
    }

    protected function extendRemoveColumns()
    {
        Event::listen('backend.list.extendColumns', function ($controller) {
            $controller->removeColumn('slug');
        });
    }
}
