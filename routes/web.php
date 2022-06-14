<?php

use App\Admin\Banner;
use App\Admin\Category;
use App\FoodCategory;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;
use Whoops\Run;
// use Mail;
use App\Mail\SendMail;
use App\Jobs\ProcessPodcast;
use Carbon\Carbon;


// use Auth;
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
Route::group(['namespace' => 'SuperAdmin', 'prefix' => 'superAdmin', 'as' => 'superAdmin.'],function() {
    Route::match(['get', 'post'], '/', 'SuperAdminController@login')->name('login');
    Route::group(['middleware' => ['superAdmin']], function() {
        Route::get('dashboard', 'SuperAdminController@dashboard')->name('dashboard');
        Route::get('logout', 'SuperAdminController@logout')->name('logout');
        Route::get('settings', 'SuperAdminController@settings')->name('settings');
        Route::post('check-current-password', 'SuperAdminController@checkCurrentPassword');
        Route::post('update-current-password', 'SuperAdminController@updateCurrentPassword')->name('update.current.password');
        Route::match(['get', 'post'], 'update-admin-details', 'SuperAdminController@updateAdminDetails')->name('update.admin.details');

        // route for  admin 
        Route::get('all-admins', 'SuperAdminController@admin')->name('details');
        Route::post('add-edit-admin/{id?}', 'SuperAdminController@addEditAdmin')->name('add.edit.admin');
        Route::post('add-edit-access/{id?}', 'SuperAdminController@access')->name('add.edit.access');


        // Category
        Route::get('categories', 'CategoryController@categories')->name('categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory')->name('add.edit.category');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category/{id?}', 'CategoryController@deleteCategory')->name('delete-category');

        // banner 
        Route::get('banner', 'BannerController@banner')->name('banner');
        Route::post('update-banner-status', 'BannerController@updateBannerStatus');
        Route::post('add-banner', 'BannerController@add')->name('add.banner');
        Route::post('edit-banner/{id}', 'BannerController@edit')->name('edit.banner');
        Route::get('delete-banner/{id}', 'BannerController@delete')->name('delete.banner');

         // testimonial 
         Route::get('tesimonial', 'TestimonialController@testimonial')->name('testimonial');
         Route::match(['get', 'post'], 'add-edit-testimonial/{id?}', 'TestimonialController@addEditTestimonail')->name('add.edit.testimonial');
         Route::get('delete-testimonial/{id?}', 'TestimonialController@deleteTestimonail')->name('delete.testimonial');


        //  route for post 
        Route::get('post-request', 'PostController@showPostRequest')->name('post.request');
        Route::get('post-detail/{id}', 'PostController@showPostDetail')->name('post.detail');
        Route::post('post-update-status/{id}', 'PostController@updateStatus')->name('post.update.status');


 
    });
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::match(['get', 'post'], '/', 'AdminController@login')->name('login');
    Route::match(['get', 'post'], '/register', 'AdminController@register')->name('register'); 
    Route::group(['middleware' => ['admin']], function() {
        
      // route for billing 
        Route::group(['middleware'=>['ChekcRole:Billing']], function(){
            Route::get('billing', 'BillingController@billing')->name('billing');
            Route::get('customer-all-inovice/{id?}', 'BillingController@customerAllInvoice')->name('customer.all.invoice');
            Route::get('customer-bill-print/{id?}', 'BillingController@customerBillingPrint')->name('customer.bill.print');
        });
        Route::group(['middleware'=>['ChekcRole:Room']], function(){
                  // route for rooms 
            Route::get('room', 'RoomController@rooms')->name('room');
            Route::match(['get', 'post'], 'add-edit-room/{id?}', 'RoomController@addEditRoom')->name('add.edit.room');
            Route::get('delete-room/{id?}', 'RoomController@deleteRoom')->name('delete.room');
        });
        Route::group(['middleware'=>['ChekcRole:BookRoom']], function(){
               // route for book  roomms 
            Route::get('book-room', 'RoomController@bookRooms')->name('book.room');
            Route::match(['get', 'post'], 'add-edit-book-boom/{id?}', 'RoomController@addEditBookRoom')->name('add.edit.book.room');
            Route::get('ajax-get-customer/{id?}', 'RoomController@ajaxGetCustomer');
            Route::get('ajax-get-room/{id?}', 'RoomController@ajaxGetRoom');
            Route::post('checkout-room/{id}', 'RoomController@checkoutRoom')->name('checkout.room');
            Route::get('room-bill-print/{id}', 'RoomController@roomBillPrint')->name('room.bill.print');
            Route::get('delete-book-room/{id?}', 'RoomController@deleteBookRoom');
        });
        Route::group(['middleware'=>['ChekcRole:SwimmingPool']], function(){
            // route for swimming pool 
            Route::get('swimming-pool', 'SwimmingController@swimmingPool')->name('swimming.pool');
            Route::match(['get', 'post'], 'add-edit-swimming-pool/{id?}', 'SwimmingController@addEditSwimmingPool')->name('add.edit.swimming.pool');
            Route::get('delete-swimming-pool/{id?}', 'SwimmingController@deleteSwimmingPool')->name('delete.swimming.pool');
        });
        Route::group(['middleware'=>['ChekcRole:Rafting']], function(){
            // route for rafting
            Route::get('rafting', 'RaftingController@rafting')->name('rafting');
            Route::match(['get', 'post'], 'add-edit-rafting/{id?}', 'RaftingController@addEditRafting')->name('add.edit.rafting');
            Route::get('delete-rafting/{id?}', 'RaftingController@deleteRafting')->name('delete.rafting');
        });
        Route::group(['middleware'=>['ChekcRole:Tent']], function(){
                  // route for Tent
            Route::get('tent', 'TentController@tent')->name('tent');
            Route::match(['get', 'post'], 'add-edit-tent/{id?}', 'TentController@addEditTent')->name('add.edit.tent');
            Route::get('delete-tent/{id?}', 'TentController@deleteTent')->name('delete.tent');
        });
        Route::group(['middleware'=>['ChekcRole:Room']], function(){
            // route for RentTent
           Route::get('rent-tent', 'RentTentController@rentTent')->name('rent.tent');
           Route::post('ajax-get-tent-price','RentTentController@ajaxGetTentPrice');
           Route::match(['get', 'post'], 'add-edit-rent-tent/{id?}', 'RentTentController@addEditRentTent')->name('add.edit.rent.tent');
           Route::get('delete-rent-tent/{id?}', 'RentTentController@deleteRentTent')->name('delete.rent.tent');
        });

   


    
      Route::get('get-bar', 'ChartsController@monthlyReport');
      Route::get('get-sale', 'ChartsController@monthlySaleReport');
      // Route::group(['middleware'=>['ChekcRole:Admin', 'ChekcRole:add']], function(){

      Route::get('user', 'AdminController@viewUser')->name('user');
      Route::match(['get', 'post'],'add-edit-user/{id?}', 'AdminController@addEditUser')->name('add.edit.user');
      Route::get('delete-user/{id}', 'AdminController@deleteUser');
      

      Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
      Route::get('logout', 'AdminController@logout')->name('logout');
      Route::get('settings', 'AdminController@settings')->name('settings');
      Route::post('check-current-password', 'AdminController@checkCurrentPassword');
      Route::post('update-current-password', 'AdminController@updateCurrentPassword')->name('update.current.password');
      Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails')->name('update.admin.details');
      
      //   rotue for all screen 
      //   Route for POS
      Route::group(['middleware'=>['ChekcRole:POS']], function(){
         Route::match(['get', 'post'], 'sale-food/{id?}', 'SaleController@addEditSale')->name('add.edit.sale');
         Route::get('food/{url}', 'SaleController@table')->name('food');
         Route::get('ajax-get-room-table', 'SaleController@ajaxGetRoomTable');
         Route::post('ajax-add-customer', 'SaleController@addCusomter');
         Route::post('ajax-delete-customer-table', 'SaleController@deleteCusomter');
         Route::post('ajax-search-food', 'SaleController@ajaxSearchFood');
         Route::get('add-table}', 'SaleController@addTable')->name('add.table');
         Route::get('delete-sale/{id?}', 'SaleController@deleteSale')->name('delete.sale');
         Route::post('add-customer', 'SaleController@addCustomer')->name('add.customer');
         Route::post('update-cart-item-quantity', 'SaleController@updateCart');
         Route::get('ajax-get-item', 'SaleController@ajaxGetItem');
         Route::get('ajax-get-item-type', 'SaleController@ajaxGetItemType');
         Route::post('ajax-food-table', 'SaleController@ajaxFoodTable');
         Route::post('/delete-cart-item','SaleController@deleteCart')->name('delete.cart');
         Route::post('place-order', 'SaleController@placeOrder')->name('place.order');
         Route::get('ajax-get-modify-order', 'SaleController@ajaxGetModifyOrder');
         Route::post('/update-order-item-quantity', 'SaleController@updateOrder');
         Route::post('/delete-order-item-quantity', 'SaleController@deleteOrderDetails');
         Route::get('ajax-order-details', 'SaleController@ajaxOrderDetails');
         Route::get('ajax-order-details', 'SaleController@ajaxOrderDetails');
         Route::get('ajax-kit-order-details', 'SaleController@ajaxKotOrderDetails');
         Route::get('ajax-bot-order-details', 'SaleController@ajaxBotOrderDetails');
         Route::get('oder-innovice', 'SaleController@orderInnovice')->name('sale.innovice');
         Route::get('oder-bill', 'SaleController@orderBill')->name('sale.bill');
         Route::post('cancel-order', 'SaleController@cancelOrder')->name('cancel.order');
         Route::get('kitchen-status', 'SaleController@kitchenStatus');
         Route::post('bill-print', 'SaleController@billPrint')->name('bill.print');

      });
      Route::post('update-food-status', 'AllScreenController@updateFoodStatus')->name('update.food.status');

      // route for kitchen 
      Route::group(['middleware'=>['ChekcRole:Kitchen']], function(){
         Route::get('kitchen', 'AllScreenController@kitchen')->name('kitchen');
      });
      
      // route for caffe 
      Route::group(['middleware'=>['ChekcRole:Caffe']], function(){
         Route::get('caffe', 'AllScreenController@caffe')->name('caffe');
      });

      // route for bar 
      Route::group(['middleware'=>['ChekcRole:Bar']], function(){
         Route::get('bar', 'AllScreenController@bar')->name('bar');
      });

      // route for waiter 
      Route::group(['middleware'=>['ChekcRole:Waiter']], function(){
         Route::get('waiter-collect-food', 'AllScreenController@waiterCollectFood')->name('waiter.collect.food');
         Route::post('collect-food', 'AllScreenController@collectFood')->name('collect.food');
      });

           
      // Route for all screen

      //routes for ingredientCategory
      Route::group(['middleware'=>['ChekcRole:IngredientCategory']], function(){
         Route::get('ingredient-categories', 'ingredientCategoryController@ingredientCategories')->name('ingredientCategory');
         Route::match(['get', 'post'], 'add-edit-ingredientCategory/{id?}', 'ingredientCategoryController@addEditIngredientCategory')->name('add.edit.ingredient.category');
         Route::get('delete-ingredientCategory/{id?}', 'ingredientCategoryController@deleteIngredientCategory')->name('delete.ingredient.category');

      });
      Route::group(['middleware'=>['ChekcRole:IngredientUnit']], function(){
         //routes for ingredientUnit
         Route::get('ingredient-units', 'ingredientUnitsController@ingredientUnits')->name('ingredientUnit');
         Route::match(['get', 'post'], 'add-edit-ingredientUnit/{id?}', 'ingredientUnitsController@addEditIngredientUnit')->name('add.edit.ingredient.unit');
         Route::get('delete-ingredientUnit/{id?}', 'ingredientUnitsController@deleteIngredientUnit')->name('delete.ingredient.unit');

      });
      Route::group(['middleware'=>['ChekcRole:IngredientItem']], function(){
         //routes for ingredientItem
         Route::get('ingredient-items', 'IngredientItemsController@ingredientItems')->name('ingredientItem');
         Route::match(['get', 'post'], 'add-edit-ingredientItem/{id?}', 'IngredientItemsController@addEditIngredientItem')->name('add.edit.ingredient.item');
         Route::get('delete-ingredientItem/{id?}', 'IngredientItemsController@deleteIngredientItem')->name('delete.ingredient.item');
      });

      // route for  FoodCategory 
      Route::group(['middleware'=>['ChekcRole:FoodCategory']], function(){
         //routes for foodCategory
         Route::get('food-categories', 'FoodCategoryController@foodCategories')->name('foodCategory');
         Route::match(['get', 'post'], 'add-edit-foodCategory/{id?}', 'FoodCategoryController@addEditFoodCategory')->name('add.edit.food.category');
         Route::get('delete-foodCategory/{id?}', 'FoodCategoryController@deleteFoodCategory')->name('delete.food.category');
      });

      // route for foodMenu 
      Route::group(['middleware'=>['ChekcRole:FoodMenu']], function(){
         //routes for foodMenu
         Route::get('food-menus', 'FoodMenuController@foodMenus')->name('foodMenu');
         Route::match(['get', 'post'], 'add-edit-foodMenu/{id?}', 'FoodMenuController@addEditFoodMenu')->name('add.edit.food.menu');
         Route::get('delete-foodMenu/{id?}', 'FoodMenuController@deleteFoodMenu')->name('delete.food.menu');
                
         //ajax food menu routes
         Route::post('delete-foodMenu-table','FoodMenuController@deletefoodMenuTable')->name('delete.foodMenu.table');
         Route::post('ajax-foodMenu-table', 'FoodMenuController@ajaxfoodMenuTable');

      });

      //  Csutomer 
        Route::match(['get', 'post'], 'add-edit-customer/{id?}', 'CustomerController@addEditCustomer')->name('add.edit.customer');

      Route::group(['middleware'=>['ChekcRole:Customer']], function(){
         //routes for customer
         Route::get('customer', 'CustomerController@customer')->name('customer');
         Route::get('delete-customer/{id?}', 'CustomerController@deleteCustomer')->name('delete.customer');
      });
      
        Route::match(['get', 'post'], 'add-edit-supplier/{id?}', 'SupplierController@addEditSupplier')->name('add.edit.supplier');
      // route supplier 
      Route::group(['middleware'=>['ChekcRole:Supplier']], function(){
         //routes for supplier
         Route::get('supplier', 'SupplierController@Supplier')->name('supplier');
         Route::get('delete-supplier/{id?}', 'SupplierController@deleteSupplier')->name('delete.supplier');
      });

      // expense
      Route::group(['middleware'=>['ChekcRole:Expense']], function(){
         //routes for expense
         Route::get('expense', 'ExpenseController@Expense')->name('expense');
         Route::match(['get', 'post'], 'add-edit-expense/{id?}', 'ExpenseController@addEditExpense')->name('add.edit.expense');
         Route::get('delete-expense/{id?}', 'ExpenseController@deleteExpense')->name('delete.expense');
      });

      // payment 
      Route::group(['middleware'=>['ChekcRole:Payment']], function(){
         //routes for paymentMethod
         Route::get('paymentMethod', 'PaymentMethodController@paymentMethod')->name('paymentMethod');
         Route::match(['get', 'post'], 'add-edit-paymentMethod/{id?}', 'PaymentMethodController@addEditpaymentMethod')->name('add.edit.paymentMethod');
         Route::get('delete-paymentMethod/{id?}', 'PaymentMethodController@deletepaymentMethod')->name('delete.paymentMethod');
      });

      // route table 
      Route::group(['middleware'=>['ChekcRole:Table']], function(){
         //routes for table.
         Route::get('table', 'TableController@table')->name('table');
         Route::match(['get', 'post'], 'add-edit-table/{id?}', 'TableController@addEditTable')->name('add.edit.table');
         Route::get('delete-table/{id?}', 'TableController@deleteTable')->name('delete.table');
      });

      // route for puchase 
      Route::group(['middleware'=>['ChekcRole:Purchase']], function(){
         //routes for purchase
         Route::get('purchase', 'PurchaseController@purchase')->name('purchase');
         Route::match(['get', 'post'], 'add-edit-purchase/{id?}', 'PurchaseController@addEditPurchase')->name('add.edit.purchase');
         Route::get('delete-purchase/{id?}', 'PurchaseController@deletePurchase')->name('delete.purchase');
          //ajax purchase routes
          Route::post('delete-purchase-table','PurchaseController@deletePurchaseCart')->name('delete.purchase.table');
          Route::post('ajax-purchase-table', 'PurchaseController@ajaxPurchaseTable');
          Route::post('check-current-amount','PurchaseController@chkCurrentAmount');

      });

      // route for sale 
      Route::group(['middleware'=>['ChekcRole:Sale']], function(){
         Route::get('sale', 'SaleController@Sale')->name('sale');
         Route::get('sale-billing/{id}', 'SaleController@saleBillPring')->name('sale.billing');

      });

   //   route for stock
      Route::group(['middleware'=>['ChekcRole:Stock']], function(){
    
      });
      // route for stock adjusment 
      Route::group(['middleware'=>['ChekcRole:StockAdjusment']], function(){
    
      });
      
      // route for waste 
      Route::group(['middleware'=>['ChekcRole:Waste']], function(){
       //routes for waste
       Route::get('waste', 'WasteController@Waste')->name('waste');
       Route::match(['get', 'post'], 'add-edit-waste/{id?}', 'WasteController@addEditWaste')->name('add.edit.waste');
       Route::get('delete-waste/{id?}', 'WasteController@deleteWaste')->name('delete.waste');

      });

      // route supplier due payment 
      Route::group(['middleware'=>['ChekcRole:SupplierDuePayment']], function(){
         Route::get('view-supplier-deu-payment','SupplierController@viewSupplierDeuPayment')->name('view.supplier.deu.payments');
      });

      // route customer  due payment 
      Route::group(['middleware'=>['ChekcRole:CustomerDuePayment']], function(){
         Route::get('view-customer-deu-receive','CustomerController@viewCustomerDeuReceives')->name('view.customer.deu.receives');
      });

      // route for EmployeeManagement
      Route::group(['middleware'=>['ChekcRole:EmployeeManagement']], function(){
         //routes for attendance
         Route::get('attendance', 'AttendanceController@Attendance')->name('attendance');
         Route::match(['get', 'post'], 'add-edit-attendance/{id?}', 'AttendanceController@addEditAttendance')->name('add.edit.attendance');
         Route::get('delete-attendance/{id?}', 'AttendanceController@deleteAttendance')->name('delete.attendance');

         //routes for task
         Route::get('task-view', 'TaskController@viewTask')->name('view.task');
         Route::get('task', 'TaskController@Task')->name('task');
         Route::match(['get', 'post'], 'add-edit-task/{id?}', 'TaskController@addEditTask')->name('add.edit.task');
         Route::match(['get', 'post'], 'update-task/{id?}', 'TaskController@updateTask')->name('update.task');
         Route::get('delete-task/{id?}', 'TaskController@deleteTask')->name('delete.task');

         //routes for leave
         Route::get('leave', 'LeaveController@Leave')->name('leave');
         Route::match(['get', 'post'], 'add-edit-leave/{id?}', 'LeaveController@addEditLeave')->name('add.edit.leave');
         Route::match(['get', 'post'], 'update-leave/{id?}', 'LeaveController@updateLeave')->name('update.leave');
         Route::get('delete-leave/{id?}', 'LeaveController@deleteLeave')->name('delete.leave');
         
           //routes for salary
           Route::get('view-salary','AttendanceController@viewSalary')->name('view.salary');
      
      });
      
      // route for account 
      Route::group(['middleware'=>['ChekcRole:Account']], function(){
       
         //routes for tax and vat
         Route::get('taxVat', 'TaxVatController@taxVat')->name('taxVat');
         Route::match(['get', 'post'], 'add-edit-taxVat/{id?}', 'TaxVatController@addEditTaxVat')->name('add.edit.taxVat');
         Route::get('delete-taxVat/{id?}', 'TaxVatController@deleteTaxVat')->name('delete.taxVat');

         //routes for bank Deposit
         Route::get('bankDeposit', 'BankDepositController@bankDeposit')->name('bankDeposit');
         Route::match(['get', 'post'], 'add-edit-bankDeposit/{id?}', 'BankDepositController@addEditBankDeposit')->name('add.edit.bankDeposit');
         Route::get('delete-bankDeposit/{id?}', 'BankDepositController@deleteBankDeposit')->name('delete.bankDeposit');

         //routes for bank 
         Route::get('bank', 'BankController@bank')->name('bank');
         Route::match(['get', 'post'], 'add-edit-bank/{id?}', 'BankController@addEditBank')->name('add.edit.bank');
         Route::get('delete-bank/{id?}', 'BankController@deleteBank')->name('delete.bank');


         //routes for Cash hand
         Route::get('cashHand', 'CashHandController@cashHand')->name('cashHand');
         Route::match(['get', 'post'], 'add-edit-cashHand/{id?}', 'CashHandController@addEditCashHand')->name('add.edit.cashHand');
         Route::get('delete-cashHand/{id?}', 'CashHandController@deleteCashHand')->name('delete.cashHand');

         //routes for liabilities
         Route::get('liabilities', 'LiabilitiesController@liabilities')->name('liabilities');
         Route::match(['get', 'post'], 'add-edit-liabilities/{id?}', 'LiabilitiesController@addEditLiabilities')->name('add.edit.liabilities');
         Route::get('delete-liabilities/{id?}', 'LiabilitiesController@deleteLiabilities')->name('delete.liabilities');

         //routes for income
         Route::get('income', 'IncomeController@income')->name('income');
         Route::match(['get', 'post'], 'add-edit-income/{id?}', 'IncomeController@addEditIncome')->name('add.edit.income');
         Route::get('delete-income/{id?}', 'IncomeController@deleteIncome')->name('delete.income');

         //routes for assets
         Route::get('assets', 'AssetsController@assets')->name('assets');
         Route::match(['get', 'post'], 'add-edit-assets/{id?}', 'AssetsController@addEditAssets')->name('add.edit.assets');
         Route::get('delete-assets/{id?}', 'AssetsController@deleteAssets')->name('delete.assets');

      });

      // route for report 
      Route::group(['middleware'=>['ChekcRole:Report']], function(){
         // route for report 
         Route::get('pl-account-report','ReportController@plAccountReport')->name('pl.account.report');
         Route::get('admin-daily-summary-report', 'ReportController@dailySummaryReport')->name('daily.summary.report');
         Route::get('purchase-report','ReportController@purchaseReport')->name('purchase.report');
         Route::get('attendance-report','ReportController@attendanceReport')->name('attendance.report');
         Route::get('sale-report','ReportController@saleReport')->name('sale.report');
         Route::get('miscellaneous-report','ReportController@miscellaneousReport')->name('miscellaneous.report');
         Route::get('stock-report','ReportController@stockReport')->name('stock.report');
         Route::get('consumption-report','ReportController@consumptionReport')->name('consumption.report');
         Route::get('low-inventory-report','ReportController@lowInventoryReport')->name('low.inventory.report');
         Route::get('leave-report','ReportController@leaveReport')->name('leave.report');
         Route::get('salary-report','ReportController@salaryReport')->name('salary.report');
         Route::get('tax-report','ReportController@taxReport')->name('tax.report');
         Route::get('task-report','ReportController@taskReport')->name('task.report');
         Route::get('waste-report','WasteController@wasteReport')->name('waste.report');
         Route::get('customer-report','CustomerController@customerReport')->name('customer.report');

      });
      Route::group(['middleware'=>['ChekcRole:Miscellaneous']], function(){
           //routes for electricity consumption
           Route::get('electricity', 'ElectricityController@electricity')->name('electricity');
           Route::match(['get', 'post'], 'add-edit-electricity/{id?}', 'ElectricityController@addEditElectricity')->name('add.edit.electricity');
           Route::get('delete-electricity/{id?}', 'ElectricityController@deleteElectricity')->name('delete.electricity');
  
           //routes for  internet consumption
           Route::get('internet', 'InternetController@internet')->name('internet');
           Route::match(['get', 'post'], 'add-edit-internet/{id?}', 'InternetController@addEditInternet')->name('add.edit.internet');
           Route::get('delete-internet/{id?}', 'InternetController@deleteInternet')->name('delete.internet');
  
           //routes for  water consumption
           Route::get('water', 'WaterController@water')->name('water');
           Route::match(['get', 'post'], 'add-edit-water/{id?}', 'WaterController@addEditWater')->name('add.edit.water');
           Route::get('delete-water/{id?}', 'WaterController@deleteWater')->name('delete.water');
  
         //routes for report of electricity
         Route::get('electricity-report','ElectricityController@electricityReport')->name('electricity.report');
                  
         //routes for report of internet
         Route::get('internet-report','InternetController@internetReport')->name('internet.report');
         
         //routes for report of electricity
         Route::get('water-report','WaterController@waterReport')->name('water.report');
      });
      // routes for checkin and checkout kitchen
    

        
        Route::get('read-all-notification', function(){
            auth('admin')->user()->unreadNotifications->markAsRead(); 
            return redirect()->back();
        })->name('read.all.notification');

    });

});

Route::get('/', function(){
   if(!auth('admin')->check()){
      return redirect('/admin');
   }
    return redirect()->route('admin.dashboard');
})->name('home');


// Route::get('qr-code-g', function () {
//     $qr_code = rand(111,99999);
//     $file = "image/$qr_code.png";
//     $link = "https://qrmenu.summitp.com.np/menu/$qr_code";
//    \QRCode::text($link)->setErrorCorrectionLevel("H")->setOutfile($file)->png();
// });


