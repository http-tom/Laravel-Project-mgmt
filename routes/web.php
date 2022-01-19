<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;

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


Route::get('/', function () {
	if(Auth::check())
	{
		return redirect('/admin/tasks');
	}
	else {
		return redirect('/login') ;
	}
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){


	// ===================== PROJECTS ======================
	Route::get('/projects', [ProjectController::class,'index'])->name('project.show') ;

	Route::get('/projects/create', [ProjectController::class,'create'])->name('project.create') ;

	Route::get('/projects/edit/{id}', [ProjectController::class,'edit'])->name('project.edit') ;

	Route::post('/projects/update/{id}', [ProjectController::class,'update'])->name('project.update') ;

	Route::get('/projects/delete/{id}', [ProjectController::class,'destroy'])->name('project.delete') ;

	// Store the new project from the form posted with the view Above
	Route::post('/projects/store', [ProjectController::class,'store'])->name('project.store');
	Route::get('/projects/download/{type}',[ProjectController::class,'download'])->name('project.download');



	// ====================  TASKS =======================
	Route::get('/tasks',[TaskController::class,'index'])->name('task.show') ;

	Route::get('/tasks/view/{id}',[TaskController::class,'view'])->name('task.view') ;

	// Display the Create Task View form
	Route::get('/tasks/create', [TaskController::class,'create'])->name('task.create'); 

	// Store the new task from the form posted with the view Above
	Route::post('/tasks/store', [TaskController::class,'store'])->name('task.store');

	// Search view
	Route::get('/tasks/search', [TaskController::class,'searchTask'])->name('task.search');

	// Sort Table
	Route::get('/tasks/sort/{key}/{dir?}', [TaskController::class,'sort'])->name('task.sort') ;

	Route::get('/tasks/edit/{id}',[TaskController::class,'edit'])->name('task.edit');

	// Route::get('/tasks/edit/{id}', function () {	
	// 	'uses' => [TaskController::class,'edit'],
	// 	'as'  => 'task.edit'
	// });

	Route::get('/tasks/list/{projectid}',[TaskController::class,'tasklist'])->name('task.list');
	Route::get('/tasks/delete/{id}', [TaskController::class,'destroy'])->name('task.delete') ;
	Route::get('/tasks/deletefile/{id}', [TaskController::class,'deleteFile'])->name('task.deletefile') ;
	Route::post('/tasks/update/{id}', [TaskController::class,'update'])->name('task.update') ;
	Route::get('/tasks/completed/{id}',[TaskController::class,'completed'])->name('task.completed');
	Route::get('/tasks/download/{type}',[TaskController::class,'download'])->name('task.download');

	// =====================  USERS   ============================
	Route::get('/users', [UserController::class,'index'])->name('user.index'); 
	Route::get('/users/list/{id}',[UserController::class,'userTaskList'])->name('user.list');
	Route::get('/users/create', [UserController::class,'create'])->name('user.create'); 
    Route::post('/users/store', [UserController::class,'store'])->name('user.store'); 
	Route::get('/users/edit/{id}', [UserController::class,'edit'])->name('user.edit'); 
	Route::post('/users/update/{id}', [UserController::class,'update'])->name('user.update') ;
    Route::get('/users/activate/{id}', [UserController::class,'activate'])->name('user.activate') ; 
    Route::get('/users/delete/{id}', [UserController::class,'destroy'])->name('user.delete') ;
    Route::get('/users/disable/{id}', [UserController::class,'disable'])->name('user.disable') ;

	Route::get('/about', [PageController::class,'about'])->name('about');


});
