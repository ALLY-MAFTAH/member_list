<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MembersImport implements ToCollection,   WithValidation, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {

                $member = new Member([
                    'fullname' => $row['fullname'],
                    'id_number' => $row['id_number'],
                    'university' => $row['university'],
                    'phone1' => $row['phone1'],
                    'phone2' => $row['phone2'],
                    'amount' => $row['amount'],
                    'type' => $row['type'],

                ]);
                $member->save();
            }
        }
    }

    public function rules(): array
    {
        return [
            'id_number' => Rule::unique('members', 'id_number'),
        ];
    }

    public function customValidationMessages()
    {
        return [
            'id_number.unique' => 'Namba ya Kitambulisho Haitakiwi Kufanana',
        ];
    }
}
