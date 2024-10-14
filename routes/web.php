<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PublishersController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


Route::get('/lang-ar' ,function () {
      session()->put('lang','ar');
    return back();
})->name("ar");
Route::get('/lang-en' ,function () {
    session()->put('lang','en');
    return back();
})->name("en");




Route::middleware('ChangeLanguage')->group(function () {
    Route::get('users/searchUsers',[UsersController::class ,'searchUsers'])->name('users.searchUsers');
    Route::get('/', [GalleryController::class , 'index'])->name('home')->middleware('ChangeLanguage');
    Route::get('/search', [GalleryController::class , 'search'])->name('search');

    Route::get('book/{book}', [BooksController::class , 'details'])->name('book.details');
    Route::get('book/{book}/rate', [BooksController::class , 'rate'])->name('book.rate');

    Route::get('categories',[CategoriesController::class ,'list'])->name('gallery.categories.index');
    Route::get('categories/search',[CategoriesController::class ,'search'])->name('gallery.categories.search');
    Route::get('categories/searchCategories',[CategoriesController::class ,'searchCategories'])->name('categories.searchCategories');
    Route::get('categories/{category}',[CategoriesController::class ,'result'])->name('gallery.categories.show');

    Route::get('publishers',[PublishersController::class ,'list'])->name('gallery.publishers.index');
    Route::get('publishers/search',[PublishersController::class ,'search'])->name('gallery.publishers.search');
    Route::get('publishers/searchPublishers',[CategoriesController::class ,'searchPublishers'])->name('gallery.publishers.searchPublishers');
    Route::get('publishers/{publisher}',[PublishersController::class ,'result'])->name('gallery.publishers.show');

    Route::get('authors',[AuthorsController::class ,'list'])->name('gallery.authors.index');
    Route::get('authors/search',[AuthorsController::class ,'search'])->name('gallery.authors.search');
    Route::get('authors/searchAuthors',[AuthorsController::class ,'searchAuthors'])->name('gallery.authors.searchAuthors');
    Route::get('authors/{authors}',[AuthorsController::class ,'result'])->name('gallery.authors.show');


    Route::post('cart', [CartController::class,'addToCart'])->name('addToCart')->middleware('auth');
    Route::get('cart', [CartController::class,'viewCart'])->name('view.cart');
    Route::post('removeOne/{book}', [CartController::class,'removeOne'])->name('cart.removeOne');
    Route::post('removeOne/{book}', [CartController::class,'removeOne'])->name('cart.removeOne');
    Route::post('removeAll/{book}', [CartController::class,'removeAll'])->name('cart.removeAll');

    Route::get('paypal', [PurchaseController::class,'crateOrder'])->name('paypal.crateOrder');
    Route::get('paypal/successOrder', [PurchaseController::class,'successOrder'])->name('paypal.successOrder');
    Route::get('paypal/cancelOrder', [PurchaseController::class,'cancelOrder'])->name('paypal.cancelOrder');

    Route::get('checkout',[PurchaseController::class,'creditCheckout'])->name('credit.checkout');
    Route::Post('checkout',[PurchaseController::class,'purchase'])->name('products.purchase');

    Route::get('myProduct',[PurchaseController::class , "myProduct"])->name('my.product');
});






Route::prefix('/admin')->middleware(['can:update-books','ChangeLanguage'])->group(function () {
    Route::get('/', [AdminController::class,'index'])->name('admin');
    Route::get('/books', [BooksController::class,'index'])->name('books.index');
    Route::get('/books/search', [BooksController::class,'search'])->name('books.search');
    Route::resource('/books', BooksController::class)->middleware('can:update-books');
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/publishers', PublishersController::class);
    Route::resource('/authors', AuthorsController::class);
    Route::get('/authors/searchAuthors', [AuthorsController::class, 'searchAuthors'])->name('authors.searchAuthors');
    Route::get('/publishers/searchPublishers', [PublishersController::class, 'searchPublishers'])->name('publishers.searchPublishers');
    Route::resource('/users', UsersController::class)->middleware('can:update-users');
    Route::get('/allProduct',[PurchaseController::class , "allProduct"])->name('all.product');
    Route::get('/allProduct/searchDate',[PurchaseController::class , "searchDate"])->name('searchDate');
});


