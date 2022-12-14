<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommuneRequest;
use App\Http\Resources\CommuneResource;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\PayUService\Exception;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction());

        $communes = Commune::where('status', 'A')->get();
        $respuesta = CommuneResource::collection($communes);
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
    public function store(StoreCommuneRequest $request)
    {
        \Log::channel('mydblog')->info('E '. Route::currentRouteAction().' '.$request.' '.serialize($request->all()));

        try {
            $communes = Commune::create($request->all());
        } catch(\Exception $e){
            \Log::channel('mydblog')->error('S '.$e );
            return response([$e, 'success' => false], 200);
        }
        $c = new CommuneResource($communes);
        \Log::channel('mydblog')->info('S '.serialize($communes));
        return response([$c, 'success' => true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commune  $Commune
     * @return \Illuminate\Http\Response
     */
    public function show(Commune $commune)
    {
        //
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' Registro: '.$commune);
        
        if(strcasecmp($commune->status, 'trash') == 0){
            $commune = "Registro no existe";
            return response("Registro no existe", 200);
        } 

        \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$commune);

        return response([$commune, 'success' => true],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commune  $Commune
     * @return \Illuminate\Http\Response
     */
    public function edit(Commune $commune)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commune  $Commune
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(StoreCommuneRequest $request, Commune $commune)
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' '.$request.' '.serialize($request->all()));

        $commune->update($request->all());

        $c = new CommuneResource($commune);
        \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$commune);
        return response([$c, 'success' => true],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commune $commune)
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' Registro: '.$commune);
        
        if(strcasecmp($commune->status, 'trash') == 0){
            $commune = "Registro no existe";
            return response("Registro no existe", 200);
        } else {
            $commune->status = 'trash';
            $commune->save();
        }
        
        \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$commune);

        return response([$commune, 'success' => true],200);
    }
}
