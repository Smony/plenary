<?php namespace Kitsoft\Plenary\Models;

use Model;
use KitSoft\Persons\Models\Person;

/**
 * Deputy Model
 */
class Deputy extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_plenary_deputies';

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
        'person' => ['KitSoft\Persons\Models\Person']
    ];

    public static function getFromPerson($person)
    {

        $deputy = new static();
        $deputy->person = $person;
        $deputy->save();

        $person->plenary = $deputy;

        return $deputy;
    }
}
