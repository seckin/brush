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
use App\Design;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
require_once(app_path().'/../vendor/autoload.php');

Route::get('/', function () {
	return view('index');
    // return view('welcome');
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
	$highlightedImageUrl = upload_to_s3($request->file('highlighted_image'));
	$profileImageUrl = upload_to_s3($request->file('profile_image'));

	$artist = new Artist;
	$artist->name = $request->name;
	$artist->highlighted_image = $highlightedImageUrl;
	$artist->profile_image = $profileImageUrl;
	$artist->location = $request->location;
	$artist->description = $request->description;
	$artist->save();

	return $artist;
});

Route::get('/create-design', function () {
    return view('create_design');
});

Route::post('/create-design', function (Request $request) {
	$imageUrl = upload_to_s3($request->file('image'));
	$tshirtImageUrl = upload_to_s3($request->file('tshirt_image'));
	$canvasImageUrl = upload_to_s3($request->file('canvas_image'));

	$design = new Design;
	$design->name = $request->name;
	$design->artist_id = $request->artist_id;
	$design->tshirt_price = $request->tshirt_price;
	$design->canvas_price = $request->canvas_price;
	$design->image = $imageUrl;
	$design->tshirt_image = $tshirtImageUrl;
	$design->canvas_image = $canvasImageUrl;
	$design->save();

	return $design;
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/payment', function () {
    return view('payment');
});

Route::post('/charge', function (Request $request) {
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey("sk_live_5mwPn4FvBtOByFUn3tS76ETY");

	// echo "request->stripeToken: " . $request->stripeToken . "\n";
	// echo json_encode($request->all()) . "\n";

	// Token is created using Stripe.js or Checkout!
	// Get the payment token submitted by the form:
	$token = $_POST['stripeToken'];
	// echo "token:" . $token;

	// Charge the user's card:
	$charge = \Stripe\Charge::create(array(
	  "amount" => 200,
	  "currency" => "try",
	  "description" => "Example charge",
	  "metadata" => array("order_id" => 6735),
	  "source" => $token,
	));

    return view('charge');
});

Route::get('/designs/design', function () {
    return view('design_detail');
});

Route::get('/api/v1/artists', function () {
	$results = Artist::orderBy('created_at', 'asc')->get();
	return $results;
});

Route::get('/api/v1/artists/{artist_id}', function ($artist_id) {
	$artist = Artist::find($artist_id);
	//$designs = Artist::with('designs')->find($artist_id)->designs;
	$designs = $artist->designs;
	$artist->designs = $designs;
	return array($artist);
});

Route::get('/api/v1/designs', function () {
	$results = Design::orderBy('created_at', 'asc')->get();
	return $results;
});

Route::get('/api/v1/designs/{design_id}', function ($design_id) {
	$design = Design::find($design_id);
	$artist = $design->artist;
	$design->artist = $artist;
	return $design;
});
