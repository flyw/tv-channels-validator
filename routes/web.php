<?php

use App\Http\Controllers\LanguageController;

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    include_route_files(__DIR__.'/backend/');
});


Route::get('/home', 'HomeController@index');

Route::get("playlists/{playlistId}/edit-list", "PlaylistController@editList")->name("playlists.edit-list");
Route::patch("playlists/{playlistId}/update-list", "PlaylistController@updateList")->name("playlists.update-list");
Route::get("playlists/{playlistId}/sync", "PlaylistController@sync")->name("playlists.sync");
Route::resource('playlists', 'PlaylistController');



Route::get("channels/update-playlist-id", "ChannelController@updatePlaylistId")->name("channels.update-playlist-id");
Route::resource('channels', 'ChannelController');

Route::any('fxz', 'FxzController@index')->name("fxz.index");
Route::any('fxz/av', 'FxzController@indexWithAV')->name("fxz.index-with-av");
Route::any('fxz/test', 'FxzController@indexTest')->name("fxz.index-test");
