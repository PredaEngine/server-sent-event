server-sent-event
=================
# JavaScript
```javascript
var evtSource = new EventSource("ssedemo.php");
evtSource.onmessage = function(e) {
  var newElement = document.createElement("li");
  
  newElement.innerHTML = "message: " + e.data;
  eventList.appendChild(newElement);
}
```
Source : https://developer.mozilla.org/en-US/docs/Server-sent_events/Using_server-sent_events
More : http://dev.w3.org/html5/eventsource/
# PHP
### In demo_sse.php
```php
<?php
header("Content-Type: text/event-stream");
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

include 'ServerSentEvent.php';

$event = ServerSentEvent::getInstance();
$event->process(function($manager){
	$manager->send(array(
		'event' => 'ping',
		'data' => json_encode(array('time' =>time())),
		));
},20);
```
This code will send an event 'ping' to the client with data the current time (time()) every 20 seconds.
The array passed to the send function can contain three indexes:
- id (optional) : the name of the event
- event : The name of the event
- data (array or string) : The data which will be send to the client
