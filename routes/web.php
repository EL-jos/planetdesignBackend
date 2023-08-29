<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['as' => 'home.page', 'uses' => 'App\\Http\\Controllers\\PageController@home']);
Route::get('/category', ['as' => 'category.page', 'uses' => 'App\\Http\\Controllers\\PageController@category']);
Route::get('/arrival', ['as' => 'arrival.page', 'uses' => 'App\\Http\\Controllers\\PageController@arrival']);
Route::get('/category/article', ['as' => 'article.page', 'uses' => 'App\\Http\\Controllers\\PageController@article']);
Route::get('/catalog/{user?}', ['as' => 'catalog.page', 'uses' => 'App\\Http\\Controllers\\PageController@catalog']);
Route::get('/favorites/{user?}', ['as' => 'favorites.page', 'uses' => 'App\\Http\\Controllers\\PageController@favorites']);
Route::get('/quote/{user?}', ['as' => 'quote.page', 'uses' => 'App\\Http\\Controllers\\PageController@quote']);
Route::get('/destocking', ['as' => 'destocking.page', 'uses' => 'App\\Http\\Controllers\\PageController@destocking']);
Route::get('/business', ['as' => 'business.page', 'uses' => 'App\\Http\\Controllers\\PageController@business']);
Route::get('/catalogs', ['as' => 'catalogs.page', 'uses' => 'App\\Http\\Controllers\\PageController@catalogs']);
Route::get('/identification', ['as' => 'identification.page', 'uses' => 'App\\Http\\Controllers\\PageController@identification']);
Route::post('/login', ['as' => 'login.user', 'uses' => 'App\\Http\\Controllers\\AuthController@login']);
Route::post('/logout', ['as' => 'logout.user', 'uses' => 'App\\Http\\Controllers\\AuthController@logout']);
Route::post('/register', ['as' => 'register.user', 'uses' => 'App\\Http\\Controllers\\AuthController@register']);
Route::get('/active/{user}', ['as' => 'activeAccount.auth', 'uses' => 'App\\Http\\Controllers\\AuthController@activeAccount']);
Route::get('/page/{article}/addQuote', ['as' => 'addQuote.page', 'uses' => 'App\\Http\\Controllers\\PageController@addQuote'])->middleware("htmlx");
Route::get('/page/{article}/addCatalog', ['as' => 'addCatalog.page', 'uses' => 'App\\Http\\Controllers\\PageController@addCatalog'])->middleware("htmlx");
Route::post('/article/{article}/addQuote', ['as' => 'addQuote.article', 'uses' => 'App\\Http\\Controllers\\ArticleController@addQuote'])->middleware("htmlx");
Route::post('/article/{article}/addCatalog', ['as' => 'addCatalog.article', 'uses' => 'App\\Http\\Controllers\\ArticleController@addCatalog'])->middleware("htmlx");
Route::delete('/quote/destroy/{user}', ['as' => 'destroyAllQuoteOfThisUser.quote', 'uses' => 'App\\Http\\Controllers\\QuoteController@destroyAllQuoteOfThisUser']);
Route::get('/modify-quantity-of-quote/{quote}', ['as' => 'modifyQuantityOfQuote.quote', 'uses' => 'App\\Http\\Controllers\\QuoteController@modifyQuantityOfQuote'])->middleware("htmlx");
Route::post('/send-devis/{user}', ['as' => 'sendDevis.quote', 'uses' => 'App\\Http\\Controllers\\QuoteController@sendDevis']);
Route::get('/favorite/{user?}/{article?}', ['as' => 'favorite', 'uses' => 'App\\Http\\Controllers\\FavoriteController@toggle'])->middleware("htmlx");
Route::get('/favorite/quote/{user}/{article}', ['as' => 'favorite.quote', 'uses' => 'App\\Http\\Controllers\\FavoriteController@addToQuote']);
//Route::get('/catalog/{user}/{article}', ['as' => 'catalog', 'uses' => 'App\\Http\\Controllers\\CatalogController@toggle'])->middleware("htmlx");
Route::get('/catalog/generate-pdf/{user}', ['as' => 'generate.catalog', 'uses' => 'App\\Http\\Controllers\\CatalogController@generateCatalogPdf']);
Route::get('/images/article/{path}', ['as' => 'show.image', 'uses' => 'App\\Http\\Controllers\\ImageController@show'])->where('path', '.*');
Route::post('/ajax/filter-articles', ['as' => 'filter.articles', 'uses' => 'App\\Http\\Controllers\\ArticleController@filterArticles']);
Route::get('/generate-pdf/{article}', ['as' => 'generate.pdf', 'uses' => 'App\\Http\\Controllers\\ArticleController@generateCatalogPdf']);
Route::post('/page/search', ['as' => 'search.page', 'uses' => 'App\\Http\\Controllers\\PageController@search']);

Route::group(['prefix' => 'deleted'], function (){
    Route::get('/category', ['as' => 'category.deleted', 'uses' => 'App\\Http\\Controllers\\CategoryController@deleted']);
    Route::get('/subcategory', ['as' => 'subcategory.deleted', 'uses' => 'App\\Http\\Controllers\\SubcategoryController@deleted']);
    Route::get('/color', ['as' => 'color.deleted', 'uses' => 'App\\Http\\Controllers\\ColorController@deleted']);
    Route::get('/material', ['as' => 'material.deleted', 'uses' => 'App\\Http\\Controllers\\MaterialController@deleted']);
});

Route::group(['prefix' => 'restore'], function (){
    Route::get('/category/{category}', ['as' => 'category.restore', 'uses' => 'App\\Http\\Controllers\\CategoryController@restore']);
    Route::get('/subcategory/{subcategory}', ['as' => 'subcategory.restore', 'uses' => 'App\\Http\\Controllers\\SubcategoryController@restore']);
    Route::get('/color/{color}', ['as' => 'color.restore', 'uses' => 'App\\Http\\Controllers\\ColorController@restore']);
    Route::get('/material/{material}', ['as' => 'material.restore', 'uses' => 'App\\Http\\Controllers\\MaterialController@restore']);
});

Route::group(['prefix' => 'remove'], function (){
    Route::get('/category/{category}', ['as' => 'category.remove', 'uses' => 'App\\Http\\Controllers\\CategoryController@remove']);
    Route::get('/subcategory/{subcategory}', ['as' => 'subcategory.remove', 'uses' => 'App\\Http\\Controllers\\SubcategoryController@remove']);
    Route::get('/color/{color}', ['as' => 'color.remove', 'uses' => 'App\\Http\\Controllers\\ColorController@remove']);
    Route::get('/material/{material}', ['as' => 'material.remove', 'uses' => 'App\\Http\\Controllers\\MaterialController@remove']);
});

Route::group(['prefix' => 'admin'], function (){
    Route::resource('category', 'App\\Http\\Controllers\\CategoryController');
    Route::resource('subcategory', 'App\\Http\\Controllers\\SubcategoryController');
    Route::resource('image', 'App\\Http\\Controllers\\ImageController');
    Route::resource('color', 'App\\Http\\Controllers\\ColorController');
    Route::resource('material', 'App\\Http\\Controllers\\MaterialController');
    Route::resource('availability', 'App\\Http\\Controllers\\AvailabilityController');
    Route::resource('article', 'App\\Http\\Controllers\\ArticleController');
    Route::resource('quote', 'App\\Http\\Controllers\\QuoteController');
    //Route::resource('order', 'App\\Http\\Controllers\\OrderController');
    Route::resource('favorite', 'App\\Http\\Controllers\\FavoriteController');
    Route::resource('catalog', 'App\\Http\\Controllers\\CatalogController');
    Route::resource('banner', 'App\\Http\\Controllers\\BannerController');
    Route::resource('deal', 'App\\Http\\Controllers\\DealController');

    Route::post('/category/{category}/uploadPhoto', ['as' => 'uploadPhoto.category', 'uses' => 'App\\Http\\Controllers\\CategoryController@uploadPhoto']);
    Route::post('/subcategory/{subcategory}/uploadPhoto', ['as' => 'uploadPhoto.subcategory', 'uses' => 'App\\Http\\Controllers\\SubcategoryController@uploadPhoto']);
    Route::post('/image/updateImageOrder', ['as' => 'updateImageOrder.image', 'uses' => 'App\\Http\\Controllers\\ImageController@updateImageOrder']);
    Route::post('/article/{article}/uploadPhoto', ['as' => 'uploadPhoto.article', 'uses' => 'App\\Http\\Controllers\\ArticleController@uploadPhoto']);
    Route::post('/banner/{banner}/uploadPhoto', ['as' => 'uploadPhoto.banner', 'uses' => 'App\\Http\\Controllers\\BannerController@uploadPhoto']);
    Route::post('/deal/{deal}/uploadPhoto', ['as' => 'uploadPhoto.deal', 'uses' => 'App\\Http\\Controllers\\DealController@uploadPhoto']);
});
