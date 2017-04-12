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