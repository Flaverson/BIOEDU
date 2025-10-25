<?php

namespace App\Imports;

use App\Models\Professor;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProfessoresImport implements ToModel, WithValidation, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

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

        return new Professor([
            'nome' => $row[0], // Coluna A
            'email' => $row[1], // Coluna B
            'disciplina' => $row[2] ?? null, // Coluna C

            'senha' => bcrypt(Str::random(10)), // Senha padrão
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255', // Nome (Coluna A)
            '1' => 'required|email|unique:usuarios,email', // Email (Coluna B)
            '2' => 'required|string|max:255', // Disciplina (Coluna C)
        ];
    }   
}
