<?php

require 'vendor/autoload.php';

if (PHP_SAPI != 'cli') {
    header('content-type: text/plain');
}

// ----------------------------------------------------------------------------
// open the event store

$store = new Demo\EventStore();

// ----------------------------------------------------------------------------
// find event

if (isset($argv[1])) {
    print_r($store->findById($argv[1]));
    die();
}

if (isset($_GET['eid'])) {
    print_r($store->findById($_GET['eid']));
    die();
}

// ----------------------------------------------------------------------------
// list events

/** @var ProcessStreet\Models\Payload $event */
foreach ($store->findAll() as $event => $time) {
    $time = DateTime::createFromFormat('U.u', (string) $time);
    assert($time instanceof DateTime);

    printf(
        "%.30s - %s (%s) - %s\n",
        $time->format(DateTimeInterface::ATOM),
        $event->type->value,
        $event->id,
        $event->checklist->name,
    );
}
