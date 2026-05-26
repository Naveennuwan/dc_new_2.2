<?php
use App\Http\Controllers\AlergyController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DrugFrequencyController;
use App\Http\Controllers\LaboratoryExpenseController;
use App\Http\Controllers\OrthodonticPlanController;
use App\Http\Controllers\OtherPaymentController;
use App\Http\Controllers\PatientTypeController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TemplateTypesController;
use App\Http\Controllers\TemplateCategoryController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PatientNextVisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SmsController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\PatientController;

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\MedicalController;

use App\Http\Controllers\TemplateController;

use App\Http\Controllers\ReciptController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

// cache clear
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('optimize');
    return '<h1>Cache Cleared</h1>';
});

// Enable Maintenance Mode
Route::get('/down', function () {
    Artisan::call('down', [
        '--render' => 'maintenance', // your blade file
    ]);

    return '<h1>Application is now in Maintenance Mode</h1>';
});

// Disable Maintenance Mode
Route::get('/up', function () {
    Artisan::call('up');

    return '<h1>Application is Live Now</h1>';
});

Route::get('/', [DashBoardController::class, 'index'])->middleware(['auth']);
Route::get('/dashboard', [DashBoardController::class, 'index'])->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Masters
    Route::resource('/alergy', AlergyController::class);
    Route::post('/search-alergy', [AlergyController::class, 'search'])->name('alergy.search');
    Route::post('/export-alergy', [AlergyController::class, 'export'])->name('alergy.export');
    
    Route::resource('/brand', BrandController::class);
    Route::post('/search-brand', [BrandController::class, 'search'])->name('brand.search');
    Route::post('/export-brand', [BrandController::class, 'export'])->name('brand.export');
    
    Route::resource('/category', CategoryController::class);
    Route::match(['get', 'post'], '/search-category', [CategoryController::class, 'search'])->name('category.search');
    Route::post('/export-category', [CategoryController::class, 'export'])->name('category.export');
    
    Route::resource('/center', CenterController::class);
    Route::match(['get', 'post'], '/search-center', [CenterController::class, 'search'])->name('center.search');
    Route::post('/export-center', [CenterController::class, 'export'])->name('center.export');
    
    Route::resource('/disease', DiseaseController::class);
    Route::match(['get', 'post'], '/search-disease', [DiseaseController::class, 'search'])->name('disease.search');
    Route::post('/export-disease', [DiseaseController::class, 'export'])->name('disease.export');
    
    Route::resource('/doctor', DoctorController::class);
    Route::match(['get', 'post'], '/search-doctor', [DoctorController::class, 'search'])->name('doctor.search');
    Route::post('/export-doctor', [DoctorController::class, 'export'])->name('doctor.export');
    
    Route::resource('/drug-frequency', DrugFrequencyController::class);
    Route::match(['get', 'post'], '/search-drug-frequency', [DrugFrequencyController::class, 'search'])->name('drug-frequency.search');
    Route::post('/export-drug-frequency', [DrugFrequencyController::class, 'export'])->name('drug-frequency.export');
    
    Route::resource('/laboratory-expense', LaboratoryExpenseController::class);
    Route::match(['get', 'post'], '/search-laboratory-expense', [LaboratoryExpenseController::class, 'search'])->name('laboratory-expense.search');
    Route::post('/export-laboratory-expense', [LaboratoryExpenseController::class, 'export'])->name('laboratory-expense.export');
    
    Route::resource('/orthodontic-plan', OrthodonticPlanController::class);
    Route::match(['get', 'post'], '/search-orthodontic-plan', [OrthodonticPlanController::class, 'search'])->name('orthodontic-plan.search');
    Route::post('/export-orthodontic-plan', [OrthodonticPlanController::class, 'export'])->name('orthodontic-plan.export');
    
    Route::resource('/patient-type', PatientTypeController::class);
    Route::match(['get', 'post'], '/search-patient-type', [PatientTypeController::class, 'search'])->name('patient-type.search');
    Route::post('/export-patient-type', [PatientTypeController::class, 'export'])->name('patient-type.export');
    
    Route::resource('/product-type', ProductTypeController::class);
    Route::match(['get', 'post'], '/search-product-type', [ProductTypeController::class, 'search'])->name('product-type.search');
    Route::post('/export-product-type', [ProductTypeController::class, 'export'])->name('product-type.export');
    
    Route::resource('/supplier', SupplierController::class);
    Route::match(['get', 'post'], '/search-supplier', [SupplierController::class, 'search'])->name('supplier.search');
    Route::post('/export-supplier', [SupplierController::class, 'export'])->name('supplier.export');
    
    Route::resource('/template-type', TemplateTypesController::class);
    Route::match(['get', 'post'], '/search-template-type', [TemplateTypesController::class, 'search'])->name('template-type.search');
    Route::post('/export-template-type', [TemplateTypesController::class, 'export'])->name('template-type.export');
    
    Route::resource('/template-category', TemplateCategoryController::class);
    Route::match(['get', 'post'], '/search-template-category', [TemplateCategoryController::class, 'search'])->name('template-category.search');
    Route::post('/export-template-category', [TemplateCategoryController::class, 'export'])->name('template-category.export');
    
    Route::resource('/leave-request', LeaveRequestController::class);
    Route::match(['get', 'post'], '/search-leave-request', [LeaveRequestController::class, 'search'])->name('leave-request.search');
    Route::post('/export-leave-request', [LeaveRequestController::class, 'export'])->name('leave-request.export');

    // product & inventory

    Route::resource('/product', ProductController::class);
    Route::post('/search-product', [ProductController::class, 'search'])->name('product.search');
    Route::post('/export-product', [ProductController::class, 'export'])->name('product.export');

    // Patient Management

    Route::resource('/patient', PatientController::class);
    Route::match(['get', 'post'], '/search-patient', [PatientController::class, 'search'])->name('patient.search');
    Route::post('/export-patient', [PatientController::class, 'export'])->name('patient.export');
    Route::post('/image-patient', [PatientController::class, 'imageUpload'])->name('patient.image');
    Route::delete('/images/delete/{id}', [PatientController::class, 'imagedestroy'])->name('image.delete');

    // Report Management

    Route::resource('/leave', LeaveController::class);
    Route::match(['get', 'post'], '/search-leave', [LeaveController::class, 'search'])->name('leave.search');
    Route::post('/export-leave', [LeaveController::class, 'export'])->name('leave.export');
    Route::get('/leave-report/{patient_id}', [LeaveController::class, 'report'])->name('leave.report');

    Route::resource('/medical', MedicalController::class);
    Route::match(['get', 'post'], '/search-medical', [MedicalController::class, 'search'])->name('medical.search');
    Route::post('/export-medical', [MedicalController::class, 'export'])->name('medical.export');
    Route::get('/medical-report/{patient_id}', [MedicalController::class, 'report'])->name('medical.report');
    
    // Template Management
    Route::resource('/template', TemplateController::class);
    Route::match(['get', 'post'], '/search-template', [TemplateController::class, 'search'])->name('template.search');
    Route::post('/export-template', [TemplateController::class, 'export'])->name('template.export');

    Route::resource('/other-payment', OtherPaymentController::class);
    Route::match(['get', 'post'], '/search-other-payment', [OtherPaymentController::class, 'search'])->name('other-payment.search');
    Route::post('/export-other-payment', [OtherPaymentController::class, 'export'])->name('other-payment.export');

    Route::resource('/next-visit', PatientNextVisitController::class);
    Route::match(['get', 'post'], '/search-next-visit', [PatientNextVisitController::class, 'search'])->name('next-visit.search');
    Route::post('/export-next-visit', [PatientNextVisitController::class, 'export'])->name('next-visit.export');
    
    Route::get('/routine-invoice', [DashBoardController::class, 'routine'])->name('invoice.routine');
    Route::get('/orthodontic-invoice', [DashBoardController::class, 'orthodontic'])->name('invoice.orthodontic');
    Route::get('/invoice/{templateId}/{patientId}/{doctorId}/{payment}', [DashBoardController::class, 'addTreatementTemp'])->name('invoice.addTreatementTemp');
    Route::get('/invoice/{patient_id}/{doctor_id?}', [DashBoardController::class, 'invoice'])->name('invoice');
    Route::delete('/invoice/{templateId}', [DashBoardController::class, 'destroy'])->name('invoice.destroy');
    // Route::post('/invoice/pay-full', [DashBoardController::class, 'payFull']) ->name('invoice.pay-full');
    Route::post('/invoice/pay-custom', [DashBoardController::class, 'payCustom']) ->name('invoice.pay-custom');
    Route::get('/invoice-drug/{templateId}/{patientId}/{doctorId}/{action}', [DashBoardController::class, 'addDrugTemp'])->name('invoice.addDrugTemp');
    Route::get('/invoice-settle/{patientId}', [DashBoardController::class, 'settle'])->name('invoice.settle');

    Route::get('/drug-invoice/{id}', [ReciptController::class, 'DrugRecipt']);
    Route::get('/treatement-invoice/{id}', [ReciptController::class, 'TreatementInvoice']);
    Route::get('/treatement-drug-invoice/{id}', [ReciptController::class, 'TreatementDrugRecipt']);
    
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('reports/doctor', [ReportController::class, 'doctor'])->name('reports.doctor');
    Route::get('reports/treatment', [ReportController::class, 'treatment'])->name('reports.treatment');
    Route::get('reports/center', [ReportController::class, 'center'])->name('reports.center');
    Route::get('reports/outstanding', [ReportController::class, 'outstanding'])->name('reports.outstanding');

    Route::get('/sms/{patientId}', [SmsController::class, 'sendSmsById'])->name('sms.sendSmsById');
    Route::get('/image-sms/{patientId}/{imageId}', [SmsController::class, 'sendImageByIDSms'])->name('sms.sendImageByIDSms');
    Route::get('/bulk-image-sms/{patientId}', [SmsController::class, 'sendBulkSms'])->name('sms.sendBulkSms');
    
});

require __DIR__.'/auth.php';
