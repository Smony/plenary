<?php namespace Kitsoft\Plenary\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Model;
use Cache;
use KitSoft\Plenary\Classes\PlenaryHelpers;

/**
 * Plenary Model
 */
class Plenary extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\NestedTree;

    /**
     * @var array
     */
    public $implement = [
        '@KitSoft.TagsManager.Behaviors.ModelBehavior',
        '@KitSoft.Plenary.Behaviors.HideModelBehaviors',
        '@KitSoft.Pages.Behaviors.RelationFinderModel'
    ];

    public $relationFinder = [
        'nameFrom' => 'title',
        'descriptionFrom' => 'slug'
    ];

    /**
     * @var array
     */
    public $rules = [
        'title'  => 'required|between:4,100',
    ];

    /**
     * @var array
     */
    public $customMessages = [
        'title.required' => ':attribute Обезательно заполнять!',
    ];

    public $jsonable = ['fields'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_plenary_plenaries';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'category' => ['KitSoft\Plenary\Models\Category'],
    ];

    public $belongsToMany = [
        'categories' => [
            'Kitsoft\Plenary\Models\Category',
            'table' => 'kitsoft_plenary_plenaries_categories',
            'order' => 'sort_order',
        ]
    ];

    public $attachOne = [
        'new_image' => 'System\Models\File'
    ];

    public $attachMany = [
        'new_galery' => ['System\Models\File', 'order' => 'sort_order']
    ];

    public function afterSave()
    {
        Cache::forget(PlenaryHelpers::getCacheKey());
    }
}
