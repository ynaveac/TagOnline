<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Locals;
use App\Models\Devoluciones;
use App\Http\Requests\DevolucionesRequest;

class DevolucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return redirect('suscripcion');

    }

    public function recepcion($id)
    {

        $id = base64_decode($id);
        
        $devolucion = DB::select("select * from devoluciones where id = ".$id);

        $locales = Locals::all();

        if ($devolucion[0]->estado == 'Solicitud Devolución'){

            return view ('devolucion.index', compact('devolucion' ,'locales'));

        }else{

            alert()->info('Información',"Estimado Asociado la Solicitud de Devolución No puede ser Validada.\n\nEstado Actual : ". $devolucion[0]->estado);
            return redirect('suscripcion');

        }

    }

    public function list()
    {
        $devolucion = DB::select('
            select 
            d.id,
            ROW_NUMBER() OVER (ORDER BY d.id DESC) AS orden,
            d.created_at ,
            d.cod_tag ,
            d.asociado_recepcion ,
            d.estado ,
            d.tag ,
            l.nombre as nombre_local
            from 
            devoluciones d left join locals l on d.asociado_recepcion = l.id
        ');

        return view ('devolucion_list.index', compact('devolucion'));
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
    public function store(DevolucionesRequest $request)
    {
        $datos = $request;

        $pas_emp = DB::select('select 
        l.id as id_local,
        e.password
        from locals l left join empleados e on l.id = e.local_id where l.id = '.$datos->local_id.' and e.password = "'.$datos->pascomercio.'" limit 1');

        if(isset($pas_emp[0]->password)){
            
            if($datos->pascomercio == $pas_emp[0]->password){
                

                    $destinationPath = 'documents/';
                    $documento = [];
            
                    $documento = array_add($documento, 'cod_tag', $datos->cod_tag);
                    $documento = array_add($documento, 'asociado_recepcion', $datos->local_id);
                    $documento = array_add($documento, 'estado', 'Tag Recepcionado');

                    if($datos->hasFile('tag')){

                        $tag = $datos->file('tag');
                        $filename = time().'-'.$datos->local_id.'-'.$tag->getClientOriginalName();
                        $uploadSuccess = $request->file('tag')->move($destinationPath, $filename);
                        $documento = array_add($documento, 'tag', $destinationPath.$filename);
                    }

                    $busqueda_devolucion = Devoluciones::find($datos->id_dev);
                    //Devoluciones::create($documento);
                    $busqueda_devolucion->update($documento);
                    alert()->success('Tag Recepcionado',"Estimado Asociado Información Guardada.\n\nPor favor Recepcionar Tag.");
                    return redirect('suscripcion');

           
            }else{
                alert()->warning('Error',"Estimado Asociado la clave de comercio es incorrecta.");
                return redirect()->back();
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
        $devolucion = DB::select('
        select 
        d.id,
        ROW_NUMBER() OVER (ORDER BY d.id DESC) AS orden,
        d.created_at ,
        d.cod_tag ,
        d.asociado_recepcion ,
        d.estado ,
        d.tag ,
        l.nombre as nombre_local,
        d.rut,
        d.nombre,
        d.apellidos,
        d.telefono,
        d.email,
        d.patente,
        d.marca,
        d.modelo,
        d.rutempresa,
        d.nombreempresa,
        d.carnetfrontal
        from 
        devoluciones d left join locals l on d.asociado_recepcion = l.id where d.id = '.$id);

        return view('devolucion_list.update', compact('devolucion'));
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

        if($request->estado == 'Seleccione'){
            toast('Debe Completar la Información','error');
            return redirect()->back();
        }
        if(is_null($request->cod_tag)){
            toast('Debe Completar la Información','error');
            return redirect()->back();
        }

        $dev = Devoluciones::find($id);
        $devoluciones = $request->only('estado', 'cod_tag');

        $dev->update($devoluciones);

        toast('Datos Guardados Correctamente','success');
        return redirect('devoluciones.list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dev = Devoluciones::find($id);
        $dev->delete();
        toast('Datos Eliminados Correctamente','success');
        return redirect('devoluciones.list');
    }
}
