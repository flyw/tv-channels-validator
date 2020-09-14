<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Channel
 * @package App\Models
 * @version September 9, 2020, 3:43 am UTC
 *
 * @property integer $playlist_id
 * @property string $name
 * @property string $scheme
 * @property string $domain
 * @property string $url
 * @property integer $valid
 * @property integer $check_count
 * @property integer $valid_count
 */
class Channel extends Model
{
    use SoftDeletes;

    public $table = 'channels';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'playlist_id',
        'name',
        'scheme',
        'domain',
        'url',
        'valid',
        'check_count',
        'valid_count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'playlist_id' => 'integer',
        'name' => 'string',
        'scheme' => 'string',
        'domain' => 'string',
        'url' => 'string',
        'valid' => 'integer',
        'check_count' => 'integer',
        'valid_count' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'playlist_id' => 'nullable|integer',
        'name' => 'required|string|max:191',
        'scheme' => 'required|string|max:191',
        'domain' => 'required|string|max:191',
        'url' => 'required|string|max:512',
        'valid' => 'required',
        'check_count' => 'required|integer',
        'valid_count' => 'required|integer'
    ];

    public function playlist() {
        return $this->belongsTo(Playlist::class, "playlist_id");
    }

}
