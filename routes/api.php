<?php

use App\Constants\PermissionTitle;
use App\Http\Controllers\Contacts\EmailController;
use App\Http\Controllers\Contacts\PhoneController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\File\FileController;
use App\Http\Controllers\Price\PriceTypeController;
use App\Http\Controllers\SaleSystem\SaleSystemController;
use App\Http\Controllers\Currency\CurrencyController;
use App\Http\Controllers\Payment\PaymentMethodTypeController;
use App\Http\Controllers\SaleSystem\PartnerController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware(['auth:api', 'permission'])->group(
    function () {
        Route::get('{user}/roles', [UserController::class, 'getRoles'])->name('roles.index');
        Route::put('{user}/roles', [UserController::class, 'syncRoles'])->name('roles.sync');
        Route::post(
            '{user}/roles/{role}',
            [UserController::class, 'addRole']
        )
            ->name('roles.store');
        Route::delete(
            '{user}/roles/{role}',
            [UserController::class, 'deleteRole']
        )
            ->name('roles.destroy');
    }
);


Route::prefix('countries')->middleware(['auth:api'])->group(
    function () {
        Route::middleware('permission:' . PermissionTitle::GET_ALL_COUNTRY_LANGUAGES)
            ->get(
                '{country}/languages',
                [CountryController::class, 'getLanguages']
            )
            ->name('languages.index');
        Route::middleware('permission:' . PermissionTitle::UPDATE_COUNTRY_LANGUAGES)
            ->put(
                '{country}/languages',
                [CountryController::class, 'syncLanguages']
            )
            ->name('languages.sync');
        Route::middleware('permission:' . PermissionTitle::CREATE_COUNTRY_LANGUAGES)
            ->post(
                '{country}/languages/{language}',
                [CountryController::class, 'addLanguage']
            )
            ->name('languages.store');
        Route::middleware('permission:' . PermissionTitle::DELETE_COUNTRY_LANGUAGES)
            ->delete(
                '{country}/languages/{language}',
                [CountryController::class, 'deleteLanguage']
            )
            ->name('languages.destroy');
    }
);


Route::middleware(['auth:api', 'permission:SetDefaultCurrency'])->group(function () {
    Route::put('currency/{currency}/set-default', [CurrencyController::class, 'setDefault'])
        ->name('currency.default');
});


Route::apiResource('countries', CountryController::class)->only(['index', 'show']);

Route::middleware(['auth:api', 'permission'])->group(function () {
    Route::apiResource('price-type', PriceTypeController::class);
    Route::apiResource('email', EmailController::class);
    Route::apiResource('phone', PhoneController::class);
    Route::apiResource('files', FileController::class)->except(['update']);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class)->except(['destroy']);
    Route::apiResource('sale-systems', SaleSystemController::class);
    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('partners', PartnerController::class);
    Route::apiResource('countries', CountryController::class)->except(['index', 'show']);

    Route::apiResource('permissions', PermissionController::class)->only(['index', 'show']);
    Route::apiResource('payment-method-types', PaymentMethodTypeController::class)->only(['index', 'show']);

    Route::prefix('roles')->group(
        function () {
            Route::get('{role}/permissions', [RoleController::class, 'getPermissions'])->name('permissions.index');
            Route::put('{role}/permissions', [RoleController::class, 'syncPermissions'])->name('permissions.sync');
            Route::post(
                '{role}/permissions/{permission}',
                [RoleController::class, 'addPermission']
            )
                ->name('permissions.store');
            Route::delete(
                '{role}/permissions/{permission}',
                [RoleController::class, 'deletePermission']
            )
                ->name('permissions.destroy');
        }
    );
});

//Authentication
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('logout', [LoginController::class, 'logout']);
});
