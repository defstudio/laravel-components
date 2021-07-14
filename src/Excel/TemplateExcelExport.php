<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpUnhandledExceptionInspection */


namespace DefStudio\Components\Excel;


use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Excel;

class TemplateExcelExport implements WithMultipleSheets, Responsable, ShouldAutoSize
{
    use Exportable;

    public const ALPHABET = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
    ];

    private array $columns;
    private array $rows;

    private string $fileName;

    private string $writerType = Excel::XLSX;

    public function __construct(string $filename, array $columns, array $rows)
    {
        $this->columns = $this->normalize_columns($columns);
        $this->rows = $rows;
        $this->fileName = "$filename.xlsx";
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

        foreach ($columns as &$column) {
            if (data_get($column, 'type') == 'select') {
                $values_column = [];
                $values_column[] = data_get($column, 'label');

                $options = array_values(data_get($column, 'options', []));
                unset($options['']);
                $values_column = array_merge($values_column, $options);
                $column['values_column'] = $values_column;
            }
        }

        return $columns;
    }

    public function sheets(): array
    {
        return [
            new TemplateSheet($this->columns, $this->rows),
            new DataSheet($this->columns, $this->rows),
        ];
    }
}
