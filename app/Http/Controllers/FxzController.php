<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Playlist;
use Illuminate\Http\Request;

class FxzController extends Controller
{
    public function index() {

        $nullItem = [];
        $nullItem['id'] = null;
        $nullItem['name'] = "未分类";

        $playlist = Playlist::orderBy("priority", "ASC")->get();
        $playlist->push($nullItem);
        $playlistArray = $playlist->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        })->toArray();
        foreach ($playlistArray as $playlistId => $playlistName) {
            echo '$_start'.$playlistName.'$c_end'."\n";
            if ($playlistId != null) {
                $builder = Channel::where("playlist_id", $playlistId);
            }
            else {
                $builder = Channel::whereNull("playlist_id");
            }
            foreach ($builder->cursor() as $item) {
                echo $item->name.",".$item->url."\n";
            }
        }
    }
}
