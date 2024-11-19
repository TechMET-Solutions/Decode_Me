<?php

use App\Models\Query;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AIPortalController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\DMSessionController;
use App\Http\Controllers\SubCareerController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CareerClubController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\SchoolDetailController;
use App\Http\Controllers\UserQuestionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\StudentCareerOptionController;

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
    return view('auth.login');
});

Route::post('storecontact', [ContactController::class, 'storecontact'])->name('storecontact');
Route::get('/verify-otp', [EmailVerificationController::class, 'showVerifyOtpForm'])->name('verify.otp.form');
Route::post('/verify-otp', [EmailVerificationController::class, 'verifyOTP'])->name('verify.otp');
Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');
Route::get('forgotPassword/{email?}', [RegisterController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('verifyEmail', [RegisterController::class, 'verifyEmail'])->name('verifyEmail');
Route::post('emailVerifyOtp', [RegisterController::class, 'emailVerifyOtp'])->name('emailVerifyOtp');
Route::post('changePassword', [RegisterController::class, 'changePassword'])->name('changePassword');

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('studentreport', [HomeController::class, 'studentReport'])->name('studentreport');
    Route::get('workshop', [StudentController::class, 'workshop'])->name('workshop');
    Route::get('pastWorkshop/{id}', [StudentController::class, 'pastWorkshop'])->name('pastWorkshop');
    Route::get('expertNames/{id}', [StudentController::class, 'expertNames'])->name('expertNames');
    Route::get('expertDetails/{id}', [StudentController::class, 'expertDetails'])->name('expertDetails');
    Route::get('counselling', [StudentController::class, 'counselling'])->name('counselling');
    Route::post('bookSession', [StudentController::class, 'bookSession'])->name('bookSession');
    Route::get('counsellingOffline', [StudentController::class, 'counsellingOffline'])->name('counsellingOffline');
    Route::post('scheduleExpertCall', [StudentController::class, 'scheduleExpertCall'])->name('scheduleExpertCall');
    Route::get('sessionCompleted/{id}', [StudentController::class, 'sessionCompleted'])->name('sessionCompleted');

    Route::get('tasks', [StudentController::class, 'tasks'])->name('tasks');
    Route::get('taskPending', [StudentController::class, 'taskPending'])->name('taskPending');
    Route::get('taskOverdue', [StudentController::class, 'taskOverdue'])->name('taskOverdue');
    Route::get('taskResubmit', [StudentController::class, 'taskResubmit'])->name('taskResubmit');
    Route::get('taskIndivisualComplete', [StudentController::class, 'taskIndivisualComplete'])->name('taskIndivisualComplete');
    Route::get('taskIndivisualSubmitted', [StudentController::class, 'taskIndivisualSubmitted'])->name('taskIndivisualSubmitted');
    Route::get('taskStart/{id}', [StudentController::class, 'taskStart'])->name('taskStart');
    Route::get('groupTask/{id}', [StudentController::class, 'groupTask'])->name('groupTask');
    Route::post('submitTasks', [StudentController::class, 'submitTasks'])->name('submitTasks');
    Route::post('submitGroupTasks', [StudentController::class, 'submitGroupTasks'])->name('submitGroupTasks');
    Route::get('careerClubTask', [StudentController::class, 'careerClubTask'])->name('careerClubTask');
    Route::get('careerClubTaskPending', [StudentController::class, 'careerClubTaskPending'])->name('careerClubTaskPending');
    Route::get('careerClubTaskOverdue', [StudentController::class, 'careerClubTaskOverdue'])->name('careerClubTaskOverdue');
    Route::get('careerClubTaskResubmit', [StudentController::class, 'careerClubTaskResubmit'])->name('careerClubTaskResubmit');
    Route::get('taskGroupComplete', [StudentController::class, 'taskGroupComplete'])->name('taskGroupComplete');
    Route::get('taskGroupSubmitted', [StudentController::class, 'taskGroupSubmitted'])->name('taskGroupSubmitted');


    Route::post('scheduleIndividualTask', [StudentController::class, 'scheduleIndividualTask'])->name('scheduleIndividualTask');
    Route::post('scheduleGroupTask', [StudentController::class, 'scheduleGroupTask'])->name('scheduleGroupTask');

    Route::get('internship', [StudentController::class, 'internship'])->name('internship');
    Route::get('internshipApply/{id}', [StudentController::class, 'internshipApply'])->name('internshipApply');
    Route::get('internshipTakeaway', [StudentController::class, 'internshipTakeaway'])->name('internshipTakeaway');
    Route::post('submitTakeaway', [StudentController::class, 'submitTakeaway'])->name('submitTakeaway');
    Route::get('careerOption', [StudentController::class, 'careerClub'])->name('careerClub');
    Route::get('careerOptionRank', [StudentController::class, 'careerClubRank'])->name('careerClubRank');
    Route::get('careerClub', [StudentController::class, 'careerGoal'])->name('careerGoal');
    Route::get('careerClubmom/{id}', [StudentController::class, 'careerClubMom'])->name('careermom');
    Route::post('storecareerClubmom', [StudentController::class, 'storecareerClubMom'])->name('storecareermom');
    Route::get('viewMom/{id}', [StudentController::class, 'viewMom'])->name('viewMom');
    Route::get('aiPortal', [StudentController::class, 'aiPortal'])->name('aiPortal');
    Route::get('careerOptions/{id}', [StudentController::class, 'careerOptions'])->name('careerOptions');

    Route::get('writeTakeaway/{id}', [StudentController::class, 'writeTakeaway'])->name('writeTakeaway');
    Route::post('takeaway', [StudentController::class, 'takeaway'])->name('takeaway');
    Route::get('myProfile', [StudentController::class, 'myProfile'])->name('myProfile');
    Route::get('editStudent/{id}', [StudentController::class, 'editStudent'])->name('editStudent');
    Route::post('update_student', [StudentController::class, 'updateStudent'])->name('user.updatestudent');
    Route::get('completeProfile', [StudentController::class, 'completeProfile'])->name('completeProfile');
    Route::post('completeProfileData', [StudentController::class, 'completeProfileData'])->name('completeProfileData');
    Route::post('getCustomerProfile', [StudentController::class, 'getCustomerProfile'])->name('getCustomerProfile');

    Route::get('progressVideo', [StudentController::class, 'progressVideo'])->name('progressVideo');
    Route::get('uploadVideo', [StudentController::class, 'uploadVideo'])->name('uploadVideo');
    Route::post('uploadVideo', [StudentController::class, 'uploadVideoFile'])->name('uploadVideoFile');

    Route::post('feedBack', [StudentController::class, 'feedBack'])->name('feedBack');
    Route::post('markAsRead', [StudentController::class, 'markAsRead'])->name('markAsRead');
});

Route::middleware('is_admin')->prefix('admin')->group(function () {
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('analyticsPDF', [HomeController::class, 'analyticsPDF'])->name('analyticspdf');
    //Students Detail
    Route::get('add_student', [StudentDetailController::class, 'addStudent'])->name('admin.addstudent');
    Route::post('store_student', [StudentDetailController::class, 'storestudent'])->name('admin.storestudent');
    Route::get('edit_student/{id}', [StudentDetailController::class, 'editStudent'])->name('admin.editstudent');
    Route::post('update_student', [StudentDetailController::class, 'updateStudent'])->name('admin.updatestudent');
    Route::get('student_list/{latest?}', [StudentDetailController::class, 'studentList'])->name('admin.studentlist');
    Route::get('show_student/{id}', [StudentDetailController::class, 'showStudent'])->name('admin.showstudent');
    //Add expert in student list
    Route::post('store_expert_in_student', [StudentDetailController::class, 'storeExpertInStudent'])->name('admin.storeexpert_instudent');

    Route::post('importExcel', [StudentDetailController::class, 'importExcel'])->name('importExcel');
    Route::get('/generateStudentPDF', [StudentDetailController::class, 'studentListPDF'])->name('generateStudentPDF');

    Route::get('studentreportcard/{id}', [StudentDetailController::class, 'studentReport'])->name('studentreportcard');
    Route::get('studtaskreport/{id}', [StudentDetailController::class, 'studtaskReport'])->name('studtaskreport');



    //Add Schools Detail
    Route::get('add_school', [SchoolDetailController::class, 'addSchool'])->name('admin.addschool');
    Route::post('store_school', [SchoolDetailController::class, 'storeSchool'])->name('admin.storeschool');
    Route::get('edit_school/{id}', [SchoolDetailController::class, 'editSchool'])->name('admin.editschool');
    Route::post('update_school/{id}', [SchoolDetailController::class, 'updateSchool'])->name('admin.updateschool');
    Route::get('school_list', [SchoolDetailController::class, 'schoolList'])->name('admin.schoollist');
    Route::get('school_status/{id}', [SchoolDetailController::class, 'status'])->name('admin.schoolstatus');
    Route::get('school_delete/{id}', [SchoolDetailController::class, 'delete'])->name('admin.schooldelete');
    Route::get('/generateSchoolPDF', [SchoolDetailController::class, 'schoolsListPDF'])->name('generateSchoolPDF');
    Route::get('progress-video', [SchoolDetailController::class, 'video'])->name('admin.progressVideo');
    Route::post('progress-video-confirmation', [SchoolDetailController::class, 'videoConfirm'])->name('videoConfirmation');


    //Workshop Details
    Route::get('workshop_list', [WorkshopController::class, 'index'])->name('admin.workshop');
    Route::get('add_workshop', [WorkshopController::class, 'addWorkshop'])->name('admin.addworkshop');
    Route::post('store_workshop', [WorkshopController::class, 'storeWorkshop'])->name('admin.storeworkshop');
    Route::get('edit_workshop/{id}', [WorkshopController::class, 'edit'])->name('admin.editworkshop');
    Route::post('update_workshop/{id}', [WorkshopController::class, 'update'])->name('admin.updateworkshop');
    Route::get('delete_workshop/{id}', [WorkshopController::class, 'delete'])->name('admin.deleteworkshop');

    //Student Career Option Details
    Route::get('studentcareeroptions/{id?}', [StudentCareerOptionController::class, 'index'])->name('admin.studentcareeroptions');
    Route::post('/store_studentcareeroptions', [StudentCareerOptionController::class, 'store'])->name('admin.storestudentcareeroptions');
    // Route::get('/eliminatecareerop', [StudentCareerOptionController::class, 'eliminateCareer'])->name('admin.eliminatecareer');
    Route::get('/scohistory/{id}', [StudentCareerOptionController::class, 'scohistory'])->name('admin.scohistory');
    Route::get('/generateStudentCareerRankPDF/{id}/{sid}', [StudentCareerOptionController::class, 'studentCareerRankPDF'])->name('generateStudentCareerRankPDF');


    //Expert Details
    Route::get('expert_list', [ExpertController::class, 'index'])->name('admin.expert');
    Route::get('add_expert', [ExpertController::class, 'addExpert'])->name('admin.addexpert');
    Route::post('store_expert', [ExpertController::class, 'storeExpert'])->name('admin.storeexpert');
    Route::get('edit_expert/{id}', [ExpertController::class, 'edit'])->name('admin.editexpert');
    Route::post('update_expert/{id}', [ExpertController::class, 'update'])->name('admin.updateexpert');
    Route::get('delete_expert/{id}', [ExpertController::class, 'delete'])->name('admin.deleteexpert');
    Route::get('/generateExpertPDF', [ExpertController::class, 'expertListPDF'])->name('generateExpertPDF');
    //Task Details
    Route::get('previousTaskList', [TaskController::class, 'previousTaskList'])->name('admin.previousTaskList');
    Route::get('taskList', [TaskController::class, 'index'])->name('admin.taskList');
    Route::post('storeTask', [TaskController::class, 'store'])->name('admin.storeTask');
    Route::post('updateTask', [TaskController::class, 'update'])->name('admin.updateTask');
    Route::post('storeIndividualTask', [TaskController::class, 'storeIndividualTask'])->name('admin.storeIndividualTask');
    Route::post('storeGroupTask', [TaskController::class, 'storeGroupTask'])->name('admin.storeGroupTask');
    Route::get('taskDelete/{id}', [TaskController::class, 'delete'])->name('admin.taskDelete');
    Route::post('taskApproval', [TaskController::class, 'taskApproval'])->name('taskApproval');
    Route::post('taskGroupApproval', [TaskController::class, 'taskGroupApproval'])->name('taskGroupApproval');
    Route::get('taskreport', [TaskController::class, 'taskReport'])->name('taskreport');



    //DM Session routes
    Route::get('dmsessionlist', [DMSessionController::class, 'dmlist'])->name('admin.dmsessionlist');
    Route::get('dmsession', [DMSessionController::class, 'index'])->name('admin.dmsession');
    Route::get('todaysdmsession', [DMSessionController::class, 'todaysdms'])->name('admin.todaysdmsession');
    Route::get('adddmsession', [DMSessionController::class, 'create'])->name('admin.adddmsession');
    Route::post('storedmsession', [DMSessionController::class, 'store'])->name('admin.storedmsession');
    Route::get('editdmsession/{id}', [DMSessionController::class, 'edit'])->name('admin.editdmsession');
    Route::post('updatedmsession/{id}', [DMSessionController::class, 'update'])->name('admin.updatedmsession');
    Route::get('deletedmsession/{id}', [DMSessionController::class, 'delete'])->name('admin.deletedmsession');
    Route::get('/dmtimeslot', [DMSessionController::class, 'timeSlotIndex'])->name('admin.dmtimeslot');
    Route::post('/storetimeslot', [DMSessionController::class, 'storeTimeSlot'])->name('admin.storetimeslot');
    Route::post('/updatetimeslot', [DMSessionController::class, 'updateTimeSlot'])->name('admin.updatetimeslot');
    Route::get('/deletedmtimeslot/{id}', [DMSessionController::class, 'deleteTimeSlot'])->name('admin.deletedmtimeslot');
    Route::get('dmsessioncancel/{id}', [DMSessionController::class, 'dmsessioncancel'])->name('admin.dmsessioncancel');
    Route::post('storedmsessioncancel/{id}', [DMSessionController::class, 'storedmsessioncancel'])->name('admin.storedmsessioncancel');
    Route::post('admintakeaway', [DMSessionController::class, 'storeAdminTakeaway'])->name('admin.storeadmintakeaway');
    Route::get('edittakeaway/{id}', [DMSessionController::class, 'edittakeaway'])->name('admin.edittakeaway');
    Route::post('updatetakeaway/{id}', [DMSessionController::class, 'updatetakeaway'])->name('admin.updatetakeaway');
    // Route::get('/api/getBookedVenues', [DMSessionController::class, 'getBookedVenues']);


    //Career Details
    Route::get('career_list', [CareerController::class, 'index'])->name('admin.careerlist');
    Route::post('store_career', [CareerController::class, 'store'])->name('admin.storecareer');
    Route::post('update_career', [CareerController::class, 'update'])->name('admin.updatecareer');
    Route::get('delete_career/{id}', [CareerController::class, 'delete'])->name('admin.deletecareer');

    //SubCareer Details
    Route::get('subcareer_list', [SubCareerController::class, 'index'])->name('admin.subcareerlist');
    Route::post('store_subcareer', [SubCareerController::class, 'store'])->name('admin.storesubcareer');
    Route::post('update_sub_career', [SubCareerController::class, 'update'])->name('admin.editSubCareer');
    Route::get('delete_subcareer/{id}', [SubCareerController::class, 'delete'])->name('admin.deletesubcareer');

    //Attendance Details
    Route::get('attendance_index/{id}/{date}', [AttendanceController::class, 'index'])->name('admin.attendance');
    Route::post('store_attendance', [AttendanceController::class, 'store'])->name('admin.storeattendance');
    Route::get('stud_attendance/{id}', [AttendanceController::class, 'attendancelist'])->name('admin.attendancelist');
    Route::get('show_attendance/{id}/{wid}/{date}', [AttendanceController::class, 'showattendance'])->name('admin.showattendance');
    Route::get('edit_attendance/{id}', [AttendanceController::class, 'editAttendance'])->name('admin.editattendance');
    Route::put('update_attendance/{id}', [AttendanceController::class, 'updateAttendance'])->name('admin.updateattendance');


    //Career Club
    Route::get('careerclub_index', [CareerClubController::class, 'index'])->name('admin.careerclub');
    Route::post('store_careerclub', [CareerClubController::class, 'store'])->name('admin.storecareerclub');
    Route::post('updatecareerClub', [CareerClubController::class, 'update'])->name('updatecareerClub');
    Route::get('deletecareerclub/{id}', [CareerClubController::class, 'delete'])->name('admin.deletecareerclub');


    //Internship Details
    Route::get('internship_list', [InternshipController::class, 'internshipList'])->name('admin.internshiplist');
    Route::get('add_internship', [InternshipController::class, 'addInternship'])->name('admin.addinternship');
    Route::post('store_internship', [InternshipController::class, 'storeInternship'])->name('admin.storeinternship');
    Route::get('edit_internship/{id}', [InternshipController::class, 'edit'])->name('admin.editinternship');
    Route::post('update_internship/{id}', [InternshipController::class, 'update'])->name('admin.updateinternship');
    Route::get('delete_internship/{id}', [InternshipController::class, 'delete'])->name('admin.deleteinternship');

    //AIPortal Details
    Route::get('aiportal_index', [AIPortalController::class, 'index'])->name('admin.aiportal');
    Route::post('updatePortal', [AIPortalController::class, 'update'])->name('updatePortal');
    Route::post('store_aiportal', [AIPortalController::class, 'store'])->name('admin.storeaiportal');
    Route::get('delete_aiportal/{id}', [AIPortalController::class, 'delete'])->name('admin.deleteaiportal');

    //venue routes
    Route::get('venue_list', [VenueController::class, 'index'])->name('admin.venue');
    Route::post('store_venue', [VenueController::class, 'store'])->name('admin.storevenue');
    Route::post('update_venue', [VenueController::class, 'update'])->name('admin.updatevenue');
    Route::get('delete_venue/{id}', [VenueController::class, 'delete'])->name('admin.deletevenue');
});

Route::get('/clean-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('event:cache');
    $exitCode = Artisan::call('event:clear');
    $exitCode = Artisan::call('optimize');
    return '<h1>Cache facade value cleared</h1>';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
