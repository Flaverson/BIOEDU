<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Turma;
use Illuminate\Http\Request;
use App\Imports\AlunoTurmaImport;
use Maatwebsite\Excel\Facades\Excel;

class TurmaController extends Controller
{
    public function adicionarAlunos(Request $request, Turma $turma)
    {
        $request->validate([
            'arquivo_alunos_turma' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        $arquivo = $request->file('arquivo_alunos_turma');

        // Executa a importação, passando a $turma da URL para a classe de importação
        Excel::import(new AlunoTurmaImport($turma), $arquivo);

        return response()->json([
            'message' => 'Alunos adicionados à turma "' . $turma->nome . '" com sucesso!'
        ], 200);
    }
}