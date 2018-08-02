<?php

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


Route::get('/', function(){
	
	return view('auth.login');
});
/*Route::get('/frontend', function(){
	
	return view('frontend.index');
})->name('/frontend');*/

Route::get('/frontend', 'FrontendController@index')->name('/frontend');

Auth::routes();

// Route::post('register', 'Auth\RegisterController@register');
Route::group(['middleware' => 'auth'], function () {
	
Route::get('/backend', 'HomeController@index')->name('backend');

// role and permision routes 


Route::get('posts', 'PostController@index')->name('posts');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

/*Route::get("testemail",function(){
	
	return new \App\Mail\Welcome;
});*/
//activation 

//Route::get('user/activation/{token}', 'Auth\RegisterController@userActivation');

Route::get('confirmation/{verification_token}', 'Auth\RegisterController@confirmation');

/*Route::get('user/confirmation/{verification_token}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\RegisterController@confirmation'
]);*/


Route::get('/verifcation/{verification_token}', 'PeopleProfileController@verifcation'); 

Route::get('create-email-template', 'EmailTemplateController@emailTemplate')->name('create-email-template');



Route::get('email-template',array('as'=>'email-template.get','uses'=>'EmailTemplateController@template'));

Route::post('email-template',array('as'=>'email-tmeplate.post','uses'=>'EmailTemplateController@emailTemplateStore'));

Route::get('email-edit/{id}','EmailTemplateController@edit')->name('email-edit');

Route::get('email-view/{id}','EmailTemplateController@view')->name('email-view');


Route::get('email-del','EmailTemplateController@edit')->name('email-del');


Route::post('email-template-update/{id}',array('as'=>'email-template-update','uses'=>'EmailTemplateController@update'));


Route::get('template-assign', 'AsignTemplateController@templateAssign')->name('template-assign');


Route::get('asign-template', 'AsignTemplateController@asignTemplate')->name('asign-template');


Route::get('profile', 'ProfileController@profile')->name('profile');


Route::get('profile/update', 'ProfileController@updateProfile');

Route::get('re-active/{id}', 'UserController@active')->name('re-active');


Route::resource('categories', 'CategoriesController');

Route::get('search', 'PostController@search')->name('search');

Route::post('cmmnts/{id}', 'CommentsController@store')->name('cmmnts.store');

Route::resource('comments', 'CommentsController');

Route::post('comments/action', 'CommentsController@action')->name('comments.action');

Route::post('posts.action', 'PostController@action')->name('posts.action');

Route::resource('peoples', 'PeoplesController');

Route::get('ppl', 'PeoplesController@profile')->name('ppl.profile');



});

Route::get('redirectme', 'FileController@frontend')->name('redirectme');

Route::get('frontend-login', 'FileController@login')->name('frontend-login');
Route::get('frontend-signup', 'FileController@signup')->name('frontend-signup');

Route::get('frontend-logout', 'FileController@logout')->name('frontend-logout');


Route::post('frontend-user-login', 'FileController@frontendLogin')->name('frontend-user-login');

Route::post('frontend-register', 'FileController@register')->name('frontend-register');


Route::resource('petition', 'PetitionController');

Route::post('p.update/{id}', 'PetitionController@update')->name('p.update');


Route::get('petition-survey/{id}', 'PetitionController@survey')->name('petition-survey');

Route::post('survey', 'PetitionController@create')->name('survey-create');



Route::get('petEdit/{id}', 'PetitionController@petEdit')->name('petEdit');

Route::get('pet', 'PetitionController@pet')->name('pet');

Route::get('people.create', 'PeopleProfileController@create')->name('people.create');

Route::resource('sign', 'SignPetitionController');


Route::post('sign/{id}', 'SignPetitionController@create')->name('sign.create');

Route::post('frontendComments/{id}', 'CommentsController@comment')->name('frontendComments.comment');



Route::get('find', 'DecisionMakerController@find')->name('/find');

Route::post('publish/{petition}', 'PetitionController@publish')->name('publish');

Route::get('frontend-profile', 'PeopleProfileController@index')->name('frontend-profile');


Route::get('edit', 'PeopleProfileController@edit')->name('edit');


Route::post('frontend-profile-add', 'PeopleProfileController@store')->name('frontend-profile-add');


Route::post('frontend-profile-update/{user_id}', 'PeopleProfileController@update')->name('frontend-profile-update');

Route::get('frontend/about', 'PeopleProfileController@about')->name('frontend/about');

Route::get('frontend/contact', 'PeopleProfileController@contact')->name('frontend/contact');

Route::post('survey-result', 'SurveyController@result')->name('survey-result');


Route::get('browsePetition', 'PetitionController@browsePetition')->name('browsePetition');

Route::get('categoryView/{id}', 'PetitionController@categoryView')->name('categoryView');

Route::post('petition.image', 'DecisionMakerController@imageCrop')->name('petition.image');

Route::get('searchMe', 'PetitionController@searchMe')->name('searchMe');

Route::post('addDecisionMaker', 'DecisionMakerController@addDecisionMaker')->name('addDecisionMaker');


Route::get('decision', 'PetitionController@decision')->name('decision');