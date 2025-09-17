<?php



namespace BananaFramework\Tests;

use BananaFramework\Application;
use BananaFramework\Config\Repository;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;



beforeEach(function () {
    $this->app = Application::boot(basePath: __DIR__ . "/../");
});

it("check instance of class", function () {
    assertInstanceOf(
       expected: Application::class,
       actual: $this->app 
    );
});


it("check singleton", function() {

    assertEquals(
        expected: $this->app,
        actual: Application::boot(__DIR__. "/../../")
    );
});


it("check if it's allways booted ", function () {
    assertTrue(condition: $this->app->isBooted() );

});


it("check if it load init config", function() {
    assertInstanceOf(
        expected: Repository::class,
        actual: $this->app->config()
    );
});