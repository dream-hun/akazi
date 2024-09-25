<?php

use App\Http\Controllers\Admin\AdvertController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdvertShowController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CategoryShowController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\EmployerIndexController;
use App\Http\Controllers\ShowEmployerController;
use App\Http\Controllers\StoreContactController;
use App\Http\Controllers\StoreSubscriberController;
use App\Http\Controllers\WelcomeController;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('landing');
Route::get('/employers', EmployerIndexController::class)->name('employers');
Route::get('/employer/{employer:slug}', ShowEmployerController::class)->name('employers.show');
Route::get('/job/{job:slug}', AdvertShowController::class)->name('adverts.show');
Route::get('/jobs/{category:slug}', CategoryShowController::class)->name('category.show');
Route::get('/contact-us', ContactUsController::class)->name('contact.index');
Route::post('/contact-us', StoreContactController::class)->name('contact.store');
Route::post('/subscribe', StoreSubscriberController::class)->name('subscriber');
Route::view('/about-us', 'about.index')->name('about-us');
Route::view('/privacy-and-policy', 'privacy-and-policy')->name('privacy');
Route::get('/faqs', function () {
    $faqs = Faq::where('status', '=', 'active')->get();

    return view('faq', ['faqs' => $faqs]);
})->name('faqs');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Category
    Route::delete('categories/destroy', [CategoryController::class, 'massDestroy'])->name('categories.massDestroy');
    Route::resource('categories', CategoryController::class);

    // Company
    Route::delete('companies/destroy', [CompanyController::class, 'massDestroy'])->name('companies.massDestroy');
    Route::post('companies/media', [CompanyController::class, 'storeMedia'])->name('companies.storeMedia');
    Route::post('companies/ckmedia', [CompanyController::class, 'storeCKEditorImages'])->name('companies.storeCKEditorImages');
    Route::resource('companies', CompanyController::class);

    // Advert
    Route::delete('adverts/destroy', [AdvertController::class, 'massDestroy'])->name('adverts.massDestroy');
    Route::post('adverts/media', [AdvertController::class, 'storeMedia'])->name('adverts.storeMedia');
    Route::post('adverts/ckmedia', [AdvertController::class, 'storeCKEditorImages'])->name('adverts.storeCKEditorImages');
    Route::resource('adverts', AdvertController::class);

    // Contact
    Route::delete('contacts/destroy', [ContactController::class, 'massDestroy'])->name('contacts.massDestroy');
    Route::resource('contacts', ContactController::class);

    // Faq
    Route::delete('faqs/destroy', [FaqController::class, 'massDestroy'])->name('faqs.massDestroy');
    Route::resource('faqs', FaqController::class);

    // Setting
    Route::delete('settings/destroy', [SettingController::class, 'massDestroy'])->name('settings.massDestroy');
    Route::resource('settings', SettingController::class);

    // Subscriber
    Route::resource('subscribers', SubscriberController::class, ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});
