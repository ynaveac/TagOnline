<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Locals;
use App\Models\RequestTag;
use App\Models\Documents;
use App\Models\Empleados;
use App\Http\Requests\EntregaRequest;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id = base64_decode($id);

        $solicitudes = DB::select('select 
        rt.id ,
        rt.fecha_proceso ,
        rt.local ,
        rt.vendedor ,
        rt.tipo ,
        rt.rut ,
        rt.rut_representante ,
        rt.nombre_representante ,
        rt.nombre ,
        rt.apellidos ,
        rt.direccion ,
        rt.telefono ,
        rt.email ,
        rt.patente ,
        rt.marca ,
        rt.modelo ,
        rt.observaciones ,
        rt.estado ,
        d.id_RequestTag ,
        d.carnetfrontal ,
        d.carnetfrontalempresa ,
        d.primerainscripcion ,
        d.compranotarial ,
        d.padron ,
        d.cav ,
        f.firmaok ,
        f.firma ,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.total 
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        where rt.id = '.$id);

        $locales = Locals::all();

        if ($solicitudes[0]->estado == 'Aprobado'){

            return view ('comercio.index', compact('solicitudes', 'locales'));

        }else{

            alert()->info('Información',"Estimado Asociado la Solicitud No puede ser Validada.\n\nEstado Actual : ". $solicitudes[0]->estado);
            return redirect('suscripcion');

        }
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
    public function store(EntregaRequest $request)
    {

        $datos = $request;
        //dd($datos);

        $pas_emp = DB::select('select 
                            l.id as id_local,
                            e.password
                            from locals l left join empleados e on l.id = e.local_id where l.id = '.$datos->local_id.' and e.password = "'.$datos->pascomercio.'" limit 1');

        //dd($pas_emp[0]);

        if(isset($pas_emp[0]->password)){
            
            if($datos->pascomercio == $pas_emp[0]->password){

                $destinationPath = 'documents/';
                $documento = [];
        
                if($datos->hasFile('tagentregado')){

                    $tagentregado = $datos->file('tagentregado');
                    $filename = time().'-'.$datos->id_RequestTag.'-'.$tagentregado->getClientOriginalName();
                    $uploadSuccess = $request->file('tagentregado')->move($destinationPath, $filename);
                    //$datos->tagentregado = $destinationPath.$filename;
                    $documento = array_add($documento, 'tagentregado', $destinationPath.$filename);
                }

                $existe = Documents::where("id_RequestTag",'=',"$datos->id_RequestTag")->first();
                $existe->update($documento);

                $existe_tag = RequestTag::where("id",'=',"$datos->id_RequestTag")->first();
                $existe_tag->update([
                    'asociado_retiro'   => $datos['local_id'],
                    'estado'            => 'Tag Retirado',
                ]);

                alert()->success('Tag Entregado',"Estimado Asociado Información Guardada.\n\nPor favor entregar Tag a Cliente.");
                return redirect('suscripcion');
                //dd('guardado');
            
            }
            
        }else{
            alert()->warning('Error',"Estimado Asociado la clave de comercio es incorrecta.");
            return redirect()->back();
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
