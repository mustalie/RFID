<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemMovement
 * @package App\Models
 * @version October 18, 2023, 8:35 am UTC
 *
 * @property \App\Models\Tag $tag
 * @property integer $tag_id
 * @property string $location
 */
class ItemMovement extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'item_movements';
    

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];


    public $fillable = [
        'tag_id',
        'room_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tag_id' => 'integer',
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
    public function tag()
    {
        return $this->belongsTo(\App\Models\Tag::class, 'tag_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id', 'id');
    }
}
