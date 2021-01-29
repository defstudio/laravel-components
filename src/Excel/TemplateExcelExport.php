<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpUnhandledExceptionInspection */


namespace DefStudio\Components\Excel;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateExcelExport implements FromView, Responsable, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    use Exportable;

    const ALPHABET = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
    ];

    private array $columns;
    private array $rows;

    private string $fileName;

    private string $writerType = Excel::XLS;

    public function __construct(string $filename, array $columns, array $rows)
    {


        $this->columns = $this->normalize_columns($columns);
        $this->rows = $rows;
        $this->fileName = "$filename.xls";
    }

    private function normalize_columns(array $columns): array
    {
        foreach ($columns as $key => $data) {
            if (!is_array($data)) {
                $data = [
                    'label' => $data,
                ];
            }

            $data['type'] = $data['type'] ?? 'text';
            $data['label'] = $data['label'] ?? $key;

            $columns[$key] = $data;
        }

        return $columns;
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
            $column_letter = self::ALPHABET[$column_number];

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
        foreach ($this->columns as $column_data) {
            $column_letter = self::ALPHABET[$column_number];
            $this->set_cell_style($sheet, $column_letter, $column_data);
            $column_number++;
        }

        return $styles;
    }

    private function set_cell_style(Worksheet &$sheet, $column_letter, $column_data)
    {
        $range = "{$column_letter}3:{$column_letter}9999";

        if (($column_data['type'] ?? '') == 'select') {
            $options = $column_data['options'] ?? [];
            unset($options['']);

            $allowed_values = '"'.implode(',', $options).'"';

            $validation = $sheet->getDataValidation($range);
            $validation->setType(DataValidation::TYPE_LIST);
            $validation->setErrorStyle(DataValidation::STYLE_STOP);
            $validation->setAllowBlank(true);
            $validation->setShowErrorMessage(true);
            $validation->setErrorTitle("Attenzione");
            $validation->setError("Valore non ammesso");
            $validation->setShowDropDown(true);
            $validation->setFormula1($allowed_values);
            $sheet->setDataValidation($range, $validation);
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
