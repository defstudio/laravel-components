<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpUnhandledExceptionInspection */

namespace DefStudio\Components\Excel;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateSheet implements FromView, ShouldAutoSize, WithStyles, WithColumnFormatting, WithTitle
{
    public function __construct(
        private array $columns,
        private array $rows,
    ) {
    }

    public function title(): string
    {
        return 'Import';
    }

    public function view(): View
    {
        return view('def-components::excel.template-export')->with([
            'columns' => $this->columns,
            'rows'    => $this->rows,
        ]);
    }

    public function columnFormats(): array
    {
        $formats = [];

        $column_number = 0;
        foreach ($this->columns as $column_data) {
            $column_letter = TemplateExcelExport::ALPHABET[$column_number];

            switch ($column_data['type'] ?? '') {
                case 'number':
                    $formats[$column_letter] = NumberFormat::FORMAT_NUMBER;
                    break;
                case 'float':
                    $formats[$column_letter] = NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1;
                    break;
                default:
                    $formats[$column_letter] = NumberFormat::FORMAT_TEXT;
                    break;
            }

            $column_number++;
        }

        return $formats;
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->freezePane('A3');
        $sheet->getRowDimension(1)->setVisible(false);

        $styles = [
            2 => [
                'font' => ['bold' => true],
            ],
        ];


        $column_number = 0;

        $select_columns_count = 0;
        foreach ($this->columns as $column_data) {
            $column_letter = TemplateExcelExport::ALPHABET[$column_number];
            $this->set_cell_style($sheet, $column_letter, $column_data, $select_columns_count);
            $column_number++;
        }

        return $styles;
    }

    private function set_cell_style(Worksheet $sheet, $column_letter, $column_data, &$select_columns_count)
    {
        $range = "{$column_letter}3:{$column_letter}9999";

        if (($column_data['type'] ?? '') == 'select') {
            $options = data_get($column_data, 'options', []);
            unset($options['']);

            $validation = $sheet->getDataValidation($range);
            $validation->setType(DataValidation::TYPE_LIST);
            $validation->setErrorStyle(DataValidation::STYLE_STOP);
            $validation->setAllowBlank(true);
            $validation->setShowErrorMessage(true);
            $validation->setErrorTitle("Attenzione");
            $validation->setError("Valore non ammesso");
            $validation->setShowDropDown(true);

            $values_column = TemplateExcelExport::ALPHABET[$select_columns_count];
            $values_row_start = 2;
            $values_row_end = $values_row_start + count($options);
            $validation->setFormula1("'Data'!\${$values_column}\${$values_row_start}:\${$values_column}\${$values_row_end}");
            $sheet->setDataValidation($range, $validation);

            $select_columns_count++;
        } else {
            if (($column_data['type'] ?? '') == 'checkbox') {
                $allowed_values = '"'.implode(',', ['1']).'"';

                $validation = $sheet->getDataValidation($range);
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_STOP);
                $validation->setAllowBlank(true);
                $validation->setShowErrorMessage(true);
                $validation->setErrorTitle("Attenzione");
                $validation->setError("Inserire 1 per selezionare");
                $validation->setShowDropDown(true);
                $validation->setFormula1($allowed_values);
                $sheet->setDataValidation($range, $validation);
            }
        }
    }
}
