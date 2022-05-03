# How to run the demo on your local environment

## Prerequisites

1. PHP>=8.0
2. Your terminal of choice
3. [Ngrok][link-ngrok]

## Start a local webserver

``` bash
$ php -S localhost:8000 demo/webhook.php
```

## Start a Ngrok tunnel

``` bash
$ ngrok http 8000
```

## Register the webhook

1. Go to [Process Street > Settings > Integrations][link-integrations].
2. Click "New Webhook"
3. Choose a workflow (or all workflows)
4. Paste any "Forwarding" URL Ngrok is giving you (like https://4dee-176-186-84-104.ngrok.io)
5. Check all event types

## Run a checklist

Run a checklist of the workflow you choose previously and do some stuff.

## Inspect the events

The webhook should have captured some events. To inspect them, run:

``` bash
$ php demo/events.php
```

Then to inspect a given event:

``` bash
$ php demo/events.php {id} # replace {id} by an event from the list above
```

Have fun!

[link-ngrok]: https://ngrok.com/
[link-integrations]: https://app.process.st/organizations/manage/integrations
