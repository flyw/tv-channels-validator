<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Playlist;

class BcController extends Controller
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
        $this->showListDebug($playlist);
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
            echo "\n".$playlistName.',#genre#'."\n";
            if ($playlistId != null) {
                $builder = Channel::where("playlist_id", $playlistId);
            }
            else {
                $builder = Channel::whereNull("playlist_id");
            }

            $builder = $builder ->orderBy("valid", "DESC")
                ->orderBy("name", "ASC")
                ->orderBy("scheme", 'DESC');

            $builder = $builder->where("valid", 1)
            ->where('scheme', '!=', 'mitv');

            $prevName = "";
            foreach ($builder->cursor() as $item) {
                if (preg_match("/^p8p/", $item->url)) {
                    $item->url = preg_replace("/^p8p/", "p5p", $item->url);
                }
                if ($prevName == $item->name) {
                    echo "#".$item->url;
                } else {
                    echo "\n".$item->name.",".$item->url;
                }
                $prevName = $item->name;
            }
        }
    }


    private function showListDebug($playlist) {

        $nullItem = [];
        $nullItem['id'] = null;
        $nullItem['name'] = "未分类";

        $playlist->push($nullItem);
        $playlistArray = $playlist->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        })->toArray();
        foreach ($playlistArray as $playlistId => $playlistName) {
            echo $playlistName.',#genre#'."\n";
            if ($playlistId != null) {
                $builder = Channel::where("playlist_id", $playlistId);
            }
            else {
                $builder = Channel::whereNull("playlist_id");
            }

            $builder = $builder ->orderBy("valid", "DESC")
                ->orderBy("name", "ASC");

            foreach ($builder->cursor() as $item) {
                $valid = ($item->valid == 0)?"(失效)":"";
                echo $item->name.$valid."($item->scheme $item->domain),".$item->url."\n";
            }
        }
    }

}
