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
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
require_once(app_path().'/../vendor/autoload.php');

// Route::group(['middleware' => ['web']], function () {

Route::get('/', function () {
	$artists = Artist::orderBy('created_at', 'asc')->limit(4)->get();
	$designs = Design::orderBy('created_at', 'asc')->limit(8)->get();
	return view('index', [
		"artists" => $artists,
		"designs" => $designs
	]);
    // return view('welcome');
});
Route::get('/test', function (Request $request) {

	$order = Order::find(6);
	$order->payment_at = new \DateTime();
	$order->save();
	// Session::flash('status', 'Task was successful!');

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
	$design->tshirt_limit = $request->tshirt_limit;
	$design->canvas_price = $request->canvas_price;
	$design->canvas_limit = $request->canvas_limit;
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
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order_id = $request->order_id;
	$order = Order::find($order_id);
	$cartItems = $order->cartItems;
	$total_price = 0;
	$shipping_cost = 800;
	foreach($cartItems as $cartItem) {
        $total_price += $cartItem->quantity * $cartItem->price_per_item;
        // $shipping_cost += $cartItem->shipping_cost;
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
	  "description" => "Charge for " . $user->email,
	  "metadata" => array("order_id" => $order->id),
	  "source" => $token,
	  "receipt_email" => $user->email,
	));

	$payment = new Payment;
	$payment->amount = $total_amount;
	$payment->user_id = $user->id;
	$payment->save();

	$order->payment_id = $payment->id;
	$order->payment_at = new \DateTime();
	$order->save();

	Session::forget('order_id');

    return view('charge');
})->middleware('auth');

Route::get('/designs/{design_id}', function ($design_id) {
	DB::table('designs')->whereId($design_id)->increment('view_count');

	$design = Design::find($design_id);
	$similar_designs = Design::orderBy('created_at', 'asc')->whereNotIn("id", [$design_id])->limit(8)->get();

	$cartItems = CartItem::orderBy('created_at', 'asc')->where("design_id", '=', $design->id)->get();
    $canvasTotalSold = 0;
    foreach($cartItems as $cartItem) {
        if($cartItem->productSpec && $cartItem->productSpec->type == "canvas") {
        	if($cartItem->order) {
	        	$payment = Payment::find($cartItem->order->payment_id);
	        	if($payment) {
	                $canvasTotalSold += $cartItem->quantity;
		        }
		    }
        }
    }

    $tshirtTotalSold = 0;
    foreach($cartItems as $cartItem) {
        if($cartItem->productSpec && $cartItem->productSpec->type == "tshirt") {
            if($cartItem->order) {
            	$payment = Payment::find($cartItem->order->payment_id);
            	if($payment) {
	                $tshirtTotalSold += $cartItem->quantity;
	            }
	        }
        }
    }
    return view('design_detail', [
    	"design" => $design,
    	"similar_designs" => $similar_designs,
    	"canvas_total_sold" => $canvasTotalSold,
    	"canvas_limit" => $design->canvas_limit ? $design->canvas_limit : 50,
    	"tshirt_total_sold" => $tshirtTotalSold,
    	"tshirt_limit" => $design->tshirt_limit ? $design->tshirt_limit : 50
    ]);
});

Route::get('/designs', function () {
	$designs = Design::orderBy('created_at', 'desc')->get();
	return view('designs', [
		"designs" => $designs
	]);
});

Route::get('/artists/{artist_id}', function ($artist_id) {
	$artist = Artist::find($artist_id);
	$designs = $artist->designs;

    return view('artist_profile', [
    	"artist" => $artist,
    	"designs" => $designs
    ]);
});

Route::get('/artists', function () {
	$artists = Artist::orderBy('created_at', 'desc')->get();
	return view('artists', [
		"artists" => $artists
	]);
});

Route::get('/my-account', function () {
	$user = Auth::user();
	$orders = Order::orderBy('created_at', 'desc')->where("payment_id", '!=', null)->where("user_id", "=", $user->id)->get();
	$dates = array();
	for($i = 0; $i<count($orders); $i++) {
		$date = date_create(Carbon::parse($orders[$i]->payment_at)->addHours(3));
		$formatted_date = date_format($date, 'g:ia \o\n l jS F Y');
		array_push($dates, $formatted_date);
	}

	return view('my-account', [
		"orders" => $orders,
		"dates" => $dates
	]);
})->middleware('auth');

Route::get('/checkout/cart', function () {
	// $user = Auth::user();
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order_id = Session::get("order_id");
	$order = Order::find($order_id);
	if(!$order) {
		$cartItems = array();
	} else {
		$cartItems = $order->cartItems;
	}
	return view('shopping-cart', [
        "checkoutStep" => 1,
        "cartItems" => $cartItems,
        "shippingInfo" => null
    ]);
});

Route::get('/checkout/shipping', function () {
	// $user = Auth::user();
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order_id = Session::get("order_id");
	$order = Order::find($order_id);
    if(!$order) {
		return redirect('/');
	}
    $cartItems = $order->cartItems;
	return view('checkout-shipping-info', [
        "checkoutStep" => 2,
        "order" => $order,
        "cartItems" => $cartItems,
        "shippingInfo" => null
    ]);
});

Route::get('/checkout/payment', function (Request $request) {
	$user = Auth::user();
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order_id = Session::get("order_id");
	$order = Order::find($order_id);
	$order->user_id = $user->id;
	$order->save();
	$cartItems = $order->cartItems;
    $shippingInfo = ShippingInfo::find($order->shipping_info_id);
	if(count($cartItems) == 0) {
		$request->session()->flash('status', 'No items in cart!');
		return redirect('/');
	}
	return view('checkout-payment', [
        "checkoutStep" => 3,
		"order" => $order,
		"cartItems" => $cartItems,
        "shippingInfo" => $shippingInfo
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
	// $user = Auth::user();
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order_id = Session::get("order_id");
	$order = Order::find($order_id);
	$cartItems = $order->cartItems;
	foreach($cartItems as $cartItem) {
		if($cartItem->id == $request->id) {
			$cartItem->delete();
		}
	}
	return array("done" => 1);
})->middleware('auth');

Route::post('/api/v1/addToCart', function (Request $request) {
	// first, check if the item is sold out. if it is, return an error.
	$design = Design::find($request->designId);
	$cartItems = CartItem::orderBy('created_at', 'asc')->where("design_id", '=', $request->designId)->get();
	if($request->type == "canvas") {
	    $canvasTotalSold = 0;
	    foreach($cartItems as $cartItem) {
	        if($cartItem->productSpec && $cartItem->productSpec->type == "canvas") {
	        	if($cartItem->order) {
		        	$payment = Payment::find($cartItem->order->payment_id);
		        	if($payment) {
		                $canvasTotalSold += $cartItem->quantity;
			        }
			    }
	        }
	    }
	    if($canvasTotalSold >= $design->canvas_limit) {
	    	$returnData = array("error" => "Item is sold out :(");
	    	return response()->json($returnData, 400);
	    }
	}
	if($request->type == "tshirt") {
	    $tshirtTotalSold = 0;
	    foreach($cartItems as $cartItem) {
	        if($cartItem->productSpec && $cartItem->productSpec->type == "tshirt") {
	        	if($cartItem->order) {
		        	$payment = Payment::find($cartItem->order->payment_id);
		        	if($payment) {
		                $tshirtTotalSold += $cartItem->quantity;
			        }
			    }
	        }
	    }
	    if($tshirtTotalSold >= $design->tshirt_limit) {
	    	$returnData = array("error" => "Item is sold out :(");
	    	return response()->json($returnData, 400);
	    }
	}

	$order_id = Session::get("order_id");
	// $user = Auth::user();
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order = Order::find($order_id);
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
		// $order->user_id = $user->id;
		$order->save();
		Session::set("order_id", $order->id);
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
});

Route::get('/api/v1/cartInfo', function () {
	// $user = Auth::user();
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order_id = Session::get("order_id");
	$order = Order::find($order_id);
	if(!$order) {
		return array("cartItems" => array());
	}
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
});

Route::get('/api/v1/orderSummary', function () {
	// $user = Auth::user();
	// $order = Order::orderBy('created_at', 'asc')->where("payment_id", '=', null)->where("user_id", "=", $user->id)->first();
	$order_id = Session::get("order_id");
	$order = Order::find($order_id);
	$result = get_order_summary($order);

	return $result;
});

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
});

// });