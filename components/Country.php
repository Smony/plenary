<?php namespace Kitsoft\Plenary\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Validator;
use Flash;
use Input;
use Redirect;

class Country extends ComponentBase
{

    public $ajax;
    public $country;
    public $cities;

    public function componentDetails()
    {
        return [
            'name' => 'AjaxList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->ajax = "this Ajax";
        $this->country = Config::get('kitsoft.plenary::country');
    }

    public function onSelect()
    {
        $result = [];
        $parent = post('parent_selection');

        switch ($parent) {
            case 'ua':
                $result = Config::get('kitsoft.plenary::cities')['ua'];
                break;

            case 'ru':
                $result = Config::get('kitsoft.plenary::cities')['ru'];
                break;
        }

        $this->page['cities'] = $result;
    }

    public function onSend()
    {
        $validator = Validator::make(
            [
                'name' => Input::get('name')
            ],
            [
                'name' => 'required|min:5'
            ]
        );

        if ($validator->fails()) {
            return ['#result' => $validator->messages()->all()];
        }

        $vars = ['name' => Input::get('name')];

        Mail::send(['raw' => 'Hello, {{ name }}'], $vars, function ($message) {
            $message->from('vova.symonchuk@gmail.com', 'vova');
            $message->to('dev.symonchuk@gmail.com', 'dev');
        });
    }
}
