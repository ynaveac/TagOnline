<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFirmasRequest;
use App\Http\Requests\UpdateFirmasRequest;
use App\Models\Firmas;
use App\Http\Controllers\Arr;
use App\Models\Tagpendientes;
use App\Models\Transbank;
use App\Models\RequestTag;
use Illuminate\Support\Facades\DB;

class FirmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('tag.firma');
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
     * @param  \App\Http\Requests\StoreFirmasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFirmasRequest $request)
    {
        
        $datos = $request;
        //dd($datos);

        $deliv = DB::select('select valor from valor_delivery order by created_at desc limit 1');
        $delivery = $deliv[0]->valor;
        
        $existe = Firmas::where("id_RequestTag",'=',"$datos->id_RequestTag")->first();
        $id_tag =  $datos->id_RequestTag;

        if(!isset($existe)){

            $tarea = Firmas::create($datos->all());
            return view('tag.despacho', compact('id_tag', 'delivery'));
            //return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $datos->id_RequestTag]);

        }else{
            
            $existe->update([
                'firmaok'   => $datos['firmaok'],
                'firma'     => $datos['firma'],
            ]);

            $tagpendiente = Tagpendientes::where("requesttag_id",'=',"$datos->id_RequestTag")->first();
            $data = [];
            $data = array_add($data, 'firma', 'completo');
            $data = array_add($data, 'estado', 'Pendiente');
            if($tagpendiente != null){
                $tagpendiente->update($data);
            }
            $tag = RequestTag::find($datos->id_RequestTag);
            $tagdata = [];
            $tagdata = array_add($tagdata, 'estado', 'Pendiente');
            if($tag != null){
                $tag->update($tagdata);
            }            

            $existe_transbank = Transbank::where("sessionId",'=',"$datos->id_RequestTag")->first();

            if(!isset($existe_transbank)){
                //return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $datos->id_RequestTag]);
                return view('tag.despacho', compact('id_tag', 'delivery'));
            }else{
                if($existe_transbank->estado <> 'Compra Aprobada'){
                    $existe_transbank->delete();
                    return view('tag.despacho', compact('id_tag', 'delivery'));
                    //return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $datos->id_RequestTag]);
                }else{
                    toast('1 Datos Guardados Correctamente','success');
                    return redirect('suscripcion');
                }
                toast('2 Datos Guardados Correctamente','success');
                return redirect('suscripcion');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Firmas  $firmas
     * @return \Illuminate\Http\Response
     */
    public function show(Firmas $firmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Firmas  $firmas
     * @return \Illuminate\Http\Response
     */
    public function edit(Firmas $firmas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFirmasRequest  $request
     * @param  \App\Models\Firmas  $firmas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFirmasRequest $request, Firmas $firmas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Firmas  $firmas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Firmas $firmas)
    {
        //
    }
}
