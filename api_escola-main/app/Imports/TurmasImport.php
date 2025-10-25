<?php

namespace App\Imports;

use App\Models\Turma;
use Maatwebsite\Excel\Concerns\ToModel;

class TurmasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        static $header = true;
        if ($header) {
            $header = false;
            return null;
        }

        return new Turma([
            'nome' => $row[0], // Coluna A
            'ano_letivo' => $row[1], // Coluna B
            'id_professor' => $row[2], // Coluna C
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255', 
            '1' => 'required|integer|min:2000|max:2100', 
            '2' => 'required|integer|exists:professores,id_professor',
        ];
    }
}
