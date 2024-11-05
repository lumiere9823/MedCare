<?php

// Authentication routes
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\DrugSupplierController;
use App\Http\Controllers\HealthcareProviderController;
use App\Http\Controllers\HealthAtoZController;
use App\Http\Controllers\HealthCalculatorController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicationController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard routes for each role
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('administrator.dashboard');
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/guest/dashboard', [GuestController::class, 'index'])->name('guest.index');
    Route::get('/insurance/dashboard', [InsuranceController::class, 'dashboard'])->name('insurance.dashboard');
    Route::get('/drug-supplier/dashboard', [DrugSupplierController::class, 'dashboard'])->name('drug_supplier.dashboard');
    Route::get('/healthcare/dashboard', [HealthcareProviderController::class, 'dashboard'])->name('healthcare.dashboard');
    
});

Route::prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('dashboard'); // Dashboard
    Route::get('/health-info', [PatientController::class, 'viewHealthInfo'])->name('viewHealthInfo');
    Route::get('/book-appointment', [PatientController::class, 'showBookingForm'])->name('bookAppointment');
    Route::post('/book-appointment', [PatientController::class, 'bookAppointment'])->name('storeAppointment');
    Route::get('/submit-feedback', [PatientController::class, 'showFeedbackForm'])->name('submitFeedback');
    Route::post('/submit-feedback', [PatientController::class, 'submitFeedback'])->name('storeFeedback');
    Route::get('/book-appointment/{doctorId}/slots', [PatientController::class, 'getAvailableSlots'])->name('slots');
});

Route::get('/appointments/schedule', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'patient') {
            return app(PatientController::class)->showSchedule();
        } elseif (Auth::user()->role === 'doctor') {
            return app(DoctorController::class)->showDoctorSchedule();
        }
    }

    return redirect()->route('home');
})->name('appointments.schedule');
Route::get('/doctor/schedule/monthly', [DoctorController::class, 'showDoctorScheduleMonthly'])->name('doctor.schedule.monthly');
Route::get('/doctor/schedule/year', [DoctorController::class, 'showDoctorScheduleYear'])->name('doctor.schedule.year');

Route::patch('/appointments/{appointment}/status', [DoctorController::class, 'updateStatus'])->name('appointments.updateStatus');
Route::get('/appointments/{appointment}/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/appointments/{appointment}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/health-a-z', [HealthAtoZController::class, 'index'])->name('healthAtoZ.index');

// Health calculator routes
Route::get('/health-calculator', [HealthCalculatorController::class, 'index'])->name('healthCalculator.index');
Route::post('/health-calculator/calculate', [HealthCalculatorController::class, 'calculateBMI'])->name('healthCalculator.calculate');

// Doctor consultation routes
Route::get('/find-doctor', [DoctorController::class, 'find'])->name('doctor.find');
Route::post('/book-appointment', [DoctorController::class, 'bookAppointment'])->name('doctor.bookAppointment');

// Insurance routes
Route::get('/insurance-plans', [InsuranceController::class, 'viewPlans'])->name('insurance.plans');
Route::post('/purchase-insurance', [InsuranceController::class, 'purchaseInsurance'])->name('insurance.purchase');

// Drug routes
Route::get('/drugs', [DrugController::class, 'index'])->name('drugs.index');
Route::post('/order-drug', [DrugController::class, 'order'])->name('drugs.order');

// Feedback routes
Route::post('/submit-feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');

// Admin routes
Route::middleware(['auth'])->group(function () {
        Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
        Route::get('/admin/manage-users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
        Route::put('/admin/manage-users/{user}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::get('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.createUser');
        Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.storeUser');
        Route::get('/admin/manage-health-data', [AdminController::class, 'manageHealthData'])->name('admin.manageHealthData');
        Route::resource('medications', MedicationController::class)->except(['create', 'store', 'show','view']);
        Route::get('/medications/create', [MedicationController::class, 'create'])->name('medications.create');
        Route::post('/medications', [MedicationController::class, 'store'])->name('medications.store');
    Route::get('/medications/view', [MedicationController::class, 'view'])->name('medications.view');
});

// Payment routes
Route::post('/make-payment', [PaymentController::class, 'makePayment'])->name('payment.make');
Route::post('/insurance-reimbursement', [PaymentController::class, 'insuranceReimbursement'])->name('payment.insuranceReimbursement');


require __DIR__.'/auth.php';