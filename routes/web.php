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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
    Route::get('/', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin.index');
    Route::get('/contacts', [\App\Http\Controllers\Admin\MainController::class, 'contact'])->name('admin.contact');
    Route::put('/contacts', [\App\Http\Controllers\Admin\MainController::class, 'edit_contact'])->name('admin.econtact');
    Route::get('/countquestions', [\App\Http\Controllers\Admin\MainController::class, 'count_question'])->name('countquestions');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('/chat/send', [\App\Http\Controllers\Admin\ChatController::class, 'sendMessage'])->name('message.send');
    Route::get('/getproducts/{value?}', [\App\Http\Controllers\Admin\MainController::class, 'getProducts'])->name('getproducts');
    Route::get('/getproductinfo/{id?}', [\App\Http\Controllers\Admin\MainController::class, 'getProductInfo'])->name('getproductinfo');
    Route::get('/getusers', [\App\Http\Controllers\Admin\MainController::class, 'getUsers'])->name('getusers');
    Route::get('/task/check', [\App\Http\Controllers\Admin\MainController::class, 'TaskCheck'])->name('task.check');
    Route::get('/task/delete', [\App\Http\Controllers\Admin\MainController::class, 'TaskDelete'])->name('task.delete');

    Route::get('/faq', function () {return view('admin.add.faq');})->name('add.faq.edit');
    Route::get('/how_zdelat_zakaz', function () {return view('admin.add.how_zdelat_zakaz');})->name('add.how_zdelat_zakaz.edit');
    Route::get('/terms_of_use', function () {return view('admin.add.terms_of_use');})->name('add.terms_of_use.edit');
    Route::get('/code_of_ethics', function () {return view('admin.add.code_of_ethics');})->name('add.code_of_ethics.edit');
    Route::get('/privacy_policy', function () {return view('admin.add.privacy_policy');})->name('add.privacy_policy.edit');
    Route::get('/warranty', function () {return view('admin.add.warranty');})->name('add.warranty.edit');
    Route::get('/delivery_terms', function () {return view('admin.add.delivery_terms');})->name('add.delivery_terms.edit');
    Route::get('/return_conditions', function () {return view('admin.add.return_conditions');})->name('add.return_conditions.edit');
    Route::get('/vacancies', function () {return view('admin.add.vacancies');})->name('add.vacancies.edit');
    Route::put('/faq', [\App\Http\Controllers\Admin\AdditionalController::class, 'faqUpdate'])->name('add.faq.update');
    Route::put('/how_zdelat_zakaz', [\App\Http\Controllers\Admin\AdditionalController::class, 'how_zdelat_zakazUpdate'])->name('add.how_zdelat_zakaz.update');
    Route::put('/terms_of_use', [\App\Http\Controllers\Admin\AdditionalController::class, 'terms_of_useUpdate'])->name('add.terms_of_use.update');
    Route::put('/code_of_ethics', [\App\Http\Controllers\Admin\AdditionalController::class, 'code_of_ethicsUpdate'])->name('add.code_of_ethics.update');
    Route::put('/privacy_policy', [\App\Http\Controllers\Admin\AdditionalController::class, 'privacy_policyUpdate'])->name('add.privacy_policy.update');
    Route::put('/warranty', [\App\Http\Controllers\Admin\AdditionalController::class, 'warrantyUpdate'])->name('add.warranty.update');
    Route::put('/delivery_terms', [\App\Http\Controllers\Admin\AdditionalController::class, 'delivery_termsUpdate'])->name('add.delivery_terms.update');
    Route::put('/return_conditions', [\App\Http\Controllers\Admin\AdditionalController::class, 'return_conditionsUpdate'])->name('add.return_conditions.update');
    Route::put('/vacancies', [\App\Http\Controllers\Admin\AdditionalController::class, 'vacanciesUpdate'])->name('add.vacancies.update');
    Route::delete('/faq', [\App\Http\Controllers\Admin\AdditionalController::class, 'faqDelete'])->name('add.faq.delete');
    Route::delete('/how_zdelat_zakaz', [\App\Http\Controllers\Admin\AdditionalController::class, 'how_zdelat_zakazDelete'])->name('add.how_zdelat_zakaz.delete');
    Route::delete('/terms_of_use', [\App\Http\Controllers\Admin\AdditionalController::class, 'terms_of_useDelete'])->name('add.terms_of_use.delete');
    Route::delete('/code_of_ethics', [\App\Http\Controllers\Admin\AdditionalController::class, 'code_of_ethicsDelete'])->name('add.code_of_ethics.delete');
    Route::delete('/privacy_policy', [\App\Http\Controllers\Admin\AdditionalController::class, 'privacy_policyDelete'])->name('add.privacy_policy.delete');
    Route::delete('/warranty', [\App\Http\Controllers\Admin\AdditionalController::class, 'warrantyDelete'])->name('add.warranty.delete');
    Route::delete('/delivery_terms', [\App\Http\Controllers\Admin\AdditionalController::class, 'delivery_termsDelete'])->name('add.delivery_terms.delete');
    Route::delete('/return_conditions', [\App\Http\Controllers\Admin\AdditionalController::class, 'return_conditionsDelete'])->name('add.return_conditions.delete');
    Route::delete('/vacancies', [\App\Http\Controllers\Admin\AdditionalController::class, 'vacanciesDelete'])->name('add.vacancies.delete');



    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('allquestions', \App\Http\Controllers\Admin\AllQuestionsController::class);
    Route::resource('phonequestions', \App\Http\Controllers\Admin\PhoneQuestionsController::class);
    Route::resource('productquestions', \App\Http\Controllers\Admin\ProductQuestionsController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('tasks', \App\Http\Controllers\Admin\TasksController::class);

    Route::get('/diagnostics/add', [\App\Http\Controllers\Admin\DiagnosticController::class, 'create'])->name('diagnostics.create');
    Route::get('/diagnostics/index', [\App\Http\Controllers\Admin\DiagnosticController::class, 'index'])->name('diagnostics.index');
    Route::get('/diagnostics/settings', [\App\Http\Controllers\Admin\DiagnosticController::class, 'settings'])->name('diagnostics.settings');
    Route::get('/diagnostics/{id}/edit', [\App\Http\Controllers\Admin\DiagnosticController::class, 'edit'])->name('diagnostics.edit');
    Route::delete('/diagnostics/{id}/delete', [\App\Http\Controllers\Admin\DiagnosticController::class, 'delete'])->name('diagnostics.delete');
});








Route::get('/add/{value}', function ($value) {
    $names = [
        'faq' => 'Часто спрашивают',
        'how_zdelat_zakaz' => 'Как сделать заказ',
        'terms_of_use' => 'Пользовательское соглашение',
        'code_of_ethics' => 'Кодекс этики',
        'privacy_policy' => 'Политика конфиденциальности',
        'warranty' => 'Гарантия',
        'delivery_terms' => 'Условия доставки и оплаты',
        'return_conditions' => 'Условия обмена/возврата',
        'vacancies' => 'Вакансии',
    ];
   return view('add', compact('value', 'names'));
})->name('add');



Route::get('/product/{id}', '\App\Http\Controllers\MainController@showproduct')->name('product');
Route::post('/products/{id}', [\App\Http\Controllers\MainController::class, 'store_order'])->name('order');
Route::get('/search', [\App\Http\Controllers\MainController::class, 'search'])->name('search');
Route::get('/ajaxsearchp', [\App\Http\Controllers\MainController::class, 'ajaxsearchp'])->name('ajaxsearchp');
Route::post('/order_create', [\App\Http\Controllers\MainController::class, 'create_order'])->name('order.create');

Route::get('/oproduct', [\App\Http\Controllers\MainController::class, 'oproduct'])->name('oproduct.delete');
Route::get('/auth', function (){
    return view('auth');
});
Route::get('/checkout', [\App\Http\Controllers\MainController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::get('/addInOP', [\App\Http\Controllers\MainController::class, 'addinop'])->name('addInOP');

Route::post('/auth', [\App\Http\Controllers\MainController::class, 'auth'])->name('auth');

Route::get('/register', function (){
    return view('register');
})->middleware('guest');

Route::post('/register', [\App\Http\Controllers\MainController::class, 'register'])->middleware('guest')->name('register');








