<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Stream audio files through Laravel to support HTTP 206 Partial Content (Byte-Range requests)
// This is strictly required for the HTML5 audio progress bar seeking to work on a local dev server.
Route::get('/stream-audio/{filename}', function ($filename) {
    $path = public_path('assets/audio/songs/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
});
