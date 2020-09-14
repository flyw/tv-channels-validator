<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Playlist
 * @package App\Models
 * @version September 9, 2020, 3:16 am UTC
 *
 * @property string $name
 * @property string $keywords
 * @property integer $priority
 */
class Playlist extends Model
{
    public $table = 'playlists';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'name',
        'keywords',
        'priority'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'keywords' => 'string',
        'priority' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:191',
        'keywords' => 'required|string',
        'priority' => 'required|integer'
    ];

    public static function findIdByName($name) {
        $playlists = Playlist::orderBy("priority", "ASC")->get();
        foreach ($playlists as $playlist) {
            $keywords = explode("\n", $playlist->keywords);
            foreach ($keywords as &$keyword) {
                $keyword = trim($keyword);
            }
            $regex = join("|", $keywords);
            if (preg_match("/$regex/", $name)) return $playlist->id;
        }
        return null;
    }

    public function getKeywordArray() {
        $keywords = explode("\n", $this->keywords);
        foreach ($keywords as &$keyword) {
            $keyword = trim($keyword);
        }
        return $keywords;
    }

    public function channels() {
        return $this->hasMany(Channel::class,"playlist_id");
    }


}
