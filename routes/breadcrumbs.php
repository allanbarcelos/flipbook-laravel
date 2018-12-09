<?php

// Home

Breadcrumbs::for('homeIndex', function ($trail) {
    $trail->push('Home', route('homeIndex'));
});

// Home > Admin > Clients
Breadcrumbs::for('clientsList', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Clients', route('clientsList'));
});

// Home > Admin > Clients > Create
Breadcrumbs::for('clientsCreate', function ($trail) {
    $trail->parent('clientsList');
    $trail->push('Create', route('clientsCreate'));
});

Breadcrumbs::for('adminIndex', function ($trail) {
    $trail->parent('homeIndex');
    $trail->push('Admin', route('adminIndex'));
});

/*
// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});
*/
