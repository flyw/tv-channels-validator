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

    public static function saveItems($items, $playlistId = null) {
        foreach ($items as &$item) {
            $item = trim($item);
            if (false == preg_match("/,/", $item)) continue;
            $url = preg_replace("/^.*,/", "", $item);
            $channel = Channel::withTrashed()->firstOrNew(["url"=>$url]);
            if ($channel->name == null) {
                $channel->name = preg_replace("/,.*?$/", "", $item);
            }
            $urlInfo = parse_url($url);
            if (isset($urlInfo['scheme']) == false) continue;
            $channel->scheme = $urlInfo['scheme'];
            $channel->domain = $urlInfo['host'];
            if ($urlInfo['scheme'] == 'tvbus') $channel->domain = 'tvbus';
                if ($channel->playlist_id == null) {
                if ($playlistId == null ) {
                    $channel->playlist_id = Playlist::findIdByName($channel->name);
                } else {
                    $channel->playlist_id = $playlistId;
                }
            }

            if ($channel->valid === null) {
                $channel->valid = 1;
            }
            $channel->save();
        }
    }

}
