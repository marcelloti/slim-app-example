<?php
namespace SlimExample\Modules\Transactions\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'value',
        'payer',
        'payee',
        'created_at',
        'updated_at'
      ];
}