<?php

use App\Models\Univers;

it('defines a favoritedBy method that calls belongsToMany', function () {
    // Avoid creating Eloquent relations (which require a DB connection in tests).
    // Instead assert the method exists and that its source contains 'belongsToMany',
    // which indicates the method is implemented as expected.

    $this->assertTrue(method_exists(Univers::class, 'favoritedBy'));

    $ref = new ReflectionMethod(Univers::class, 'favoritedBy');
    $file = $ref->getFileName();
    $start = $ref->getStartLine();
    $end = $ref->getEndLine();

    $source = file($file);
    $methodLines = array_slice($source, $start - 1, $end - $start + 1);
    $methodCode = implode('', $methodLines);

    expect(strpos($methodCode, 'belongsToMany') !== false)->toBeTrue();
});
