<?php
include_once __DIR__ . '/../src/autoload.php';


$apiKey = 'given_key_of_the_user';
$apiSecret = 'given_secret_of_the_user';

HostHinh\HostHinhClient::init($apiKey, $apiSecret);

$filePath = '/Users/locdd/projects/turnco_document/image_test/locdd_edit_200_200.png';
$response = HostHinh\HostHinhClient::upload($filePath, 'Title of the image', true, 123456);
echo !empty($response)?"Uploaded photo with local path: {$response['data']['link']}":'Error';

echo "\n";

$url = 'http://www.tompetty.com/sites/g/files/g2000007521/f/Sample-image10-highres.jpg';
$response = HostHinh\HostHinhClient::upload($filePath, 'Title of the image', true, 123456);
echo !empty($response)?"Uploaded photo with url path: {$response['data']['link']}":'Error';