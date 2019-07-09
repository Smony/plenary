<?php namespace KitSoft\Plenary\Classes;

use App;
use Url;
use Session;
use Request;
use KitSoft\MultiSite\Models\Site;
use Carbon\Carbon;

class TimeSite
{
	use \October\Rain\Support\Traits\Singleton;

	protected $time;

	/**
	 * init
	 */
	public function init() {
        $this->time = Carbon::now();
	}

    public function getTime() {
    	return $this->time;
    }
}
