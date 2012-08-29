<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "rabbit.php";
Rabbit\config("rabbit1", null, "guest", "guest");

Rabbit\publish("news.test", "uudiseid pole :S", null, "amq.topic");

echo "okidoki";