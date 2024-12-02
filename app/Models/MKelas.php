<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// model untuk ruang kelas (room)
class MKelas extends Model
{
    use HasFactory;
    protected $primaryKey = 'ACC';
    protected $table = 'MKelas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = [
        'TimeStamp',
        'LastModifiedBy',
        'LastModifiedDate'
    ];
}
