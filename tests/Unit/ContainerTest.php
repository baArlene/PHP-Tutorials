<?php

use core\Container;

test('it can resolve something out of the container', function () {
    // Arrange
    $container = new Container();

$container->bind('foo', function() {
    return 'bar';
});

//$container->bind('foo', fn() => 'bar');

    //Act
    $result = $container->resolve('foo');


    //Assert/Expect
    expect($result)->toEqual('bar');
});
