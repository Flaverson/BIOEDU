<?php

namespace App\Imports;

use App\Models\Aluno;
use App\Models\Turma;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlunoTurmaImport implements OnEachRow, WithHeadingRow
{
    protected $turma;
    public $contador = 0; // Contador público para contar alunos importados

    // Usamos o construtor para receber a turma que estamos atualizando
    public function __construct(Turma $turma)
    {
        $this->turma = $turma;
    }

    /**
     * Este método é chamado para cada linha da planilha
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        // Pega a matrícula da planilha (assumindo que o cabeçalho é 'matricula')
        $matricula = $row['matricula'] ?? null;

        if ($matricula) {
            // Encontra o aluno no banco de dados pela matrícula
            $aluno = Aluno::where('matricula',  strval($matricula))->first();

            // Se o aluno existir, anexa ele à turma
             if ($aluno) {
                $this->turma->alunos()->syncWithoutDetaching($aluno->id);
                $this->contador++;
            }
        }
    }
}