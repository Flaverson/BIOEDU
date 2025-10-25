<?php

namespace App\Imports;

use App\Models\Aluno;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlunosImport implements ToModel
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

        return new Aluno([
            'nome'            => $row[0], // Coluna A
            'data_nascimento' => $row[1], // Coluna B
            'matricula'       => $row[2], // Coluna C
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255', // Nome (Coluna A)
            '1' => 'required|date',           // Data Nascimento (Coluna B)
            '2' => 'required|string|unique:alunos,matricula', // Matrícula (Coluna C)
        ];
    }
}