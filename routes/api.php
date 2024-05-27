<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Load all routes in the 'api' folder dynamically
$routeFiles = glob(__DIR__ . '/api/*.php');

foreach ($routeFiles as $routeFile) {
    require $routeFile;
}