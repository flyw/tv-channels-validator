<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Models\Channel;
use App\Models\Playlist;
use App\Repositories\ChannelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ChannelController extends AppBaseController
{
    /** @var  ChannelRepository */
    private $channelRepository;

    public function __construct(ChannelRepository $channelRepo)
    {
        $this->channelRepository = $channelRepo;
    }

    /**
     * Display a listing of the Channel.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->channelRepository->pushCriteria(new RequestCriteria($request));
        $this->channelRepository->pushCriteria(new class() implements CriteriaInterface {
            public function apply($model, RepositoryInterface $repository) {
                if (request()->has("scheme") && request()->get("scheme") == "全部") return $model;
                if (request()->has("scheme"))return $model->where('scheme', request()->get("scheme"));
                return $model;
            }
        });

        $this->channelRepository->pushCriteria(new class() implements CriteriaInterface {
            public function apply($model, RepositoryInterface $repository) {
                if (request()->has("playlist") && request()->get("playlist") == "0")
                    return $model->whereNull('playlist_id');
                if (request()->has("playlist"))
                    return $model->where('playlist_id', request()->get("playlist"));
                return $model;
            }
        });

        $this->channelRepository->pushCriteria(new class() implements CriteriaInterface {
            public function apply($model, RepositoryInterface $repository) {
                if (request()->has("domain"))
                    return $model->where('domain', request()->get("domain"));
                return $model;
            }
        });
        $channels = $this->channelRepository->paginate();

        $schemes = Channel::select(["scheme"])->groupBy("scheme")->get();

        $item = new \stdClass();
        $item->scheme = "全部";
        $schemes->prepend($item);

        $playlists = Playlist::orderBy("priority", 'ASC')->get();

        $item = new \stdClass();
        $item->name = "(NULL)";
        $item->id = 0;
        $playlists->prepend($item);

        $item = new \stdClass();
        $item->name = "全部";
        $item->id = null;
        $playlists->prepend($item);
        $currentPlaylist = optional(Playlist::find($request->get('playlist')))->name;
        if ($request->get("playlist") == "0")
            $currentPlaylist = "(NULL)";

        return view('channels.index')
            ->with("currentScheme", $request->get('scheme'))
            ->with("schemes", $schemes)
            ->with("currentPlaylist", $currentPlaylist)
            ->with("playlists", $playlists)
            ->with("currentDomain", $request->get("domain"))
            ->with('channels', $channels);
    }

    /**
     * Show the form for creating a new Channel.
     *
     * @return Response
     */
    public function create()
    {
        return view('channels.create-from-list');
    }

    /**
     * Store a newly created Channel in storage.
     *
     * @param CreateChannelRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $items = preg_split("/\n/", $request->get('list'));
        foreach ($items as &$item) {
            $item = trim($item);
            if (false == preg_match("/,/", $item)) continue;
            $url = preg_replace("/^.*,/", "", $item);
            $channel = Channel::withTrashed()->firstOrNew(["url"=>$url]);
            $channel->name = preg_replace("/,.*?$/", "", $item);
            $urlInfo = parse_url($url);
            if (isset($urlInfo['scheme']) == false) continue;
            $channel->scheme = $urlInfo['scheme'];
            $channel->domain = $urlInfo['host'];
            $channel->playlist_id = Playlist::findIdByName($channel->name);
            $channel->valid = 1;
            $channel->save();
        }

        Flash::success('Channel saved successfully.');

        return redirect(route('channels.index'));
    }


    public function updatePlaylistId(Request $request)
    {
        $channels = Channel::whereNull("playlist_id")->get();
        foreach ($channels as $channel) {
            $playlistId = Playlist::findIdByName($channel->name);
            if ($playlistId) {
                $channel->playlist_id = $playlistId;
                $channel->save();
            }
        }

        Flash::success('PlaylistId saved successfully.');

        return redirect(route('channels.index'));
    }

    /**
     * Display the specified Channel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $channel = $this->channelRepository->findWithoutFail($id);

        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }

        return view('channels.show')->with('channel', $channel);
    }

    /**
     * Show the form for editing the specified Channel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $channel = $this->channelRepository->findWithoutFail($id);

        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }
        $nullItem = [];
        $nullItem['id'] = null;
        $nullItem['name'] = "NULL";

        $playlist = Playlist::orderBy("priority", "ASC")->get();
        $playlist->prepend($nullItem);
        $playlistArray = $playlist->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        })->toArray();

        return view('channels.edit')
            ->with("playlistArray", $playlistArray)
            ->with('channel', $channel);
    }

    /**
     * Update the specified Channel in storage.
     *
     * @param  int              $id
     * @param UpdateChannelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChannelRequest $request)
    {
        $channel = $this->channelRepository->findWithoutFail($id);

        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }

        $channel = $this->channelRepository->update($request->all(), $id);

        Flash::success('Channel updated successfully.');

        return redirect(route('channels.index'));
    }

    public function setValid($channelId) {
        $channel = Channel::find($channelId);
        if ($channel->valid) {
            $channel->valid = 0;
        }
        else {
            $channel->valid = 1;
        }
        $channel->save();
        return response()->json(collect($channel)->only("valid")->toArray(), 200);
    }

    /**
     * Remove the specified Channel from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $channel = $this->channelRepository->findWithoutFail($id);

        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }

        $this->channelRepository->delete($id);

        Flash::success('Channel deleted successfully.');

        return redirect(route('channels.index'));
    }
}
