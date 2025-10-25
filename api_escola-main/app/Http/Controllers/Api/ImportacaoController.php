<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; //importa a fachada do excel
use App\Imports\AlunosImport; //importa a classe que criei
use App\Imports\ProfessoresImport;
use App\Imports\TurmasImport;
use Maatwebsite\Excel\Validators\ValidationException; 

class ImportacaoController extends Controller
{
    public function importarAlunos(Request $request)
    {
        $request->validate([
        'arquivo_alunos' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        $arquivo = $request->file('arquivo_alunos');

    Excel::import(new AlunosImport, $arquivo);

    return response()->json([
        'message' => 'Tentativa de importação por índice CONCLUÍDA! Verifique o banco de dados.'
    ], 200);
    }

    public function importarProfessores(Request $request)
    {
        $request->validate([
            'arquivo_professores' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        $arquivo = $request->file('arquivo_professores');

        Excel::import(new ProfessoresImport, $arquivo);

        return response()->json([
            'message' => 'Professores da planilha "' . $arquivo->getClientOriginalName() . '" importados com sucesso!'
        ], 200);
    }

    public function importarTurmas(Request $request)
    {
        $request->validate([
            'arquivo_turmas' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        $arquivo = $request->file('arquivo_turmas');

        Excel::import(new TurmasImport, $arquivo);

        return response()->json([
            'message' => 'Turmas da planilha "' . $arquivo->getClientOriginalName() . '" importadas com sucesso!'
        ], 200);
    }
}