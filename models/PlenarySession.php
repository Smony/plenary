<?php namespace Kitsoft\Plenary\Models;

use Model;

/**
 * PlenarySession Model
 */
class PlenarySession extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'kitsoft_plenary_plenary_sessions';

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
    public $belongsTo = [
        'convocation' => ['KitSoft\References\Models\Convocation'],
        'meetingtype' => ['KitSoft\References\Models\MeetingType'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
