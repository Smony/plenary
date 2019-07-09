<?php namespace Kitsoft\Plenary\Models;

use Model;
use Event;
use Illuminate\Support\Str;

/**
 * Category Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var array
     */
    public $implement = [
        '@KitSoft.Plenary.Behaviors.CategoryModelBehaviors'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_plenary_categories';

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
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [

        'plenaries' => [
            'Kitsoft\Plenary\Models\Plenary',
            'table' => 'kitsoft_plenary_plenaries_categories',
            'order' => 'title',
        ]

    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function beforeSave()
    {
        $title = $this->title;
        $published = $this->published;
        Event::fire('kitsoft.plenary::category.public', [&$title, &$published]);
        $this->title = $title;
        $this->published = $published;
    }

    public function beforeCreate()
    {
        $this->slug = Str::slug('full_title');
        $this->slug .= "-slug";
    }
}
