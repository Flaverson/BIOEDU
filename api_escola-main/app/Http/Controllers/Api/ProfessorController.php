<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professor;

class ProfessorController extends Controller
{
    public function listarTurmas($id){
        //encontra o prof por id ou falha e retorna um erro 404
        $professor = Professor::findOrFail($id);

        //carrega os turmas que pertencem a esse professor e retorna como json
        return response()->json($professor->turmas);
    }
}
