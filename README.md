server-sent-event
=================
# JavaScript
```javascript
var source=new EventSource("demo_sse.php");
source.onmessage=function(event)
{
	document.getElementById("result").innerHTML+=event.data + "<br>";
};
```
Source : http://www.w3schools.com/html/html5_serversentevents.asp
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
		'data' => time(),
		));
},20);
```
This code will send an event 'ping' to the client with data the current time (time()) every 20 seconds.
The array passed to the send function can contain three indexes:
- id (optional) : the name of the event
- event : The name of the event
- data (array or string) : The data which will be send to the client
