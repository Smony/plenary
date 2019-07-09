<?php namespace KitSoft\Plenary\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Kitsoft\Plenary\Models\Plenary as Plenaries;

class TestingTest extends ReportWidgetBase
{

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('widget');
    }

    /**
     * prepareVars
     */
    protected function prepareVars()
    {
        $plenaries = Plenaries::where('published', true)->get();
        $this->vars['plenaries'] = $plenaries->lists('full_title', 'id');
    }
}
