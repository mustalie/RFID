<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $primaryKey = 'ACC';
    protected $table = 'MatKul';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = [
        'TimeStamp',
        'LastModifiedBy',
        'LastModifiedDate'
    ];
}
