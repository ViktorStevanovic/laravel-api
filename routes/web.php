<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/projects/deleted', [AdminProjectController::class, 'deletedProjects'])->name('projects.deleted');
        Route::patch('/projects/restore/{project}', [AdminProjectController::class, 'restoreProject'])->name('projects.restore');
        Route::delete('/projects/deleted/{project}', [AdminProjectController::class, 'destroyProject'])->name('projects.deleted.destroy');

        Route::get('/technologies/deleted', [AdminTechnologyController::class, 'deletedProjects'])->name('technologies.deleted');
        Route::patch('/technologies/restore/{technology}', [AdminTechnologyController::class, 'restoreTechnology'])->name('technologies.restore');
        Route::delete('/technologies/deleted/{technology}', [AdminTechnologyController::class, 'destroyTechnology'])->name('technologies.deleted.destroy');

        Route::resource('/projects', AdminProjectController::class);
        Route::resource('/technologies', AdminTechnologyController::class);
    });
