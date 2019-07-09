<?php namespace KitSoft\Plenary\Models;

use Backend\Models\ExportModel;
use Kitsoft\Plenary\Models\Plenary;

class ItemExport extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        // Берем всю коллекцию
        $item = Plenary::all();
        $item->each(function($item) use ($columns) {
            // Берем все столбцы которые видны в columns.yaml
            $item->addVisible($columns);
        });
        // Выводим
        return $item->toArray();
    }
}
