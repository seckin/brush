<?php

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
    $shipping_cost = 800;
    foreach($cartItems as $cartItem) {
        $total_price += $cartItem->quantity * $cartItem->price_per_item;
        // $shipping_cost += $cartItem->shipping_cost;
    }
    $total_amount = $total_price + $shipping_cost;
    return array("items_price" => $total_price, "shipping_cost" => $shipping_cost, "total_amount" => $total_amount);
}