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
use App\CartItem;
use App\ProductSpec;
use App\Order;
use App\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
require_once(app_path().'/../vendor/autoload.php');

Route::get('/', function () {
	$artists = Artist::orderBy('created_at', 'asc')->limit(4)->get();
	$designs = Design::orderBy('created_at', 'asc')->limit(8)->get();
	return view('index', [
		"artists" => $artists,
		"designs" => $designs
	]);
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
	$design->description = $request->description;
	$design->artist_id = $request->artist_id;
	$design->tshirt_price = $request->tshirt_price;
	$design->canvas_price = $request->canvas_price;
	$design->image = $imageUrl;
	$design->tshirt_image = $tshirtImageUrl;
	$design->canvas_image = $canvasImageUrl;
	$design->view_count = 0;
	$design->save();

	return $design;
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/payment', function () {
    return view('payment');
});

Route::post('/charge', function (Request $request) {
	$user = Auth::user();
	$order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$cartItems = $order->cartItems;
	$total_price = 0;
	$shipping_cost = 0;
	foreach($cartItems as $cartItem) {
        $total_price += $cartItem->quantity * $cartItem->price_per_item;
        $shipping_cost += $cartItem->shipping_cost;
    }
    $total_amount = $total_price + $shipping_cost;

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
	  "amount" => $total_amount,
	  "currency" => "try",
	  "description" => "Example charge",
	  "metadata" => array("order_id" => $order->id),
	  "source" => $token,
	));

	$payment = new Payment;
	$payment->amount = $total_amount;
	$payment->user_id = $user->id;
	$payment->save();

	$order->payment_id = $payment->id;
	$order->save();

    return view('charge');
});

Route::get('/designs/{design_id}', function ($design_id) {
	DB::table('designs')->whereId($design_id)->increment('view_count');

	$design = Design::find($design_id);
	$similar_designs = Design::orderBy('created_at', 'asc')->whereNotIn("id", [$design_id])->limit(8)->get();
    return view('design_detail', [
    	"design" => $design,
    	"similar_designs" => $similar_designs
    ]);
});

Route::get('/designs', function () {
	$designs = Design::orderBy('created_at', 'asc')->get();
	return view('designs', [
		"designs" => $designs
	]);
});

Route::get('/checkout/cart', function () {
	$user = Auth::user();
	$order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$cartItems = $order->cartItems;
	return view('shopping-cart', ["cartItems" => $cartItems]);
})->middleware('auth');

Route::get('/checkout', function () {
	$user = Auth::user();
	$order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	return view('checkout-shipping-info', ["order" => $order]);
})->middleware('auth');

Route::get('/checkout/payment', function () {
	$user = Auth::user();
	$order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$cartItems = $order->cartItems;
	return view('checkout-payment', [
		"order" => $order,
		"cartItems" => $cartItems
	]);
})->middleware('auth');

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

Route::post('/api/v1/emails', function (Request $request) {
	$email = new Email;
	$email->email = $request->email;
	$email->save();
	return array("saved" => "true");
});

Route::delete('/api/v1/cartItem', function (Request $request) {
	$user = Auth::user();
	$order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$cartItems = $order->cartItems;
	foreach($cartItems as $cartItem) {
		if($cartItem->id == $request->id) {
			$cartItem->delete();
		}
	}
	return array("done" => 1);
})->middleware('auth');

Route::post('/api/v1/addToCart', function (Request $request) {
	$user = Auth::user();
	$order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	// if the item is the same as the item that was added before, only adjust the quantity.
	if($order) {
		$cartItems = $order->cartItems;
		foreach($cartItems as $cartItem) {
			if($cartItem->design->id == $request->designId) {
				$productSpec = ProductSpec::find($cartItem->product_spec_id);
				if($productSpec->type == $request->type &&
					$productSpec->size == $request->size && (
						($request->type == "tshirt" && $productSpec->gender == $request->gender) ||
						 $request->type == "canvas")
					) {
					$cartItem->quantity = $cartItem->quantity + 1;
					$cartItem->save();
					return $cartItem;
				}
			}
		}
	}

	$cartItem = new CartItem;
	$design = Design::find($request->designId);
	$cartItem->design_id = $design->id;

	if(!$order) {
		$order = new Order;
		$order->user_id = $user->id;
		$order->save();
	}
	$cartItem->order_id = $order->id;
	$cartItem->quantity = 1;

	$productSpec = new ProductSpec;
	$productSpec->type = $request->type;
	$productSpec->size = $request->size;
	if($request->type == "tshirt") {
		$productSpec->gender = $request->gender;
	}
	$productSpec->save();

	$cartItem->product_spec_id = $productSpec->id;
	if($request->type == "tshirt") {
		$cartItem->price_per_item = $design->tshirt_price;
	} else if ($request->type == "canvas") {
		$cartItem->price_per_item = $design->canvas_price;
	}
	$cartItem->shipping_cost = 1000;
	$cartItem->save();

	$productSpec->cart_item_id = $cartItem->id;
	$productSpec->save();
	return $cartItem;
})->middleware('auth');

Route::get('/api/v1/cartInfo', function () {
	$user = Auth::user();
	$order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$cartItems = $order->cartItems;
	// $count = 0;
	// foreach($cartItems as $cartItem) {
	// 	$count += $cartItem->quantity;
	// }
	for($i=0; $i < count($cartItems); $i++) {
		$cartItems[$i]->product_spec = $cartItems[$i]->productSpec;
		$cartItems[$i]->design = $cartItems[$i]->design;
	}
	return array("cartItems" => $cartItems);
})->middleware('auth');

Route::post('/api/v1/shippingInfo', function (Request $request) {
	$shippingInfo = new ShippingInfo;
	$shippingInfo->name = $request->firstname;
	$shippingInfo->last_name = $request->lastname;
	$shippingInfo->address = $request->address;
	$shippingInfo->city = $request->city;
	$shippingInfo->country = $request->country;
	$shippingInfo->phone_number = $request->phone_number;
	$shippingInfo->save();

	$order = Order::find($request->order_id);
	$order->shipping_info_id = $shippingInfo->id;
	$order->save();

    $shippingInfo->order_id = $order->id;
    $shippingInfo->save();

	return $shippingInfo;
})->middleware('auth');
