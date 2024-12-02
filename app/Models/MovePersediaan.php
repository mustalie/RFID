<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovePersediaan extends Model
{
    use HasFactory;
    protected $primaryKey = 'FAK';
    protected $table = 'MovePersediaan';
    public $incrementing = false;
    protected $keyType = 'string';
}
