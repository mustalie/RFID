<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Checkin
 * @package App\Models
 * @version October 18, 2023, 3:22 am UTC
 *
 * @property \App\Models\Tag $tag
 * @property integer $tag_id
 * @property string $location
 */
class Checkin extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'checkins';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'tag_id',
        'location'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tag_id' => 'integer',
        'location' => 'string',
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
}
