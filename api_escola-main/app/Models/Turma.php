<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';
    public $timestamps = false; // Se sua tabela não tiver created_at/updated_at

    // Colunas que podem ser preenchidas pela planilha
    protected $fillable = [
        'nome',
        'ano_letivo',
        'id_professor',
    ];

    public function professor(){
        return $this->belongsTo(Professor::class);
    }

    public function alunos(){
        return $this->belongsToMany(Aluno::class, 'aluno_turma', 'id_turma', 'id_aluno');
    }
}
