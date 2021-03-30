<?php

namespace SlimExample\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
  protected $fillable = [
    'nome',
    'cpfcnpj',
    'email',
    'senha',
    'lojista'
  ];

  protected $hidden = [
    'senha'
  ];

  /*
  protected function setSenhaAttribute($value){
    // TODO Adicionar regra para geração de hash de senha
  }
  */
}