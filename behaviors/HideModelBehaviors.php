<?php namespace KitSoft\Plenary\Behaviors;

use ApplicationException;
use Db;
use Event;
use Config;
use Illuminate\Support\Carbon;
use October\Rain\Extension\ExtensionBase;
use Request;

/**
 * Class HideModelBehaviors
 * @package KitSoft\Plenary\Behaviors
 */
class HideModelBehaviors extends ExtensionBase
{
    protected $model;

    /**
     * HideModelBehaviors constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->displayField();
    }

    protected function displayField()
    {
        $this->model::addGlobalScope('notTitle', function ($builder) {
            $builder->notTitle();
        });
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotTitle($query)
    {
        return $query->where('title', 'not like', '%0%');
    }

    /**
     * @param $query
     * @param $category
     * @return mixed
     */
    public function scopeFilterCategory($query, $categories_ids)
    {
        return $query->whereIn('category_id', $categories_ids);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', true)
            ->where('published', '<', Carbon::now());
    }

    /**
     * @param $query
     * @param $categories_ids
     * @return mixed
     */
    public function scopeCategoryName($query, $categories_ids)
    {
        return $query->whereIn('category_id', $categories_ids);
    }

    /**
     * @param $value
     */
    public function setFullTitleAttribute($value)
    {
        $this->model->attributes['full_title'] = $value;
    }

    /**
     * @return mixed|string
     */
    public function getFullTitleAttribute()
    {
        return $this->model->title;
    }
}
