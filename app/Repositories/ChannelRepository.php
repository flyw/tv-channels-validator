<?php

namespace App\Repositories;

use App\Models\Channel;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ChannelRepository
 * @package App\Repositories
 * @version September 9, 2020, 3:43 am UTC
 *
 * @method Channel findWithoutFail($id, $columns = ['*'])
 * @method Channel find($id, $columns = ['*'])
 * @method Channel first($columns = ['*'])
*/
class ChannelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Channel::class;
    }
}
