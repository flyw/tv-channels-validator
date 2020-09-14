<?php

namespace App\Repositories;

use App\Models\Playlist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PlaylistRepository
 * @package App\Repositories
 * @version September 9, 2020, 3:16 am UTC
 *
 * @method Playlist findWithoutFail($id, $columns = ['*'])
 * @method Playlist find($id, $columns = ['*'])
 * @method Playlist first($columns = ['*'])
*/
class PlaylistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'keywords',
        'priority'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Playlist::class;
    }
}
