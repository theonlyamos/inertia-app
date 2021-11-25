<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Inertia\Inertia;

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
    return Inertia::render('Home');
});

Route::get('/users', function () {
    return Inertia::render('Users/Index',[
        "users" => User::query()
            ->when(Request::input('search'), function($query, $search){
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user)=> [
                "id" => $user->id,
                "name" => $user->name
            ]),
        "filters" => Request::only(['search'])
    ]);
});

Route::post('/users', function () {
    $data = Request::validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ]);
    $data['password'] = Hash::make($data['password']);

    User::create($data);
    return redirect('/users');
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
});

Route::get('/settings', function () {
    return Inertia::render('Settings');
});

Route::post('/logout', function () {
    dd('Logging user out');
});
