<?php

require 'vendor/autoload.php';

// ----------------------------------------------------------------------------
// open the event store

$store = new Demo\EventStore();

// ----------------------------------------------------------------------------
// handle payload

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' &&
    str_starts_with($_SERVER['CONTENT_TYPE'], 'application/json')
) {
    $input = file_get_contents('php://input');
    assert(is_string($input));

    $json = json_decode($input, true);
    assert(is_array($json));

    $payload = ProcessStreet\Models\Payload::from($json);

    // insert payload into the event store
    $store->insert($payload, $_SERVER['REQUEST_TIME_FLOAT']);
}

// ----------------------------------------------------------------------------
// response

header('content-type: text/plain');
echo "OK";
