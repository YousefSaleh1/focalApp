<?php

use App\Http\Controllers\API\AnswerController;
use App\Http\Controllers\API\UserinfoController;
use App\Http\Controllers\API\FreelancerController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\BusinessOwnerController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\ComplainController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\JobSeekerController;
use App\Http\Controllers\API\ProcesseController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\ResumeController;
use App\Http\Controllers\API\SocialiteController;
use App\Http\Controllers\API\FilteringController;
use App\Http\Controllers\API\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

Route::middleware('auth:sanctum')->group(function () {


    Route::get('/Wallet/{userid}', [WalletController::class, 'show']);
    Route::post('/Wallet/AddToWallet/{walletid}', [ProcesseController::class, 'AddToCredit']);
    Route::post('/Wallet/WithdrawFromWallet/{walletid}', [ProcesseController::class, 'WithdrawFromCredit']);
    Route::post('/Wallet/PayToFreelancer/{userid}/', [WalletController::class, 'PayToFreelancer']);
    Route::post('/Wallet/store/{userid}', [WalletController::class, 'store']);


    Route::get('user_info', [UserinfoController::class , 'index']);
    Route::get('user_info/{id}', [UserinfoController::class , 'show']);
    Route::post('user_info', [UserinfoController::class , 'store']);
    Route::post('user_info/{id}', [UserinfoController::class , 'update']);
    Route::delete('user_info/{id}', [UserinfoController::class , 'destroy']);

    Route::get('/ShowJobQandA/{jop_id}', [AnswerController::class, 'ShowJobQandA']);
    Route::post('/storeAnswer/{question_id}', [AnswerController::class, 'storeAnswer']);
    Route::get('/showAnswer/{question_id}', [AnswerController::class, 'showAnswer']);

    Route::apiResource('/questions', QuestionController::class);
    Route::get('/get_job_question/{company_job_id}', [QuestionController::class,'get_questions_for_job']);



    Route::apiResource('/freelancer', FreelancerController::class);

    Route::get('/blogs' , [BlogController::class , 'index']);
    Route::get('/blogs/{status}', [BlogController::class, 'get_status']);
    Route::get('/MyBlogs' , [BlogController::class , 'MyBlogs']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::get('/blogs/{blog}', [BlogController::class, 'show']);
    Route::post('/blogs/{id}', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);

    Route::resource('jobs',JobController::class);
    Route::get('activ_jobs ',[JobController::class,'get_active_jops']);
    Route::get('closed_jobs ',[JobController::class,'get_closed_jops']);
    Route::get('wating_jobs ',[JobController::class,'get_wating_jops']);
    Route::get('visitorJob/{id} ',[JobController::class,'visitor']);


    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // this route must be apiResource and his controller the current controller is resource --we need apiResource  controller
    Route::resource('jobseeker', JobSeekerController::class);


    Route::apiResource('businessOwners', BusinessOwnerController::class);

    //jwdad
    Route::apiResource('city', CityController::class);
    Route::apiResource('Resume', ResumeController::class);


    Route::get('/complains' , [ComplainController::class , 'index']);
    Route::get('/complains/{complain}' , [ComplainController::class , 'show']);
    Route::post('/complains' , [ComplainController::class , 'store']);
    Route::delete('/complains/{complain}' , [ComplainController::class , 'destroy']);
});
Route::post('/filtter_employ',[FilteringController::class,'filtere']);
Route::post('/filtter_job',[FilteringController::class,'filterj']);


// Route::resource('roles', RoleController::class);
