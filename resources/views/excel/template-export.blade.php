<?php
/** @var array $columns */
/** @var array $rows */
?>

<table>
    <thead>
    <tr>
        @foreach($columns as $key=>$column)
            @continue(empty($column['label']))
            <th>
                {{$key}}
            </th>
        @endforeach
    </tr>
    <tr>
        @foreach($columns as $column)
            @continue(empty($column['label']))
            <th>
                {{$column['label']}}
                @if(!empty($column['append']))
                    ({{$column['append']}})
                @endif
            </th>
        @endforeach
    </tr>

    @foreach($rows as $row)
        <tr>
            @foreach($columns as $key=>$column)
                <td>
                    {{$row[$key]??''}}
                </td>
            @endforeach
        </tr>
    @endforeach

    </thead>
    <tbody>

    </tbody>
</table>
