<?php namespace KitSoft\Plenary\Behaviors;

use ApplicationException;
use Db;
use Event;
use Config;
use October\Rain\Extension\ExtensionBase;
use Request;

/**
 * Class HideModelBehaviors
 * @package KitSoft\Plenary\Behaviors
 */
class CategoryModelBehaviors extends ExtensionBase
{
    protected $model;

    /**
     * HideModelBehaviors constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @return string  full_title
     */
    public function getFullTitleAttribute()
    {
        return $this->model->title . ' - category';
    }

    /**
     * @param $value
     */
    public function setFullTitleAttribute($value)
    {
        $this->model->attributes['full_title'] = $value;
    }

}
