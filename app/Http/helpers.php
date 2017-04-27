<?php
use App\DiscountCode;

function upload_to_s3($image){
	$s3Prefix = 'https://s3-eu-west-1.amazonaws.com/trybrush';
	$imageFileName = time() . "-" . $image->getClientOriginalName();
	$s3 = \Storage::disk('s3');
	$imageFilePath = '/images/' . $imageFileName;
	$result = $s3->put($imageFilePath, file_get_contents($image), 'public');
	$imageUrl = $s3Prefix . $imageFilePath;
	return $imageUrl;
}

function get_order_summary($order) {
	$cartItems = $order->cartItems;
	$total_price = 0;
	if(count($cartItems) == 0) {
		$shipping_cost = 0;
	} else {
		$shipping_cost = 800;
	}

	$discount_code = DiscountCode::find($order->discount_code_id);
	if($discount_code) {
		$discount_percentage = $discount_code->percentage;
	} else {
		$discount_percentage = 0;
	}
    foreach($cartItems as $cartItem) {
        $total_price += $cartItem->quantity * $cartItem->price_per_item * (100.0 - $discount_percentage) / 100.0;
        // $shipping_cost += $cartItem->shipping_cost;
    }
    $total_amount = $total_price + $shipping_cost;

    return array("items_price" => $total_price, "shipping_cost" => $shipping_cost, "total_amount" => $total_amount, "discount" => $discount_code);
}