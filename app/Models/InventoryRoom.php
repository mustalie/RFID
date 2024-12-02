<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class InventoryRoom
 * @package App\Models
 * @version October 25, 2023, 9:13 am UTC
 *
 * @property \App\Models\Persediaan $acc
 * @property \App\Models\Room $room
 * @property integer $ACC
 * @property integer $room_id
 */
class InventoryRoom extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'inventory_rooms';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'ACC',
        'room_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ACC' => 'string',
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
    public function acc()
    {
        return $this->belongsTo(\App\Models\Persediaan::class, 'ACC', 'ACC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id', 'id');
    }
}
