<?php

// Home

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('admin', function ($trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin'));
});

// Home > Admin > Clients
Breadcrumbs::for('clients', function ($trail) {
    $trail->parent('admin');
    $trail->push('Clients');
});

// Home > Admin > Clients > list
Breadcrumbs::for('clients_list', function ($trail) {
    $trail->parent('clients');
    $trail->push('List', route('clients_list'));
});


// Home > Admin > Clients > Create
Breadcrumbs::for('clients_create', function ($trail) {
    $trail->parent('clients');
    $trail->push('Create', route('clients_create'));
});


// Home > User
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push(Auth::user()->name);
});



// Home > Admin > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Users');
});

// Home > Admin > Users > List
Breadcrumbs::for('users_list', function ($trail) {
    $trail->parent('users');
    $trail->push('List', route('users_list'));
});





// Home > Admin > Content
Breadcrumbs::for('content', function ($trail) {
    $trail->parent('admin');
    $trail->push('Content');
});

// Home > Admin > Content > List
Breadcrumbs::for('content_list', function ($trail) {
    $trail->parent('content');
    $trail->push('List', route('content_list'));
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
