<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class InventoryGroup
 * @package App\Models
 * @version October 26, 2023, 2:08 am UTC
 *
 * @property string $name
 * @property tinyinteger $required_permission
 * @property string $status
 */
class InventoryGroup extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'inventory_groups';
    

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    public $fillable = [
        'name',
        'required_permission',
        'status'
    ];
    

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'required_permission' => 'boolean',
        'status' => 'string',
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
