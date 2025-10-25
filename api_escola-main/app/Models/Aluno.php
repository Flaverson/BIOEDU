<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Aluno extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'matricula'
    ];

    protected $casts = [
        'data_nascimento' => 'date'
    ];

    public $timestamps = false;

    public function turmas() {
        return $this->belongsToMany(Turma::class, 'aluno_turma');
    }
}
