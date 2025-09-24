# BananaFramework 🍌

1. Introduction

What is BananaFramework?
BananaFramework is a lightweight PHP micro-framework for building web applications quickly and efficiently. 
GitHub

Why use it?

Minimal overhead, easy to understand

Modular and extendable

Built-in testing support

Simple configuration and dependency injection container

Who’s it for?
Developers who want a lean framework (not full stack) or who prefer to build their own “stack” with flexibility.

2. Features

Simple configuration

Application container / dependency injection

Modular & extendable architecture

Built-in testing support

Routing, controllers, middleware (if exists)

(Other features you implement: view rendering, error handling, etc.)

3. Requirements & Installation
Requirements

PHP version (e.g. PHP 8.0+)

Composer

Web server (Apache, Nginx, built-in server)

(You should list exact minimums here based on your code.)

Installation via Composer
```bash
composer require emranpy/banana-framework
```

4. Getting Started / Hello World Example

Show how someone spins up a new app:

```
<?php

require __DIR__ . '/vendor/autoload.php';

use Banana\Framework\Application;

$app = new Application();

// define a route
$app->get('/hello', function () {
    return 'Hello from Banana!';
});

$app->run();

```
Explain line-by-line:

require autoload — loads all dependencies

Create new Application object — bootstraps framework

$app->get('/hello', …) — define an HTTP GET route

$app->run() — handles the incoming request, dispatches route, sends response

5. Core Concepts & Structure

Breakdown of directories & major classes:

src/ — core framework classes (Application, Router, Request, Response, Container)

bootstrap/ — bootstrap logic (loading config, service providers)

routes/ — define your routes

tests/ — unit / integration tests

Example.php — example usage

Configuration — where config files go

Explain each component:

Application: main class, entry point

Router: maps HTTP methods & paths to handlers

Request / Response: abstraction for HTTP

Container: dependency injection

Middleware (if present)

Service Providers (if present)
