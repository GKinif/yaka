<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// INDEX
Route::get('/', ['uses' => 'IndexController@index', 'as' => 'home']);

// CATEGORIE
Route::get('categorie', ['uses' => 'CategorieController@index', 'as' => 'Categorie']);
Route::get('categorie/{slugCategorie}', ['uses' => 'SousCategorieController@index', 'as' => 'showCategorie']);

// SOUSCATEGORIE
Route::get('categorie/{slugCategorie}/souscategorie', ['uses' => 'SousCategorieController@index', 'as' => 'sousCategorie']);
Route::get('categorie/{slugCategorie}/souscategorie/{slugSousCategorie}', ['uses' => 'ProduitController@index', 'as' => 'showSousCategorie']);

// PRODUIT
Route::get('categorie/{slugCategorie}/souscategorie/{slugSousCategorie}/produit', ['uses' => 'ProduitController@index', 'as' => 'produitIndex']);
Route::get('categorie/{slugCategorie}/souscategorie/{slugSousCategorie}/produit/{slugProduit}', ['uses' => 'ProduitController@show', 'as' => 'produitShow']);

// PRODUIT CRUD
Route::group([ 'prefix' => 'produit', 'middleware' => ['auth', 'admin'] ], function () {
    Route::get('create', ['uses' => 'ProduitController@create', 'as' => 'produitCreate']);
    Route::post('/', ['uses' => 'ProduitController@store', 'as' => 'produitStore']);

});

// PRODUIT AJAX PRIX
Route::get('produit/prix', ['uses' => 'ProduitController@prix', 'as' => 'showPrixProduit']);

// SEARCH
Route::get('search', ['uses' => 'SearchController@index', 'as' => 'searchProduit']);

// PANIER
Route::get('panier', ['uses' => 'PanierController@index', 'as' => 'panierIndex']);
Route::post('panier', ['uses' => 'PanierController@store', 'as' => 'panierStore']);
Route::get('panier/clear', ['uses' => 'PanierController@clear', 'as' => 'panierClear']);
Route::get('panier/destroy/{id}', ['uses' => 'PanierController@destroy', 'as' => 'panierDestroy']);

// COMMANDE
Route::get('commande', ['middleware' => 'auth', 'uses' => 'CommandeController@index', 'as' => 'commandeIndex']);
Route::get('commande/create', ['middleware' => 'auth', 'uses' => 'CommandeController@create', 'as' => 'commandeCreate']);
Route::post('commande', ['middleware' => 'auth', 'uses' => 'CommandeController@store', 'as' => 'commandeStore']);

// LOGIN
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// HOME
Route::group([ 'prefix' => 'home', 'middleware' => ['auth', 'user'] ], function () {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'homeIndex']);
    Route::get('edit', ['uses' => 'HomeController@edit', 'as' => 'homeEdit']);
    Route::post('update', ['uses' => 'HomeController@update', 'as' => 'homeUpdate']);
});

// ADMIN
Route::group([ 'prefix' => 'admin', 'middleware' => ['auth', 'admin'] ], function () {
    Route::get('/', ['uses' => 'AdminController@index', 'as' => 'adminIndex']);

});

// STATS
Route::group([ 'prefix' => 'stats', 'middleware' => ['auth', 'admin'] ], function () {
    Route::get('/', ['uses' => 'StatsController@index', 'as' => 'statsIndex']);

});

Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);