<?php
require_once 'vendor/autoload.php';
require_once 'guzzleclient.php';
require_once 'common.php';
require_once 'settings.php';

$building_id = htmlentities($_POST['building_id'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
$settings = Settings::getInstance();

if(empty($building_id)) {
  respondWithMessage('Nothing to do, no building id passed in');
}

try {
  $response = $guzzleclient->request('GET', 'preview_buildings/' . $building_id . '/validate?token=' . $settings->getSetting('authentication_token'));
} catch (\GuzzleHttp\Exception\ClientException $e) {
  exceptionHasBeenCaught($e);
}

respondWithData($response);
