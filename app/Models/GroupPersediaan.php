<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPersediaan extends Model
{
    use HasFactory;
    protected $primaryKey = 'ACC';
    protected $table = 'GropPersediaan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = [
        'TimeStamp',
        'LastModifiedBy',
        'LastModifiedDate'
    ];

    public function persediaan()
    {
        return $this->belongsTo(Persediaan::class, 'ACC', 'ACC');
    }
}
