<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Authenticatable;
use App\Services\PayUService\Exception;

class CustomerController extends Controller
{

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);


        $customer = Customer::where('email', $request->email)->first();
        if ($customer) {
            $expiresAt = Carbon::now()->addMinutes(5);

            $token = $customer->createToken($request->email, $request->email.''.Carbon::now().''.rand(200,500), ['*'], $expiresAt)->plainTextToken;
            if ($token) {


                $response['token'] = $token;
                $response['message'] = "Token retornado correctamente";
                $response['success'] = true;
                return $response;
            } else {
                $response['message'] = "Error al obtener token";
                $response['success'] = false;
                return $response;
            }
        } else {
            $response['message'] = "El correo electronico no existe";
            $response['success'] = false;
            return $response;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction());

        $customers = Customer::where('status', 'A')->get();
        $respuesta = CustomerResource::collection($customers);
        \Log::channel('mydblog')->info('S '.serialize($respuesta));
        return response([$respuesta, 'success' => true],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        \Log::channel('mydblog')->info('E '. Route::currentRouteAction().' '.$request.' '.serialize($request->all()));

        if($region = Region::find($request->id_reg)->communes()->where('id_reg', $request->id_reg)->first()){
            try {
                $customers = Customer::create($request->all());
            } catch(\Exception $e){
                \Log::channel('mydblog')->error('S '.$e );
                return response([$e, 'success' => false], 200);
            }
        } else {
            \Log::channel('mydblog')->info('S Comuna no pertenece a region');
            return "Comuna no pertenece a region";
        }
            $c = new CustomerResource($customers);
        

        \Log::channel('mydblog')->info('S '.serialize($customers));
        return response([$c, 'success' => true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
         //
         \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' Registro: '.$customer);
        
         if(strcasecmp($customer->status, 'trash') == 0){
             $customer = "Registro no existe";
             return response("Registro no existe", 200);
         } 
 
         \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$customer);
 
         return response([$customer->with('commune.region')->first(), 'success' => true], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' '.$request.' '.serialize($request->all()));

        $customer->update($request->all());

        \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$customer);
        $c = new CustomerResource($customer);
        return response([$c, 'success' => true],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' Registro: '.$customer);
        
        if(strcasecmp($customer->status, 'trash') == 0){
            $customer = "Registro no existe";
            return response("Registro no existe", 200);
        } else {
            $customer->status = 'trash';
            $customer->save();
        }
        
        \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$customer);

        return response([$customer,  'success' => true],200);
    }
}
