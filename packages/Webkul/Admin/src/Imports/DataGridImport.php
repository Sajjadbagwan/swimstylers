<?php

namespace Swim\Admin\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;


/**
 * DataGridImport class
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
*/

class DataGridImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     * @return void
    */
    public function collection(Collection $rows)
    {
    }
}