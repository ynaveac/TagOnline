<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Arr;
use App\Http\Controllers\MensajeriaController;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\DB;
use App\Models\RequestTag;
use App\Models\Tagpendientes;
use App\Models\Transbank;
use PDF;

class RequestTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {

        //$solicitudes = RequestTag::get();
        $solicitudes = DB::select('select 
        ROW_NUMBER() OVER (ORDER BY rt.id DESC) AS orden,
        rt.id ,
        rt.fecha_proceso ,
        rt.created_at ,
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
        rt.local_retiro ,
        d.id_RequestTag ,
        d.carnetfrontal ,
        d.carnetfrontalempresa ,
        d.primerainscripcion ,
        d.compranotarial ,
        d.padron ,
        d.cav ,
        d.tagentregado ,
        f.firmaok ,
        f.firma ,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.total ,
        (select count(*) from logmensajes l where l.id_RequestTag = rt.id and l.mensaje="Solicitud de Tag Habilitado") as tag_habilitado,
        (select count(*) from logmensajes l where l.id_RequestTag = rt.id and l.mensaje="Solicitud de Tag Aprobado") as tag_aprobado,
        (select count(*) from logmensajes l where l.id_RequestTag = rt.id and l.mensaje="Solicitud de Tag Pago Pendiente") as tag_pago_pendiente,
        (select count(*) from logmensajes l where l.id_RequestTag = rt.id and l.mensaje="Solicitud de Tag Incompleta") as tag_falta_documentacion 
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId');

        return view ('request_tag.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {

        if(!isset($request->id)){
            $datos = $request;
            $datos = array_add($datos, 'local', 500);
            $datos = array_add($datos, 'vendedor', 500);
            $datos = array_add($datos, 'estado', 'Pendiente');
            $datos = array_add($datos, 'cod_seguimiento', null);
            
            $existe = RequestTag::where("rut",'=',"$datos->rut")->where("patente",'=',"$datos->patente")->first();

            if(!isset($existe)){
                $tarea = RequestTag::create($datos->all());
                return redirect()->action([DocumentsController::class, 'index'], ['id' => $tarea->id, 'tipo' => $tarea->tipo]);
            }else{
                alert()->warning('WarningAlert',"Estimado ".$existe->nombre." ya existe una solicitud\n en Estado : '".$existe->estado."'\n Por favor pongase en contacto.");
                return redirect('suscripcion');
            }
        }else{

            $b=0;
            $tagpendiente = Tagpendientes::where("requesttag_id",'=',"$request->id")->first();

            if($tagpendiente->documentos == 'incompleto'){
                $b=1;
            }
            if($tagpendiente->firma == 'incompleto'){
                $b=2;
            }

            $tag = RequestTag::find($request->id);
            $tagdata = $request->all();
            
            $data = [];
            $data = array_add($data, 'datos', 'completo');
            
            switch ($b) {
                case 0:
                        $tagdata = array_add($tagdata, 'estado', 'Pendiente');
                        $tag->update($tagdata);
                        $data = array_add($data, 'estado', 'Pendiente');
                        $tagpendiente->update($data);
                        toast('Datos Guardados Correctamente','success');
                        return redirect('suscripcion');
                    break;                   
                case 1:
                        $tag->update($tagdata);
                        $tagpendiente->update($data);
                        toast('Datos Personales Guardados Correctamente','success');
                        return redirect()->action([DocumentsController::class, 'index'], ['id' => $request->id, 'tipo' => '1']);
                    break;
                case 2:
                        $tag->update($tagdata);
                        $tagpendiente->update($data);
                        toast('Datos Personales Guardados Correctamente','success');
                        return redirect()->action([DocumentsController::class, 'index'], ['id' => $request->id, 'tipo' => '2']);
                    break;                

            }
            
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
        rt.local_retiro ,
        rt.cod_seguimiento,
        rt.cod_tag ,
        d.id_RequestTag ,
        d.carnetfrontal ,
        d.carnetfrontalempresa ,
        d.primerainscripcion ,
        d.compranotarial ,
        d.padron ,
        d.cav ,
        d.tagentregado ,
        f.firmaok ,
        f.firma as firmadoc,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.updated_at,
        t.total,
        t2.datos,
        t2.documentos,
        t2.firma
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        left join tagpendientes t2 on rt.id = t2.requesttag_id
        where rt.id = '.$id);

        return view('request_tag.update', compact('solicitudes'));
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
        $vacio = 0;
      
        if (isset($request->datos)==false){
            $vacio = 1;
        }
        if (isset($request->documentos)==false){
            $vacio = 1;
        }
        if (isset($request->firma)==false){
            $vacio = 1;
        }

        if ($vacio == 1 ) {

            toast('Debe Indicar una Opción en cada Item','error');
            //return redirect('request_tag');
            return redirect()->back();
        }else{

            $tagpendiente = DB::select('select requesttag_id, estado, datos, documentos, firma from tagpendientes where requesttag_id = '.$id);

            $tag = RequestTag::find($id);
            $tagdata = $request->only('estado', 'cod_seguimiento', 'cod_tag');

            if($request->cod_seguimiento != null){
                $tagdata = array_add($tagdata, 'local_retiro', '3');
            }else{
                $tagdata = array_add($tagdata, 'local_retiro', '2');
            }

            switch ($request->estado) {
                case 'Falta Documentación':
                        if(($request->datos == 'incompleto') || ($request->documentos == 'incompleto') || ($request->firma == 'incompleto')){

                            $data="";
                            if(empty($tagpendiente)){
                                $data = $request->only('estado', 'datos', 'documentos', 'firma');
                                $data['requesttag_id'] = $id;
                                Tagpendientes::create($data);
                            }else{
                                DB::select('update tagpendientes set updated_at = now(), estado="'.$request->estado.'", datos="'.$request->datos.'", documentos="'.$request->documentos.'", firma="'.$request->firma.'" where requesttag_id = '.$id);
                            }

                            $tag->update($tagdata);
                           
                            toast('1.-Datos Guardados Correctamente','success');
                            return redirect('request_tag');

                        }else{
                            toast('Debe Indicar un Item Incompleto para el Estado Falta Documentación','error');
                            return redirect()->back();
                        }
                    break;
                
                default:
                        if(($request->datos == 'completo') and ($request->documentos == 'completo') and ($request->firma == 'completo')){

                            $data="";
                            if(empty($tagpendiente)){
                                $data = $request->only('estado', 'datos', 'documentos', 'firma');
                                $data['requesttag_id'] = $id;
                                Tagpendientes::create($data);
                            }else{
                                DB::select('update tagpendientes set updated_at = now(), estado="'.$request->estado.'", datos="'.$request->datos.'", documentos="'.$request->documentos.'", firma="'.$request->firma.'" where requesttag_id = '.$id);
                            }

                            $tag->update($tagdata);

                            toast('2.-Datos Guardados Correctamente','success');
                            return redirect('request_tag');

                        }else{

                            toast('Los Items de Documentación deben estar Completos','info');
                            return redirect()->back();
                        }

                    break;
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::select('delete from RequestTag where id = '.$id);
        DB::select('delete from documents where id_RequestTag = '.$id);
        DB::select('delete from firmas where id_RequestTag = '.$id);
        DB::select('delete from transbanks where sessionId = '.$id);
        DB::select('delete from tagpendientes where requesttag_id = '.$id);
        toast('Datos Eliminados Correctamente','success');
        return redirect('request_tag');
    }

    public function pendiente_datos($id)
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
        t.updated_at,
        t.total,
        t2.datos,
        t2.documentos,
        t2.firma
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        left join tagpendientes t2 on rt.id = t2.requesttag_id
        where rt.id = '.$id);

        switch ($solicitudes[0]->tipo) {
            case 1:
                    if($solicitudes[0]->datos == 'incompleto'){
                        return view('tag.naturalupdate', compact('solicitudes'));
                    }else{
                        if($solicitudes[0]->documentos == 'incompleto'){
                            return redirect()->action([DocumentsController::class, 'index'], ['id' => $solicitudes[0]->id, 'tipo' => '2']);
                        }
                        if($solicitudes[0]->firma == 'incompleto'){
                            return redirect()->action([FirmasController::class, 'index'], ['id' => $solicitudes[0]->id]);
                        }
                        return redirect('suscripcion');
                    }
                break;

            case 2:
                    if($solicitudes[0]->datos == 'incompleto'){
                        return view('tag.empresaupdate', compact('solicitudes'));
                    }else{
                        if($solicitudes[0]->documentos == 'incompleto'){
                            return redirect()->action([DocumentsController::class, 'index'], ['id' => $solicitudes[0]->id, 'tipo' => '2']);
                        }
                        if($solicitudes[0]->firma == 'incompleto'){
                            return redirect()->action([FirmasController::class, 'index'], ['id' => $solicitudes[0]->id]);
                        }
                        return redirect('suscripcion');

                    }
                break;  

            default:
                return redirect('suscripcion');
                break;
        }

    }

    public function pendiente_pago($id)
    {
        
        $id = base64_decode($id);
        $existe_transbank = Transbank::where("sessionId",'=',"$id")->first();
        $existe_transbank->delete();
        //dd($id);
        return redirect()->action([TransbankController::class, 'iniciar_compra'], ['id' => $id]);

    }

    public function pdf($id)
    {
        DB::select('SET lc_time_names = "es_CL"');
        $solicitudes = DB::select('
        select 
        rt.id ,
        rt.fecha_proceso ,
        DATE_FORMAT(rt.fecha_proceso, "%W %d de %M del %Y") as fecha_solicitud,
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
        f.firma as firmadoc,
        t.estado as estado_compra ,
        t.transactionDate ,
        t.updated_at,
        t.total,
        t2.datos,
        t2.documentos,
        t2.firma
        from 
        RequestTag rt 
        left join documents d on rt.id = d.id_RequestTag
        left join firmas f on rt.id = f.id_RequestTag 
        left join transbanks t on rt.id = t.sessionId
        left join tagpendientes t2 on rt.id = t2.requesttag_id
        where rt.id = '.$id);

        $pdf = PDF::loadView('reporte.solicitud',['solicitud'=>$solicitudes]);
        return $pdf->stream();

    }

}
