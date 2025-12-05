<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CompterUserController;
use App\Http\Controllers\HistoriqueOrderController;
use App\Http\Controllers\HistroqueCartsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventtaireController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ResultOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WomenController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\StatistiqueController;
use App\Models\CompterUserModel;
use Illuminate\Support\Facades\Route;

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/',[HomeController::class,'index']);

///////////////////////////////Home////////////////////////////////////////////////
Route::resource('/home',HomeController::class);

///////////////////////////////Login////////////////////////////////////////////////
Route::resource('login',LoginController::class);

//////////////////////////Admin////////////////////////////////////////////////////
Route::resource('/admin',AdminController::class);
Route::get('/AddAdmin',[AdminController::class,'AddAdmin'])->name('AddAdmin');
Route::get('/AjouterAdmin',[AdminController::class,'AjouterAdmin'])->name('AjouterAutreAdmin');
Route::post('/storeAddAdmin',[AdminController::class,'storeAddAdmin']);

///////////////////////////////User////////////////////////////////////////////////
Route::resource('/user',UserController::class);

///////////////////////////////Men////////////////////////////////////////////////
Route::resource('/men',MenController::class);
Route::get('/historique-men', [MenController::class, 'historique_index'])->name('historique.men');
Route::get('/tablemen', [MenController::class, 'AffcherTableMen'])->name('AffcherTableMen');
///////////////////////////////women////////////////////////////////////////////////

Route::resource('/women',WomenController::class);
Route::get('/historique-woman', [WomenController::class, 'historique_index'])->name('historique.woman');
Route::get('/tablewoman', [WomenController::class, 'AffcherTableWoman'])->name('AffcherTableWoman');

///////////////////////////////carte////////////////////////////////////////////////
Route::resource('/carte',CartController::class);
Route::resource('/historiquecart',HistroqueCartsController::class);

///////////////////////////////Commantes////////////////////////////////////////////////
Route::resource('/comments',CommentsController::class);

///////////////////////////////Shop////////////////////////////////////////////////
Route::get('/search', [ShopController::class, 'search'])->name('search');
Route::resource('/shop',ShopController::class);
Route::get('/historique-shop', [ShopController::class, 'historique_index'])->name('historique.shop');
Route::get('/tableshop', [ShopController::class, 'AffcherTableShop'])->name('AffcherTableShop');

///////////////////////////////Create Compter Users////////////////////////////////////////////////
Route::resource('/comperuser',CompterUserController::class);

///////////////////////////////Create Compter Users////////////////////////////////////////////////
Route::resource('/order',OrderController::class);
Route::get('/showValidatedOrders', [OrderController::class, 'showValidatedOrders'])->name('showValidatedOrders');
// Route::post('/validateOrder/{id}', [OrderController::class, 'validateOrder'])->name('validateOrder');
Route::post('/orders/{id}/validate', [OrderController::class, 'validateOrder'])->name('validateOrder');
Route::resource('HistoriqueOrder',HistoriqueOrderController::class);


Route::get('/order/show/{userId}', [OrderController::class, 'show'])->name('order.show');

// Route::get('/orders/user/{user_id}', [OrderController::class, 'showPurchasesByUser'])->name('order.userPurchases');

Route::get('/result-orders', [ResultOrderController::class, 'index'])->name('resultOrders.index');

////////////////////////////////////////////////Marketing//////////////////////////////////////////////////////
Route::get('/market-stats',[MarketController::class,'index'])->name('market-stats');
Route::get('/market-com',[MarketController::class,'indexCom'])->name('market-com');

////////////////////////////////////////////////Inventaire//////////////////////////////////////////////////////
Route::get('/inventaire/search', [InventtaireController::class, 'search'])->name('search_inventaire');
Route::resource('/inventaire',InventtaireController::class);
///////////////////////////////Statistiques////////////////////////////////////////////////
Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
Route::get('/statistics/refresh', [StatistiqueController::class, 'refresh']);

Route::get('/api/monthly-stats', [StatistiqueController::class, 'getMonthlyStats'])->name('api.monthly-stats');
Route::get('/api/inventory-stats', [StatistiqueController::class, 'getInventoryStats'])->name('api.inventory-stats');



