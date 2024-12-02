<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TagMap
 * @package App\Models
 * @version October 18, 2023, 3:14 am UTC
 *
 * @property \App\Models\Tag $tag
 * @property integer $tag_id
 * @property integer $item_id
 * @property string $item_type
 */
class TagMap extends Model
{
    use SoftDeletes;

    use HasFactory;
    public const TYPE_STUDENT = 'student';
    public const TYPE_DOSEN = 'dosen';
    public const TYPE_INVENTORY = 'inventory';

    public $table = 'tag_maps';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'tag_id',
        'item_id',
        'item_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tag_id' => 'integer',
        'item_id' => 'string',
        'item_type' => 'string',
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

    public function student()
    {
        return $this->hasOne(Mahasiswa::class, 'NIM', 'item_id');//->where('tag_maps.item_type', $this::TYPE_STUDENT);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'NID', 'item_id');//->where('item_type', $this::TYPE_DOSEN);
    }

    public function inventory()
    {
        return $this->hasOne(Persediaan::class, 'ACC', 'item_id');//->where('item_type', $this::TYPE_INVENTORY);
    }
}
