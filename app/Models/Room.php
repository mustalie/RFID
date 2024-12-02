<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Room
 * @package App\Models
 * @version October 18, 2023, 4:19 am UTC
 *
 * @property string $name
 * @property string $category
 * @property string $status
 */
class Room extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rooms';
    

    protected $dates = ['deleted_at'];


    public $hidden = [
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $fillable = [
        'name',
        'category',
        'need_request_movement',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'category' => 'string',
        'status' => 'string',
        'need_request_movement' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
