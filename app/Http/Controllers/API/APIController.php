<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPortfolioEmployeeRequest;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\RateRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\About;
use App\Models\Banner;
use App\Models\Calender;
use App\Models\Car;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Message;
use App\Models\Notification;
use App\Models\ReceiveType;
use App\Models\Rent;
use App\Models\RentType;
use App\Models\ReturnType;
use App\Models\Room;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Transaction;
use App\Models\User;
use App\Services\UploadService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Number;

use function PHPUnit\Framework\isEmpty;

class APIController extends Controller
{

    public function intro(){

        $intro = Setting::select('intro_img')->first();

        return response()->json([
            'data' => $intro
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function listEmployees(){

        $employees = Employee::with('job')->select(['id', 'job_id','name', 'photo', 'description'])->latest()->take(6)->get();

        return response()->json([
            'data' => $employees
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function listCategories(){

        $categories = Job::latest()->take(6)->get();

        return response()->json([
            'data' => $categories
        ]);

    }

    /**
     * @return JsonResponse
     */
    public function listSliders(){

        $sliders = Slider::latest()->take(3)->get();

        return response()->json([
            'data' => $sliders
        ]);

    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function employee(Employee $employee)
    {

        $employee->load(['job', 'portfolio', 'rates']);

        return response()->json([
            'data' => $employee
        ]);
    }

    public function addRate(RateRequest $request, Employee $employee) {

        $employee->rate()->create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
            'stars' => $request->stars,
        ]);

        return response()->json(['message' => 'Rate Added Succesfully']);

    }

    /**
     * @param AppointmentRequest $request
     * @param Employee $employee
     * @return JsonResponse
     */
    public function AddAppointment(AppointmentRequest $request, Employee $employee) {
        $requestData = $request->validated();
        $requestData['user_id'] = auth()->user()->id;
        $data = $employee->orders()->create($requestData);
        return response()->json(['message' => 'appointment created successfully', 'data' => $data ]);
    }

    public function updateProfile(UpdateEmployeeRequest $request)
    {
        // dd($request->all());

        $employee = auth()->user();

        $employee->update($request->validated());
        
        if($request->hasFile('licence_file')) {

            $employee->update([
                'licence_file' => UploadService::store($request->licence_file)
            ]);

        }

        if($request->hasFile('id_number_file')) {

            $employee->update([
                'id_number_file' => UploadService::store($request->id_number_file)
            ]);

        }
        
        if($request->hasFile('photo')) {

            $employee->update([
                'photo' => UploadService::store($request->photo)
            ]);

        }
        $employee->refresh();

        return response()->json([
            'message' => 'Profile Updated Successfully',
            'data' => $employee
        ]);

    }
    public function addPortfolio(AddPortfolioEmployeeRequest $request)
    {

        $employee = auth()->user();

        $portfolio = $employee->portfolio()->create($request->validated());

        return response()->json([
            'message' => 'Portfolio Addedd Successfully',
            'data' => $portfolio
        ]);

    }
    public function calenders()
    {
        $employee = auth()->user();

        $calnder = Calender::where('employee_id', $employee->id)->latest()->paginate(10);

        return response()->json([
            'data' => $calnder
        ]);

    }
    public function getCalenders()
    {
        $employee = auth()->user();

        $calnder = Calender::where('employee_id', $employee->id)->latest()->paginate(10);

        return response()->json([
            'data' => $calnder
        ]);

    }

    
    public function getCars(Request $request) {

        $cars = Car::with(['company', 'files:id,path,fileable_id', 'rentTypes:id,name,icon'])->latest();
        
        if($request->driver) {
            $cars->where('with_driver', $request->driver);
        }
        
        if($request->rentTypes) {
            $types = $request->rentTypes;
            $cars->whereHas('rentTypes', function($q) use ($types) {
                $q->whereIn('rent_type_id', $types);
            });
        }
        
        return response()->json($cars->get(), 200);
    }



    public function rent(Request $request) {

        $validatedData = $request->validate([
            'date_from' => 'required',
            'date_to' => 'required',
            'time' => 'required',
            'location' => 'nullable',
            'car_id' => 'required',
            // "services" => 'nullable|exists:services,id|array',
            "return_type_id" => 'required|exists:return_types,id'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        $rent = Rent::create($validatedData);

        if(isset($request->services) && count($request->services) > 0) {
            $rent->services()->attach($request->services);
        }
        
        return response()->json(['message' => 'Rent addedd succesfully', 'data' => $rent], 200);


    }


    public function currentRent() {

        $rents = Rent::with(['services', 'returnType', 'car'])->where('user_id', auth()->user()->id)->whereMonth('created_at', Carbon::now()->month)->get();

        return response()->json($rents, 200);
    }
    
    public function lastRent() {

        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();

         $rents = Rent::with('car')->where('user_id', auth()->user()->id)->where('created_at', '<', $firstDayOfCurrentMonth)->get();

        return response()->json($rents, 200);
    }



    public function rentTypes() {

         $rents = RentType::get();

        return response()->json($rents, 200);
    }

    public function returnType() {

        return response()->json(ReturnType::all(), 200);
        
    }

    public function services() {

        return response()->json(Service::all(), 200);
        
    }

    public function sendMessage(Request $request) {

        $request->validate([
            'message' => 'required|max:191'
        ]);

        $room = Room::where(['user_id' => auth()->user()->id])->first();

         if($room == NULL) {
            $room = Room::create([
                'user_id' => auth()->user()->id
            ]);
         }


        $room->messages()->create([
            'message' => $request->message,
            'from' => 'user',
        ]);

        return response()->json(['message' => 'message Sent Successfully'], 200);

    }

    public function messages() {

        $room = Room::where(['user_id' => auth()->user()->id])->first();

        return response()->json(["messages" => $room?->messages ?? []], 200);

    }

    public function profileData() {

        return response()->json(auth()->user(), 200);
        
    }
    public function bannersData() {

        return response()->json(Banner::latest()->get(), 200);
        
    }
    
    public function notificationData() {

        return response()->json(Notification::where('user_id', auth()->user()->id)->get(), 200);
        
    }

    public function transactionsData() {

        return response()->json(Transaction::where('user_id', auth()->user()->id)->get(), 200);
        
    }
    public function aboutData() {

        return response()->json(About::first(), 200);
        
    }
    public function ReceiveTypes() {
        return response()->json(ReceiveType::all(), 200);
    }

    public function sendLocation(Request $request) 
    {    
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],             
            'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']        
        ]);

        $car = Car::findOrFail($request->car_id);

        $car->update([
            'lat' => $request->lat,
            'long' => $request->long,
        ]);

        return response()->json(['message' => 'location updated successfully']);
    }

    public function renewRent($id, Request $request)
    {
        $rent = Rent::findOrfail($id);

        $request->validate([
            'date_from' => 'required',
            'date_to' => 'required',
        ]);

        $rent->update([
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        return response()->json(['message' => 'Rent updated successfully']);

    }
}
