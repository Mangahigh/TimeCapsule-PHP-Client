TimeCapsule PHP  Client
======================

A php client for TimeCapsule.

Example:
--------

See the publish.php and subscribe.php files in the example folder.

Publishing a message:
---------------------

```
$publisher = new \TimeCapsule\Publisher();
$publisher->publishMessage($message, $embargoDate);
```

Message must be an implement ```TimeCapsule\Storable```

Fetching the next message:
--------------------------

```
$subscriber = new \TimeCapsule\Subscriber();
$message = $subscriber->fetchMessage();

// process $message

$subscriber->ackMessage($message);
```

Contributing:
-------------

Please get involved in making this project better! Please submit a pull request with your changes. 

Licenses:
---------

Released under the MIT license. See [LICENSE]() for more details.

Acknowledgments:
----------------

Mangahigh - https://www.mangahigh.com
