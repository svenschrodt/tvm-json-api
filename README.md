# tvm-json-api
JSON API consuming TVMaze API  Lumen micro framework


## Short description of service

JSON-API consuming 3rd party service TVMaze
The application returns information on TV shows, if found by search criteria submitted to the service API TVMaze.

Only this route to JSON API is valid:
<code>/?q={SEARCH_VALUE}</code>

All other http request will be responded with an JSOn error message and corresponding HTTP status 404 (file not found)

### Cache
Each response will bes stored in a cache (TTL is configured as 3600 seconds by default  - see: config/main.php) to minimize external HTTP requests. If found in cache, the data for current search critierion out of the cache. Currently the cache is implemented as simple file system based key-value- store.  Serialized data is indexed by (lower cased) search criterion as key.


### Filtering
The search results are filtered follwing these criteria:
- non-typo-tolerant
- case-insensitive
There are two filter modes (to be set in  App\Models\Show):
- CONTAINS (default) - the original name must contain search criterion ()
- EQUALS - the original name must be equl to search criterion

## Current environment:
- PHP 7.4.8 (PHP <b>7.3+ required</b>)
- PHPUnit 8.5.8
- Lumen (7.2.1) (Laravel Components ^7.0)
- git version 2.27.0
- Composer version 1.10.9
- PhpStorm 2020.1 (IDE)

## Source 
The application source code, building information and unit test is availabe as GitHub repository:

- https://github.com/svenschrodt/tvm-json-api

CI environment for repository can be found at Travis CI:

- https://travis-ci.org/svenschrodt/tvm-json-api 

## Install instructions
<pre>
> git clone https://github.com/svenschrodt/tvm-json-api
> cd tvm-json-api
> composer install
> php artisan config:cache
</pre>

## Ideas on evolving API
- Implementing other cache mechanism, e.g: memcached for perfomance improvement
- Using translation services
- Mapping data structure for indiviual needs
- Using different Content-Types for service additional to JSON (SOAP, HTML, prop. XML, CSV etc.)
- Implementing automated frontend-testing (Selenium, Cypress ...)
- Extending CI Workflow (Code coverage testing, calcluating metrics etc. )

## Overview project files 

<pre>
├── app
│   ├── Console
│   │   ├── Commands
│   │   └── Kernel.php
│   ├── Events
│   │   ├── Event.php
│   │   └── ExampleEvent.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   └── IndexController.php
│   │   └── Middleware
│   │       └── RequestJson.php
│   ├── Listeners
│   │   └── ExampleListener.php
│   ├── Meta
│   │   └── Mapping.php
│   ├── Models
│   │   └── Show.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   └─  │   └── EventServiceProvider.php
│  
├── app.info
├── artisan
├── bootstrap
│   └── app.php
├── composer.json
├── composer.lock
├── config
│   ├── cache.php
│   └── main.php
├── database
│   ├── factories
│   │   └── ModelFactory.php
│   ├── migrations
│   └── seeds
│       └── DatabaseSeeder.php
├── files.txt
├── LICENSE
├── phpunit.xml
├── public
│   └── index.php
├── README.md
├── resources
│   └── views
├── routes
│   └── web.php
├── storage
│   ├── app
│   ├── framework
│   │   ├── cache
│   │   │   └── data
│   │   └── views
│   └── logs
├── tests
│   ├── App
│   │   ├── Http
│   │   │   └── Controllers
│   │   │       └── IndexControllerTest.php
│   │   └── Models
│   │       └── ShowTest.php
│   ├── ConfigurationTest.php
│   └── TestCase.php
├── TVMaze_JSON_API_Description.pdf
└── TVMaze_JSON_API_Description.rtf

</pre>
