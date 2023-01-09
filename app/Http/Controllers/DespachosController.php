<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\RequestTag;
use App\Models\Transbank;
use App\Models\Despachos;

class DespachosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $datos = $request;
        //dd($datos);
        $valortag = DB::select('select valor from valor_tag order by created_at desc limit 1');

        $tagdata = [];
        $existe_transbank = Transbank::where("sessionId",'=',"$datos->id_tag")->first();
        $existe_despacho = Despachos::where("id_RequestTag",'=',"$datos->id_tag")->first();
        $tag = RequestTag::where("id",'=',"$datos->id_tag")->first();

        switch ($datos->entrega) {
            case 'local':
                //dd('local');
                $tagdata = array_add($tagdata, 'local_retiro', '1');
                $tag->update($tagdata);
                if($existe_transbank){
                    $existe_transbank->delete();
                    return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $datos->id_tag, 'valortag' => $valortag[0]->valor]);
                }else{
                    return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $datos->id_tag, 'valortag' => $valortag[0]->valor]);
                }

                break;
            
            case 'delivery':
                //dd('delivery');
                $tagdata = array_add($tagdata, 'local_retiro', '2');
                $tag->update($tagdata);

                $desp = [];
                $desp = array_add($desp, 'id_RequestTag', $datos->id_tag);
                $desp = array_add($desp, 'rut', $datos->rut);
                $desp = array_add($desp, 'telefono', $datos->telefono);
                $desp = array_add($desp, 'nomapell', $datos->nombre);
                $desp = array_add($desp, 'direccion', $datos->direccion);

                if(!$existe_despacho){
                    Despachos::create($desp);
                }else{
                    $existe_despacho->update($desp);
                }
                
                if(!$existe_transbank){
                    return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $datos->id_tag, 'valortag' => $valortag[0]->valor]);
                }else{
                    $existe_transbank->delete();
                    return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $datos->id_tag, 'valortag' => $valortag[0]->valor]);
                }

                break;

            default:
                //dd('nada');
                toast('Debe Indicar una Opción de Entrega','error');
                return redirect()->back();
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
