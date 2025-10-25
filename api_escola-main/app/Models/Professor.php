<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Importante para login
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Essencial para a API com Sanctum

class Professor extends Authenticatable // 1. Extende Authenticatable para permitir login
{
    use HasApiTokens, HasFactory, Notifiable; // 2. Usa as traits necessárias

    /**
     * 3. O nome da tabela no banco de dados.
     */
    protected $table = 'professores';

    /**
     * 4. A chave primária da tabela, se não for 'id'.
     */
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'nome',
        'email',
        'disciplina',
        'senha'
    ];

    protected $hidden = [
        'senha',
        'remember_token', 
    ];

    public function turmas()
    {
        // O segundo argumento é a chave estrangeira na tabela 'turmas'
        return $this->hasMany(Turma::class, 'id_professor'); 
    }
}