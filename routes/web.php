<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return inertia('Welcome');
    return Inertia::render('Home');
});

Route::get('/users', function () {
    return Inertia::render('Users/Index', [
        'users' => User::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($users) => [
                'id'        =>  $users->id,
                'name'      =>  $users->name
            ]),

        'filters' => Request::only(['search'])
    ]);
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
});

Route::post('/users', function () {
    //---Request the Validate
    $attributes = Request::validate([
        'name'      =>      'required',
        'email'     =>      ['required', 'email'],
        'password'  =>      'required'
    ]);

    //---Add Timestamp
    $attributes['created_at'] = date('Y-m-d H:i:s');
    $attributes['updated_at'] = date('Y-m-d H:i:s');
    
    //---Create User
    // User::create([
    //     'name' => Request::input('name')
    // ]);
    User::create($attributes);

    //---Redirect
    return redirect('/users');
});

Route::get('/settings', function () {
    return Inertia::render('Settings');
});

Route::post('/logout', function () {
    dd(request('foo'));
});