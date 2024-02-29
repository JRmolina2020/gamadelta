<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategorieController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\FactureController;
use App\Http\Controllers\API\FactureDetailController;
use App\Http\Controllers\API\BillController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\MoneyController;
use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\ProviderController;
use App\Http\Controllers\API\EmailFac;
use App\Http\Controllers\AuthController;

//routes view one
Route::get('/', function () {
    return view('login');
})->name('login');
//route login functions 

Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth'], function () {
    //route view two
    Route::get('/home', function () {
        return view('home');
    });


    Route::get('/usuarios', function () {
        return view('users.index');
    })->middleware('permission:seguridad');
    Route::get('/roles', function () {
        return view('roles.index');
    })->middleware('permission:seguridad');;
    Route::get('/permisos', function () {
        return view('permissions.index');
    })->middleware('permission:seguridad');;
    Route::get('/perfil', function () {
        return view('users.profile');
    });
    Route::get('/categorias', function () {
        return view('categories.index');
    });
    Route::get('/productos', function () {
        return view('products.index');
    });
    Route::get('/clientes', function () {
        return view('clients.index');
    });
    Route::get('/proveedores', function () {
        return view('providers.index');
    });
    Route::get('/facturas', function () {
        return view('factures.index');
    });
    Route::get('/fupdate', function () {
        return view('factures.update');
    });
    Route::get('/ventas', function () {
        return view('sales.index');
    });
    Route::get('/gastos', function () {
        return view('bills.index');
    });
    Route::get('/empresa', function () {
        return view('companies.index');
    })->middleware('permission:seguridad');;
    Route::get('/cuentas', function () {
        return view('money.index');
    })->middleware('permission:seguridad');;
    Route::get('/entradas', function () {
        return view('incomes.index');
    });
    Route::get('/inventario', function () {
        return view('inventory.index');
    });
    Route::get('/proveedores', function () {
        return view('provider.index');
    });
    Route::get('/get-permissions', function () {
        return auth()->check() ? auth()->user()->jsPermissions() : 0;
    });
    Route::prefix('api')->group(function () {
        Route::group(['middleware' => ['getAuth']], function () {

            //routes app fuctions
            //routes users
            Route::get('/users', [UserController::class, 'index']);
            Route::post('users', [UserController::class, 'store']);
            Route::put('/user/password/{id}', [UserController::class, 'updatePassword'])->where('id', '[0-9]+');
            Route::put('/users/{id}', [UserController::class, 'update']);
            Route::put('/users/available/{id}', [UserController::class, 'available']);
            Route::put('/users/locked/{id}', [UserController::class, 'locked']);
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            //end
            //roles
            Route::get('/roles', [RoleController::class, 'index']);
            Route::post('roles', [RoleController::class, 'store']);
            Route::put('/roles/{id}', [RoleController::class, 'update']);
            Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
            //end
            //permissions
            Route::get('/permissions', [PermissionController::class, 'index']);
            Route::post('permissions', [PermissionController::class, 'store']);
            Route::put('/permissions/{id}', [PermissionController::class, 'update']);
            Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);
            //end
            //products
            Route::get('/products', [ProductController::class, 'index']);
            Route::post('products', [ProductController::class, 'store']);
            Route::put('/products/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('/products/{id}', [ProductController::class, 'destroy']);
            //end
            //categories
            Route::get('/categories', [CategorieController::class, 'index']);
            Route::post('categories', [CategorieController::class, 'store']);
            Route::put('/categories/{id}', [CategorieController::class, 'update'])->where('id', '[0-9]+');
            //
            //clients
            Route::get('/clients', [ClientController::class, 'index']);
            Route::post('clients', [ClientController::class, 'store']);
            Route::put('/clients/{id}', [ClientController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->where('id', '[0-9]+');
            //end
            //facture
            Route::post('factures', [FactureController::class, 'store']);
            Route::get('/factures/{date}', [FactureController::class, 'index']);
            Route::get('/descriptionfac/{date}', [FactureController::class, 'descriptionFacture']);
            Route::get('/factureUnique/{id}', [FactureController::class, 'factureUnique'])->where('id', '[0-9]+');
            Route::get('/type_sale/{date}', [FactureController::class, 'type_sale']);
            Route::get('/type_sale_one/{date}/{type}', [FactureController::class, 'type_sale_one']);
            Route::delete('/factures/{id}', [FactureController::class, 'destroy'])->where('id', '[0-9]+');
            Route::put('/factures/{id}', [FactureController::class, 'updateStatus'])->where('id', '[0-9]+');
            Route::put('/fupdate/{id}', [FactureController::class, 'fupdate'])->where('id', '[0-9]+');
            Route::get('/gain/{date}/{datetwo}/{type}', [FactureController::class, 'gain']);
            Route::get('/clientot/{id}', [FactureController::class, 'clientTot']);
            Route::get('/gainTot/{date}/{datetwo}/{type}', [FactureController::class, 'gainTot']);
            Route::get('/gainTotf/{date}/{datetwo}/{type}', [FactureController::class, 'gainTotf']);
            Route::get('/userTot/{date}/{datetwo}', [FactureController::class, 'userTot']);
            Route::get('/emailfac/{id}', [EmailFac::class, 'sendMailWithPDF'])->where('id', '[0-9]+');
            //
            //facture details
            Route::get('/details/{id}', [FactureDetailController::class, 'index'])->where('id', '[0-9]+');
            //end
            //bills
            Route::post('bills', [BillController::class, 'store']);
            Route::get('/bills/{date}', [BillController::class, 'index']);
            Route::get('/billsTot/{date}', [BillController::class, 'sumTot']);
            Route::put('/bills/{id}', [BillController::class, 'update']);
            Route::delete('/bills/{id}', [BillController::class, 'destroy'])->where('id', '[0-9]+');
            //end
            //companies
            Route::get('/companies', [CompanyController::class, 'index_two']);
            Route::get('/company', [CompanyController::class, 'index']);
            Route::post('company', [CompanyController::class, 'store']);
            Route::put('/company/{id}', [CompanyController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->where('id', '[0-9]+');
            //end
            //acounts
            Route::get('/money', [MoneyController::class, 'index']);
            Route::get('/moneySingle', [MoneyController::class, 'index_two']);
            Route::post('money', [MoneyController::class, 'store']);
            Route::put('/money/{id}', [MoneyController::class, 'update'])->where('id', '[0-9]+');
            Route::delete('/money/{id}', [MoneyController::class, 'destroy'])->where('id', '[0-9]+');
            //income
            Route::post('income', [IncomeController::class, 'store']);
            Route::get('/income/{date}', [IncomeController::class, 'indexData']);
            Route::get('/incometwo/{date}/{datetwo}', [IncomeController::class, 'indexDatatwo']);
            Route::delete('/income/{id}', [IncomeController::class, 'destroy'])->where('id', '[0-9]+');
            //providers
            Route::get('/providers', [ProviderController::class, 'index']);
            Route::post('providers', [ProviderController::class, 'store']);
            // Route::put('/clients/{id}', [ClientController::class, 'update'])->where('id', '[0-9]+');
            // Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->where('id', '[0-9]+');
        });
    });
});
