<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClientPaymentsController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProjectPersonnelController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProjectMaterialsController;
use App\Http\Controllers\MaterialPurchasesController;
use App\Http\Controllers\EquipmentAssignmentsController;
use App\Http\Controllers\LaborerWagesController;
use App\Http\Controllers\PersonnelSalariesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;


Route::get('/clients', [ClientsController::class, 'index']);
Route::post('/clients', [ClientsController::class, 'store']);
Route::get('/client-payments', [ClientPaymentsController::class, 'index']);
Route::post('/client-payments', [ClientPaymentsController::class, 'store']);
Route::get('/equipment', [EquipmentController::class, 'index']);
Route::post('/equipment', [EquipmentController::class, 'store']);
Route::get('/projects', [ProjectsController::class, 'index']);
Route::post('/projects', [ProjectsController::class, 'store']);
Route::get('/personnel', [PersonnelController::class, 'index']);
Route::post('/personnel', [PersonnelController::class, 'store']);
Route::get('/project-personnel', [ProjectPersonnelController::class, 'index']);
Route::post('/project-personnel', [ProjectPersonnelController::class, 'store']);
Route::get('/suppliers', [SuppliersController::class, 'index']);
Route::post('/suppliers', [SuppliersController::class, 'store']);
Route::get('/materials', [MaterialsController::class, 'index']);
Route::post('/materials', [MaterialsController::class, 'store']);
Route::get('/project-materials', [ProjectMaterialsController::class, 'index']);
Route::post('/project-materials', [ProjectMaterialsController::class, 'store']);
Route::get('/material-purchases', [MaterialPurchasesController::class, 'index']);
Route::post('/material-purchases', [MaterialPurchasesController::class, 'store']);
Route::get('/equipment-assignments', [EquipmentAssignmentsController::class, 'index']);
Route::post('/equipment-assignments', [EquipmentAssignmentsController::class, 'store']);
Route::get('/laborer-wages', [LaborerWagesController::class, 'index']);
Route::post('/laborer-wages', [LaborerWagesController::class, 'store']);
Route::get('/personnel-salaries', [PersonnelSalariesController::class, 'index']);
Route::post('/personnel-salaries', [PersonnelSalariesController::class, 'store']);
Route::get('/roles', [RolesController::class, 'index']);
Route::post('/roles', [RolesController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);



Route::get('/reports/materials-availability', [ReportController::class, 'materialsAvailability']);
Route::get('/reports/client-payments', [ReportController::class, 'clientPaymentsReport']);
Route::get('/reports/equipment-earnings', [ReportController::class, 'equipmentEarningsReport']);
Route::get('/reports/project-materials-used', [ReportController::class, 'projectMaterialsUsedReport']);
Route::get('/reports/personnel-salaries', [ReportController::class, 'personnelSalariesReport']);
Route::get('/reports/unpaid-material-purchases', [ReportController::class, 'unpaidMaterialPurchasesReport']);
Route::get('/reports/total-material-cost', [ReportController::class, 'totalMaterialCostReport']);
Route::get('/reports/total-rental-income', [ReportController::class, 'totalRentalIncomeReport']);
Route::get('/reports/total-quantity-bought', [ReportController::class, 'totalQuantityBoughtReport']);
Route::get('/reports/total-quantity-used', [ReportController::class, 'totalQuantityUsedReport']);
Route::get('/reports/net-earnings', [ReportController::class, 'netEarningsReport']);
Route::get('/reports/total-salaries-paid', [ReportController::class, 'totalSalariesPaidReport']);
Route::get('/reports/total-wages-paid', [ReportController::class, 'totalWagesPaidReport']);
Route::get('/reports/laborer-wages-calculation', [ReportController::class, 'laborerWagesCalculationReport']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


