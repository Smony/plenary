<?php namespace Kitsoft\Plenary\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Request;
use KitSoft\Pages\Models\Page;
use Kitsoft\Plenary\Models\Plenary;
use Input;

class Planeries extends ComponentBase
{
    public $plenaries;

    public $param;

    public $value;

    public function componentDetails()
    {
        return [
            'name' => 'Plenaries',
            'description' => 'kitsoft.plenary::lang.plugin.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'limit' => [
                'title' => 'limit items',
                'description' => 'select limit items',
                'default' => 5
            ],
        ];
    }

    public function onRun()
    {
        $this->plenaries = $this->listPlenaries('title');
    }

    protected function listPlenaries($order)
    {
        $query = Plenary::whereNotNull('published')
            ->where('published', true)
            ->orderBy($order, 'desc')
            ->paginate($this->property('limit'))
            ->appends(request()->all());

        return $query;
    }
}
