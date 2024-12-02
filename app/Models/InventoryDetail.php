<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class InventoryDetail
 * @package App\Models
 * @version October 26, 2023, 2:08 am UTC
 *
 * @property \App\Models\Persediaan $acc
 * @property \App\Models\InventoryGroup $group
 * @property \App\Models\Room $room
 * @property string $ACC
 * @property integer $group_id
 * @property integer $room_id
 */
class InventoryDetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'inventory_details';
    

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
        'ACC',
        'group_id',
        'room_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ACC' => 'string',
        'group_id' => 'integer',
        'room_id' => 'integer',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function persediaan()
    {
        return $this->belongsTo(\App\Models\Persediaan::class, 'ACC', 'ACC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function group()
    {
        return $this->belongsTo(\App\Models\InventoryGroup::class, 'group_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id', 'id');
    }
}
