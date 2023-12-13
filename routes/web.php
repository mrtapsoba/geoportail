<?php

use App\Http\Controllers\CarteController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\CoucheController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FondDeCarteController;
use App\Http\Controllers\GeoportailController;
use App\Http\Controllers\MyAuthController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\shapefileController;
use App\Http\Controllers\ShpController;
use App\Http\Controllers\SousThematiqueController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThematiqueController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";
});

Route::get('/test', [TestController::class, 'index'])->name('test');

Route::get('/test2', [TestController::class, 'contrib'])->name('test2');



Route::get('/', [GeoportailController::class, 'index'])->name('geoportail');

Route::get('compte/', [Profile::class, 'index'])->name('clientProfile')->middleware('auth');

Route::get('compte/thematique/', [CoucheController::class, 'thematique'])->name('thematique')->middleware('auth');

Route::post('compte/thematique/', [ThematiqueController::class, 'postThematique'])->name('postthematique')->middleware('auth');

Route::get('compte/sousthematique/{id}', [CoucheController::class, 'sousthematique'])->name('sousthematique')->middleware('auth');

Route::post('compte/sousthematique/{id}', [SousThematiqueController::class, 'postSousThematique'])->name('postsousthematique')->middleware('auth');

Route::get('compte/couche/{thematik}/{sousthematik}', [CoucheController::class, 'couche'])->name('couche')->middleware('auth');

Route::post('compte/couche/{id}', [CoucheController::class, 'postCouche'])->name('postCouche')->middleware('auth');

Route::get('compte/fond-de-carte', [CoucheController::class, 'fonddecarte'])->name('fonddecarte')->middleware('auth');

Route::post('compte/fond-de-carte/add', [FondDeCarteController::class, 'postFondDeCarte'])->name('postFondDeCarte')->middleware('auth');

Route::get('compte/contribution', [ContributionController::class, 'index'])->name('contribution')->middleware('auth');

Route::get('compte/contribution/details/{id}', [ContributionController::class, 'details'])->name('contributiondetails')->middleware('auth');

Route::get('compte/demande', [DemandeController::class, 'index'])->name('demande')->middleware('auth');

Route::post('compte/demande/add', [DemandeController::class, 'postDemande'])->name('demandepost')->middleware('auth');

Route::post('compte/demande/response/add', [DemandeController::class, 'postDemandeReponse'])->name('demandereponsepost')->middleware('auth');

Route::get('compte/demande/details/{id}', [DemandeController::class, 'details'])->name('demandedetails')->middleware('auth');

/*-----------------------CLIENT---------------*/

Route::post('compte/client/contribution/delimitation', [ContributionController::class, 'postDelimit'])->name('postDelimit');

Route::get('compte/client/contribution/delimitation/{id}', [ContributionController::class, 'delimit'])->name('delimitation');

Route::get('compte/client/contribution', [ContributionController::class, 'indexClient'])->name('contributionClient')->middleware('auth');

Route::get('compte/client/contribution/couche', [ContributionController::class, 'coucheClient'])->name('contributionCoucheClient')->middleware('auth');

Route::get('compte/client/contribution/details/{id}', [ContributionController::class, 'detailsClient'])->name('contributiondetailsClient')->middleware('auth');

Route::get('compte/client/demande', [DemandeController::class, 'indexClient'])->name('demandeClient')->middleware('auth');

Route::post('compte/client/demande/add', [DemandeController::class, 'postDemande'])->name('demandepostClient')->middleware('auth');

Route::post('compte/client/demande/response/add', [DemandeController::class, 'postDemandeReponse'])->name('demandereponsepostClient')->middleware('auth');

Route::get('compte/client/demande/details/{id}', [DemandeController::class, 'detailsClient'])->name('demandedetailsClient')->middleware('auth');

Route::get('compte/client/cartes', [CarteController::class, 'index'])->name('mescartes')->middleware('auth');

Route::get('compte/client/cartes/details', [GeoportailController::class, 'index'])->name('cartedetails')->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*----------GET DATA GEOJSON-----------*/

Route::post('geoportail/getData/', [shapefileController::class, 'getShpData'])->name('getShpData');


/*-------For login using breeze ----------*/
//require __DIR__.'/auth.php';

/*-------for login custom -------*/

Route::get('dashboard', [MyAuthController::class, 'dashboard']);
Route::get('login', [MyAuthController::class, 'index'])->name('login');
Route::post('custom-login', [MyAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [MyAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [MyAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [MyAuthController::class, 'signOut'])->name('signout');
