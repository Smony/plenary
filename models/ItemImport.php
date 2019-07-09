<?php namespace KitSoft\Plenary\Models;

use Backend\Models\ImportModel;

class ItemImport extends ImportModel
{
    public $table = 'kitsoft_plenary_plenaries';

    /**
     * Обязательные поля
     */
    protected $rules = [
        'title'    => 'required',
        'slug'    => 'required',
    ];

    public function importData($results, $sessionKey = null)
    {
        $firstRow = reset($results);

        foreach ($results as $row => $data) {
            try {

                // Создаем новую запись
                $item = Plenary::make();

                // Исключить из цикла
                $except = ['id']; // В этом массиве мы исключаем те переменные, которые не нужно обрабатывать в автоматическом цикле foreach ниже

                // Цикл заполнения
                foreach (array_except($data, $except) as $attribute => $value) {
                    $item->{$attribute} = $value ?: null; // Присваивание значения в столбец по атрибуту
                }
                // Сохранение
                $item->forceSave();

                $this->logCreated();
            }
            catch (\Exception $ex) {
                // Ошибка
                $this->logError($row, $ex);
            }

        }
    }
}
