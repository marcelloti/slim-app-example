<?php

namespace SlimExample\Modules\Authentication\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
  protected $fillable = [
    'nome',
    'cpf',
    'email',
    'senha'
  ];

  protected $hidden = [
    'senha'
  ];

  protected function setSenhaAttribute($value){
    // TODO Adicionar regra para geração de hash de senha
  }
}