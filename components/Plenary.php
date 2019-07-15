<?php namespace Kitsoft\Plenary\Components;

use Cms\Classes\ComponentBase;
use Kitsoft\Plenary\Models\Plenary as PlenaryModel;
use Cache;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Plenary extends ComponentBase
{
    public $plenary;

    public function componentDetails()
    {
        return [
            'name' => 'Plenary',
            'description' => 'kitsoft.plenary::lang.plugin.description',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $cacheKey = 'kitsoft.plenart.' . $this->param('slug');
        if (!$plenary = Cache::get($cacheKey)) {
            $plenary = self::getPlenaryName($this->param('slug'));
            Cache::forever($cacheKey, $plenary);
        }

        $this->plenary = $plenary ?? [];
    }

    protected function getPlenaryName($slug)
    {
        try {
            return PlenaryModel::where('slug', $slug)->firstOrFail()->title;
        } catch (ModelNotFoundException $e) {
            return '';
        }
    }
}
