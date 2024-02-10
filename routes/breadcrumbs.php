<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Beer
Breadcrumbs::for('beer', function (BreadcrumbTrail $trail) {
    $trail->push('Beer', route('beer'));
});

// Home > Blog > [Category]
Breadcrumbs::for('product_name', function (BreadcrumbTrail $trail, $product) {
    $trail->push($product, route('product_name', $product));
});
