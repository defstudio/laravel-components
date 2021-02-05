<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Excel;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class DataSheet implements WithTitle, FromArray
{
    const ALPHABET = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
    ];

    public function __construct(
        private array $columns,
        private array $rows,
    ) {
    }

    public function title(): string
    {
        return 'Data';
    }

    public function array()
    {
        return [
            [
                'a',
                'c',
            ],
        ];
    }

    // public function columnFormats(): array
    // {
    //     $formats = [];
    //
    //     $column_number = 0;
    //     foreach ($this->columns as $column_data) {
    //         $column_letter = self::ALPHABET[$column_number];
    //
    //         switch ($column_data['type'] ?? '') {
    //             case 'number':
    //                 $formats[$column_letter] = NumberFormat::FORMAT_NUMBER;
    //                 break;
    //             case 'float':
    //                 $formats[$column_letter] = NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1;
    //                 break;
    //             default:
    //                 $formats[$column_letter] = NumberFormat::FORMAT_TEXT;
    //                 break;
    //         }
    //
    //         $column_number++;
    //     }
    //
    //     return $formats;
    // }
    //
    // public function styles(Worksheet $sheet): array
    // {
    //     $sheet->freezePane('A3');
    //     $sheet->getRowDimension(1)->setVisible(false);
    //
    //     $styles = [
    //         2 => [
    //             'font' => ['bold' => true],
    //         ],
    //     ];
    //
    //
    //     $column_number = 0;
    //     foreach ($this->columns as $column_data) {
    //         $column_letter = self::ALPHABET[$column_number];
    //         $this->set_cell_style($sheet, $column_letter, $column_data);
    //         $column_number++;
    //     }
    //
    //     return $styles;
    // }
    //
    // private function set_cell_style(Worksheet &$sheet, $column_letter, $column_data)
    // {
    //     $range = "{$column_letter}3:{$column_letter}9999";
    //
    //     if (($column_data['type'] ?? '') == 'select') {
    //         $options = $column_data['options'] ?? [];
    //         unset($options['']);
    //
    //         $allowed_values = '"'.implode(',', $options).'"';
    //
    //         $validation = $sheet->getDataValidation($range);
    //         $validation->setType(DataValidation::TYPE_LIST);
    //         $validation->setErrorStyle(DataValidation::STYLE_STOP);
    //         $validation->setAllowBlank(true);
    //         $validation->setShowErrorMessage(true);
    //         $validation->setErrorTitle("Attenzione");
    //         $validation->setError("Valore non ammesso");
    //         $validation->setShowDropDown(true);
    //         $validation->setFormula1($allowed_values);
    //         $sheet->setDataValidation($range, $validation);
    //     } else {
    //         if (($column_data['type'] ?? '') == 'checkbox') {
    //             $allowed_values = '"'.implode(',', ['1']).'"';
    //
    //             $validation = $sheet->getDataValidation($range);
    //             $validation->setType(DataValidation::TYPE_LIST);
    //             $validation->setErrorStyle(DataValidation::STYLE_STOP);
    //             $validation->setAllowBlank(true);
    //             $validation->setShowErrorMessage(true);
    //             $validation->setErrorTitle("Attenzione");
    //             $validation->setError("Inserire 1 per selezionare");
    //             $validation->setShowDropDown(true);
    //             $validation->setFormula1($allowed_values);
    //             $sheet->setDataValidation($range, $validation);
    //         }
    //     }
    // }
}
