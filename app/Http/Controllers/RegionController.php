<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\PayUService\Exception;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Region::find(1)->communes()->get();
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction());

        $regions = Region::all();
        $respuesta = RegionResource::collection($regions);
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
    public function store(StoreRegionRequest $request)
    {
        \Log::channel('mydblog')->info('E '. Route::currentRouteAction().' '.$request.' '.serialize($request->all()));

        try {
            $regions = Region::create($request->all());
        } catch(\Exception $e){
            \Log::channel('mydblog')->error('S '.$e );
            return response([$e, 'success' => false], 200);
        }
        
        $r = new RegionResource($regions);
        \Log::channel('mydblog')->info('S '.serialize($regions));
        return response([$r, 'success' => true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
         //
         \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' Registro: '.$region);
        
         if(strcasecmp($region->status, 'trash') == 0){
             $region = "Registro no existe";
             return response("Registro no existe", 200);
         } 
 
         \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$region);
 
         return response([$region, 'success' => true],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRegionRequest $request, Region $region)
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' '.$request.' '.serialize($request->all()));

        $region->update($request->all());

        \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$region);
        $r = new RegionResource($region);
        return response([$r, 'success' => true],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        \Log::channel('mydblog')->info('E '.Route::currentRouteAction().' Registro: '.$region);
        
        if(strcasecmp($region->status, 'trash') == 0){
            $region = "Registro no existe";
            return response("Registro no existe", 200);
        } else {
            $region->status = 'trash';
            $region->save();
        }
        
        \Log::channel('mydblog')->info('S '.Route::currentRouteAction().' Registro: '.$region);

        return response([$region, 'success' => true],200);
    }
}
