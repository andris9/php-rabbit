<?php

require_once "ampq.php";

Rabbit\publish("news.test", "uudiseid pole :S", null, "amq.topic");
