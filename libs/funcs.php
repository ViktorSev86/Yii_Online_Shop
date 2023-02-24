<?php

function debug($data, $die = false) { // Функция для дебага
    echo "<pre>" . print_r($data, 1) . "</pre>";
    if ($die) {
        die;
    }
}