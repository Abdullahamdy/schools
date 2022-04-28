<?php

use App\Http\Controllers\Section\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Auth::routes();

Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function () {
        return view('auth.login');
    });

});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){
        // Route::get('/', function () {
        //     return view('dashboard');
        // });
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');


        Route::group(['namespace'=>'Grade'],function(){
            Route::resource('Grades', 'GradeController');
        });
        Route::group(['namespace'=>'classrooms'],function(){
            Route::resource('Classrooms', 'ClassroomController');
            Route::post('deleteAll', 'classroomcontroller@delete_all')->name('delete_all');
            Route::post('Filter_Class', 'classroomcontroller@FilterClass')->name('Filter_Class');
        });
        Route::group(['namespace'=>'Section'],function(){
            Route::resource('Sections', 'sectionController');
            Route::get('classes/{tt}','SectionController@getclass');
        });
Route::view('add_parent', 'livewire.show-form');


    Route::group(['namespace'=>'Teachers'],function(){
        Route::resource('Teachers', 'TeacherController');

    });

Route::group(['namespace'=>'Students'],function(){



    Route::resource('students', 'studentController');
    Route::resource('Graduated', 'GraduatedController');
    Route::resource('Fees_invoices', 'FeeInvoicesController');
    Route::resource('Fees', 'FeesController');
    Route::get('/Get_classrooms/{id}','studentController@Get_Classrooms');
    Route::get('/Get_Sections/{id}','studentController@Get_Sections');
    Route::get('Upload_attachment','studentController@uploadFile');
    Route::post('Upload_attachment','studentController@upload_attachment')->name('Upload_attachment');
    Route::get('Download_attachment/{studentname}/{filename}','studentController@Download_attachment')->name('Download_attachment');
    Route::post('Delete_attachment','studentController@Delete_attachment')->name('Delete_attachment');


});
Route::group(['namespace'=>'students'],function(){
Route::resource('Promotion', 'PromotionController');

});

});



