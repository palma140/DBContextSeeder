<?php
$directories = [__DIR__ . '/Company', __DIR__ . '/Financial', __DIR__ . '/Geography', __DIR__ . '/Personal', __DIR__ . '/Internet', __DIR__ . '/Miscellaneous', __DIR__ . '/Payment', __DIR__ . '/Temporal', __DIR__ . '/Text'];

foreach ($directories as $directory) {
    foreach (glob("$directory/*.php") as $filename) {
        require_once $filename;
    }
}
