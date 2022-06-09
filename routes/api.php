<?php

use App\Electricity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'API\Admin', 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::post('login', 'AdminController@login');
    Route::group(['middleware'=>'auth:sanctum'], function(){
        
        //  route for view staff 
        Route::get('view-saff', 'AdminController@staff');

        // route for user 
      Route::get('user', 'AdminController@viewUser');
      Route::post('add-user', 'AdminController@addUser');
      Route::post('edit-user', 'AdminController@editUser');
      Route::post('delete-user', 'AdminController@deleteUser');
      
        
        // route for setting 
        Route::post('update-current-password', 'AdminController@updateCurrentPassword');
        Route::post('update-admin-details', 'AdminController@updateAdminDetails');

        // route for ingredients 
        Route::get('view-ingredient-categories', 'IngredientCategoryController@ingredientCategories');
        Route::post('add-ingredient-category', 'IngredientCategoryController@addIngredientCategory');
        Route::post('edit-ingredient-category', 'IngredientCategoryController@editIngredientCategory');

        // route for ingredients  units 
        Route::get('view-ingredient-unit', 'IngredintUnitController@ingredientUnit');
        Route::post('add-ingredient-unit', 'IngredintUnitController@addIngredientUnit');
        Route::post('edit-ingredient-unit', 'IngredintUnitController@editIngredientUnit');

         // route for ingredients  item 
         Route::get('view-ingredient-item', 'IngredintItemController@ingredientItem');
         Route::post('add-ingredient-item', 'IngredintItemController@addIngredientItem');
         Route::post('edit-ingredient-item', 'IngredintItemController@editIngredientItem');

        // route for food category 
        Route::get('view-food-categories', 'FoodCategoryController@foodCategory');
        Route::post('add-food-category', 'FoodCategoryController@addFoodCategory');
        Route::post('edit-food-category', 'FoodCategoryController@editFoodCategory');
        Route::post('delete-food-category', 'FoodCategoryController@deleteFoodCategory');

        // route all customer   
        Route::get('view-customer', 'CustomerController@customer');
        Route::post('add-customer', 'CustomerController@addCustomer');
        Route::post('edit-customer', 'CustomerController@editCustomer');
        Route::post('delete-customer', 'CustomerController@deleteCustomer');

        // route all table   
        Route::get('view-table', 'TableController@table');
        Route::post('add-table', 'TableController@addTable');
        Route::post('edit-table', 'TableController@editTable');
        Route::post('delete-table', 'TableController@deleteTable');

        // route all foodmenu   
        Route::get('view-foodMenu', 'FoodMenuController@foodMenu');
        Route::get('singleFoodMenu/{id}', 'FoodMenuController@singleFoodMenu');
        Route::post('add-foodMenu', 'FoodMenuController@addFoodMenu');
        Route::post('edit-foodMenu', 'FoodMenuController@editFoodMenu');
        Route::post('delete-foodMenu', 'FoodMenuController@deleteFoodMenu');

        //  route for supplier 
        Route::get('view-supplier', 'SupplierController@supplier');
        Route::get('single-supplier/{id}', 'SupplierController@singleSupplier');
        Route::post('add-supplier', 'SupplierController@addSupplier');
        Route::post('edit-supplier', 'SupplierController@editSupplier');
        Route::post('delete-supplier', 'SupplierController@deleteSupplier');

        //  route for paymentmethod 
        Route::get('view-payment', 'PaymentMethodController@payment');
        Route::get('single-payment/{id}', 'PaymentMethodController@singlePayment');
        Route::post('add-payment', 'PaymentMethodController@addPayment');
        Route::post('edit-payment', 'PaymentMethodController@editPayment');
        Route::post('delete-payment', 'PaymentMethodController@deletePayment');

        //  route for purchase 
        Route::get('view-purchase', 'PurchaseController@purchase');
        Route::get('single-purchase/{id}', 'PurchaseController@singlePurchase');
        Route::post('add-purchase', 'PurchaseController@addPurchase');
        Route::post('edit-purchase', 'PurchaseController@editPurchase');
        Route::post('delete-purchase', 'PurchaseController@deletePurchase');

        //  route for task
        Route::get('view-task', 'TaskController@task');
        Route::get('single-task/{id}', 'TaskController@singleTask');
        Route::post('add-task', 'TaskController@addTask');
        Route::post('edit-task', 'TaskController@editTask');
        Route::post('delete-task', 'TaskController@deleteTask');

        //  route for leave
        Route::get('view-leave', 'LeaveController@leave');
        Route::get('single-leave/{id}', 'LeaveController@singleLeave');
        Route::post('add-leave', 'LeaveController@addLeave');
        Route::post('update-leave-status', 'LeaveController@updateLeaveStatus');
        Route::post('delete-leave', 'LeaveController@deleteLeave');

        //  route for bandDeposite
        Route::get('view-bankDeposite', 'DepositeController@BankDeposite');
        Route::get('single-bankDeposite/{id}', 'DepositeController@singBankDeposite');
        Route::post('add-bankDeposite', 'DepositeController@addBankDeposite');
        Route::post('edit-bankDeposite', 'DepositeController@updateBankDeposite');
        Route::post('delete-bankDeposite', 'DepositeController@deleteBankDeposite');

        //  route for bank
        Route::get('view-bank', 'BankController@bank');
        Route::get('single-bank/{id}', 'BankController@singBank');
        Route::post('add-bank', 'BankController@addBank');
        Route::post('edit-bank', 'BankController@updateBank');
        Route::post('delete-bank', 'BankController@deleteBank');


        //  route for cashHand
        Route::get('view-cashHand', 'CashHandController@cashHand');
        Route::get('single-cashHand/{id}', 'CashHandController@singCashHand');
        Route::post('add-cashHand', 'CashHandController@addCashHand');
        Route::post('edit-cashHand', 'CashHandController@updateCashHand');
        Route::post('delete-cashHand', 'CashHandController@deleteCashHand');

        //  route for cashHand
        Route::get('view-liabilities', 'LiabilitiesController@liabilities');
        Route::get('single-liabilities/{id}', 'LiabilitiesController@singLiabilities');
        Route::post('add-liabilities', 'LiabilitiesController@addLiabilities');
        Route::post('edit-liabilities', 'LiabilitiesController@updateLiabilities');
        Route::post('delete-liabilities', 'LiabilitiesController@deleteLiabilities');

        //  route for income
        Route::get('view-income', 'IncomeController@income');
        Route::get('single-income/{id}', 'IncomeController@singIncome');
        Route::post('add-income', 'IncomeController@addIncome');
        Route::post('edit-income', 'IncomeController@updateIncome');
        Route::post('delete-income', 'IncomeController@deleteIncome');
        
        //  route for asset
        Route::get('view-asset', 'AssetController@asset');
        Route::get('single-asset/{id}', 'AssetController@singAsset');
        Route::post('add-asset', 'AssetController@addAsset');
        Route::post('edit-asset', 'AssetController@updateAsset');
        Route::post('delete-asset', 'AssetController@deleteAsset');


        // route for report 
        Route::get('pl-account-report','ReportController@plAccountReport');
        Route::get('daily-summary-report', 'ReportController@dailySummaryReport');
        Route::get('purchase-report','ReportController@purchaseReport');
        Route::get('attendance-report','ReportController@attendanceReport');
        Route::get('sale-report','ReportController@saleReport');
        Route::get('miscellaneous-report','ReportController@miscellaneousReport')->name('miscellaneous.report');
        Route::get('stock-report','ReportController@stockReport');
        Route::get('consumption-report','ReportController@consumptionReport');
        Route::get('low-inventory-report','ReportController@lowInventoryReport');
        Route::get('leave-report','ReportController@leaveReport');
        Route::get('salary-report','ReportController@salaryReport');
        Route::get('tax-report','ReportController@taxReport')->name('tax.report');
        Route::get('task-report','ReportController@taskReport')->name('task.report');
        Route::get('waste-report','ReportController@wasteReport')->name('waste.report');
        Route::get('customer-report','ReportController@customerReport')->name('customer.report');

        // route for Electricity 
        Route::get('view-electricty', 'ElectionController@electricty');
        Route::get('single-electricty/{id}', 'ElectionController@singleElectricty');
        Route::post('add-electricty', 'ElectionController@addElectricty');
        Route::post('edit-electricty', 'ElectionController@updateElectricty');
        Route::post('delete-electricty', 'ElectionController@deleteElectricty');


        // route for internet 
        Route::get('view-internet', 'InternetController@internet');
        Route::get('single-internet/{id}', 'InternetController@singleInternet');
        Route::post('add-internet', 'InternetController@addInternet');
        Route::post('edit-internet', 'InternetController@updateInternet');
        Route::post('delete-internet', 'InternetController@deleteInternet');
        
        // route fro water 
        Route::get('view-water', 'WasterController@water');
        Route::get('single-water/{id}', 'WasterController@singleWater');
        Route::post('add-water', 'WasterController@addWater');
        Route::post('edit-water', 'WasterController@updateWater');
        Route::post('delete-water', 'WasterController@deleteWater');
        
        // route for sales
        Route::get('view-sales', 'SaleController@sales');
        Route::get('view-customer-table', 'SaleController@customerTable');
        Route::post('add-customer-table', 'SaleController@addCustomerTable');




    });

});