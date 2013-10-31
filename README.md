server-sent-event
=================
# HTML5
```javascript
var source=new EventSource("demo_sse.php");
source.onmessage=function(event)
{
	document.getElementById("result").innerHTML+=event.data + "<br>";
};
```

# PHP
### In demo_sse.php
```php
<?php
header("Content-Type: text/event-stream");
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

include 'class/ServerSentEvent.php';

$event = ServerSentEvent::getInstance();
$event->process(function($manager){
	$manager->send(array(
		'event' => 'ping',
		'data' => time(),
		));
},20);
```
