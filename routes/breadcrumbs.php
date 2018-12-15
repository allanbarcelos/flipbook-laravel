<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('admin', function ($trail) {
    $trail->parent('home');
    $trail->push('Admin');
});

// Home > Admin > Clients
Breadcrumbs::for('clients', function ($trail) {
    $trail->parent('admin');
    $trail->push('Clients', route('clients'));
});

// Home > Admin > Clients > list
Breadcrumbs::for('clients_list', function ($trail) {
    $trail->parent('clients');
    $trail->push('List', route('clients_list'));
});

// Home > Admin > Clients > Create
Breadcrumbs::for('client_create', function ($trail) {
    $trail->parent('clients');
    $trail->push('Create', route('client_create'));
});

// Home > Admin > Clients > Edit
Breadcrumbs::for('client_edit', function ($trail) {
    $trail->parent('clients');
    $trail->push('Edit', route('client_edit'));
});


// Home > User > USER_NAME
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push(Auth::user()->name);
});

// Home > Admin > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Users',route('users'));
});

// Home > Admin > Users > Create
Breadcrumbs::for('user_create', function ($trail) {
    $trail->parent('users');
    $trail->push('Create', route('user_create'));
});

// Home > Admin > Users > Edit
Breadcrumbs::for('user_edit', function ($trail) {
    $trail->parent('users');
    $trail->push('Edit', route('user_edit'));
});

// Home > Admin > Content
Breadcrumbs::for('content', function ($trail) {
    $trail->parent('admin');
    $trail->push('Content', route('content'));
});

// Home > Admin > Content > create
Breadcrumbs::for('content_create', function ($trail) {
    $trail->parent('content');
    $trail->push('Create');
});


// Home > Admin > Content > Edit
Breadcrumbs::for('content_edit', function ($trail) {
    $trail->parent('content');
    $trail->push('Edit', route('content_edit'));
});
