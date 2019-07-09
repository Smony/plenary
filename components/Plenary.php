<?php namespace Kitsoft\Plenary\Components;

use Cms\Classes\ComponentBase;
use Kitsoft\Plenary\Models\Plenary as PlenaryModel;
use KitSoft\Plenary\Classes\PlenaryHelpers;
use Cache;

class Plenary extends ComponentBase
{
    public $plenary;

    public $test;

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

        if (!empty($param)) {
            PlenaryHelpers::getPlenaryContent($param);

            if (Cache::has(PlenaryHelpers::getCacheKey())) {
                $data = Cache::get(PlenaryHelpers::getCacheKey());
            }

            if (!empty($data) && $data['slug'] == $param) {
                $this->plenary = $data;
            } else {
                return $this->controller->run('404');
            }
        }
    }

    protected function getPlenary($slug)
    {
        $query = PlenaryModel::where('slug', $slug)->first();

        return $query;
    }
}
