<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Playlist;

class FxzController extends Controller
{
    public function index() {
        $playlist = Playlist::orderBy("priority", "ASC")
            ->where("priority","<", 100)
            ->get();
        $this->showList($playlist);

    }

    public function indexWithAV() {
        $playlist = Playlist::orderBy("priority", "ASC")->get();
        $this->showList($playlist);
    }

    public function indexTest() {
        $playlist = Playlist::orderBy("priority", "ASC")->get();
        $this->showList($playlist, true);
    }





    private function showList($playlist, $test = false) {

        $nullItem = [];
        $nullItem['id'] = null;
        $nullItem['name'] = "未分类";

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

            if ($test == false) {
                $builder = $builder->where("valid", 1);
            }
            foreach ($builder->cursor() as $item) {
                echo $item->name.",".$item->url."\n";
            }
        }
    }

}
