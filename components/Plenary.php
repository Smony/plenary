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
        $param = $this->param('slug');

        $id = $this->getId($param);

        if (!empty($id)) {
            $cacheKey = 'kitsoft.plenart.' . $id;
            if (!$plenary = Cache::get($cacheKey)) {
                $name = self::getPlenaryName($id);
                Cache::forever($cacheKey, $name);
            }
        }

        if (!empty($plenary)) {
            $this->plenary = $plenary;
        } else {
            return $this->controller->run('404');
        }
    }

    protected function getPlenaryName($id)
    {
        return PlenaryModel::where('id', $id)->first()->title;
    }

    protected function getId($slug)
    {
        try {
            return PlenaryModel::where('slug', $slug)->firstOrFail()->id;
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }
}
