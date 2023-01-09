<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DevtagRequest;
use App\Models\Devoluciones;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Arr;

class DevtagController extends Controller
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
    public function store(DevtagRequest $request)
    {
        
        if(is_null($request->rutempresa)){
            $datos = $request->only('rut', 'nombre', 'apellidos', 'telefono', 'email', 'patente', 'marca', 'modelo');
        }else{
            $datos = $request->only('rut', 'nombre', 'apellidos', 'telefono', 'email', 'patente', 'marca', 'modelo', 'rutempresa', 'nombreempresa');
        }


        $datos = array_add($datos, 'estado', 'Solicitud Devolución');

        $existe = Devoluciones::where("rut",'=',"$request->rut")->where("patente",'=',"$request->patente")->first();

        if(!isset($existe)){

            if($request->hasFile('carnetfrontal')){

                $destinationPath = 'documents/';
                $carnetfrontal = $request->file('carnetfrontal');

                $filename = time().'-'.$request->rut.$request->patente.'-'.$carnetfrontal->getClientOriginalName();

                $uploadSuccess = $request->file('carnetfrontal')->move($destinationPath, $filename);
                $datos = array_add($datos, 'carnetfrontal', $destinationPath.$filename);
    
            }

            $result = Devoluciones::create($datos);

            $valordev = DB::select('select valor from valor_dev order by created_at desc limit 1');

            alert()->success('Devolución',"Estimado ".$request->nombre." Solicitud ha sido Ingresada con Existo.");
            return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $result->id, 'valordev' => $valordev[0]->valor, 'tipo' => $request->tipo]);

        }else{
            alert()->warning('Devolución',"Estimado ".$existe->nombre." ya existe una solicitud\n en Estado : '".$existe->estado."'\n Por favor pongase en contacto.");
            return redirect('suscripcion');
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
