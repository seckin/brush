<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Email;
use App\Artist;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function () {
    return view('email');
});

Route::post('/email', function (Request $request) {
	$email = new Email;
	$email->email = $request->email;
	$email->save();
    return view('email_result');
});

Route::get('/create-artist', function () {
    return view('create_artist');
});

Route::post('/create-artist', function (Request $request) {
	$s3Prefix = 'https://s3-eu-west-1.amazonaws.com/trybrush';
	$highlightedImage = $request->file('highlighted_image');
	// echo "highlightedImage: " . $highlightedImage;
	$highlightedImageFileName = time() . "-" . $highlightedImage->getClientOriginalName();
	// echo "highlightedImageFileName: " . $highlightedImageFileName;
	$s3 = \Storage::disk('s3');
	$highlightedFilePath = '/images/' . $highlightedImageFileName;
	$result = $s3->put($highlightedFilePath, file_get_contents($highlightedImage), 'public');
	$highlightedImageUrl = $s3Prefix . $highlightedFilePath;

	$profileImage = $request->file('profile_image');
	$profileImageFileName = time() . "-" . $profileImage->getClientOriginalName();
	// echo "profileImageFileName: " . $profileImageFileName;
	$profileFilePath = '/images/' . $profileImageFileName;
	$result = $s3->put($profileFilePath, file_get_contents($profileImage), 'public');
	$profileImageUrl = $s3Prefix . $profileFilePath;
	// echo "filePath:" . $profileFilePath;
	// https://s3-eu-west-1.amazonaws.com/trybrush/images/15123073_1357558120922581_4395957158623499304_o.jpg-1491856369.jpg

	$artist = new Artist;
	$artist->name = $request->name;
	$artist->highlighted_image = $highlightedImageUrl;
	$artist->profile_image = $profileImageUrl;
	$artist->location = $request->location;
	$artist->description = $request->description;
	$artist->save();

	return $artist;
});