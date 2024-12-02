<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DeviceRoom
 * @package App\Models
 * @version October 25, 2023, 3:34 am UTC
 *
 * @property \App\Models\Room $room
 * @property tiyinteger $antenna
 * @property integer $room_id
 */
class DeviceRoom extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'device_rooms';
    

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
        'device_id',
        'antenna',
        'room_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
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
    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id', 'id');
    }
}
