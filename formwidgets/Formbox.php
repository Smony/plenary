<?php

namespace KitSoft\Plenary\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Kitsoft\Plenary\Models\Category;
use Config;

/**
 * Class FormBox
 * @package KitSoft\Plenary\FormWidgets
 */
class FormBox extends FormWidgetBase
{

    public function widgetDetails()
    {
        return [

            'name' => 'FormBox',
            'description' => 'field FormBox'
        ];
    }

    /**
     * @return mixed|string
     */
    public function render()
    {
        $this->prepareVars();

//        dump($this->vars['selectedValues']);

        return $this->makePartial('widget');
    }

    public function prepareVars()
    {
        $this->vars['id'] = $this->model->id;

        $this->vars['categories'] = Category::all()->lists('full_title', 'id');

        $this->vars['name'] = $this->formField->getName() . '[]';

        if (!empty($this->getLoadValue())) {
            $this->vars['selectedValues'] = $this->getLoadValue();
        } else {
            $this->vars['selectedValues'] = [];
        }

    }

    /**
     *  load Assets
     */
    public function loadAssets()
    {
        $this->addCss('/css/select.css');
        $this->addJs('/js/select.js');
    }

}
