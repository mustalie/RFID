<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StudentPresence
 * @package App\Models
 * @version October 18, 2023, 4:15 am UTC
 *
 * @property \App\Models\Room $room
 * @property string $nim
 * @property integer $room_id
 */
class StudentPresence extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'student_presences';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nim',
        'room_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nim' => 'string',
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
