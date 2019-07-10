<?php

namespace KitSoft\Plenary\Extensions;

use Event;
use Config;
use KitSoft\Persons\Controllers\Persons as PersonController;
use KitSoft\Persons\Controllers\Persons;
use KitSoft\Persons\Models\Person as PersonModel;
use Kitsoft\Plenary\Models\Deputy as DeputyModel;
use Kitsoft\Plenary\Models\Deputy;

class PersonExtension
{
    /**
     * PersonExtension constructor.
     */
    public function __construct()
    {
        PersonModel::extend(function ($model) {
            $model->hasOne['deputy'] = ['Kitsoft\Plenary\Models\Deputy', 'key' => 'person_id'];

        });

        Event::listen('backend.form.extendFields', function ($widget) {

            if (!$widget->getController() instanceof PersonController) return;

            if (!$widget->model instanceof PersonModel) return;

            if ($widget->getContext() == 'create' || $widget->getContext() == 'update') {
                if (!$widget->model->deputy) {
                    $widget->model->deputy = new Deputy();
                }
            }

            if ($widget->getContext() == 'create' || $widget->getContext() == 'update') {
                if (!$widget->model->deputy) {
                    $widget->model->deputy = new Deputy();
                }
            }

            $widget->addFields([
                'deputy[about]' => [
                    'label' => "About",
                    'tab' => "Plenary",
                    'type' => 'textarea',
                ],

            ]);

        });

    }
}
