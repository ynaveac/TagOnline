<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentsRequest;
use App\Http\Requests\UpdateDocumentsRequest;
use App\Models\Documents;
use App\Http\Controllers\Arr;
use App\Models\Tagpendientes;
use App\Models\RequestTag;


class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('tag.document');
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
     * @param  \App\Http\Requests\StoreDocumentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentsRequest $request)
    {

        $datos = $request;
        $destinationPath = 'documents/';
        $documento = [];
        $bandera_imagen = 0;

        if($datos->hasFile('carnetfrontal')){
            $carnetfrontal = $datos->file('carnetfrontal');
            if($carnetfrontal->getClientOriginalName()=='image.jpg'){
                $bandera_imagen ++;
                $filename = time().'-'.$datos->id_RequestTag.'-'.$bandera_imagen.$carnetfrontal->getClientOriginalName();
            }else{
                $filename = time().'-'.$datos->id_RequestTag.'-'.$carnetfrontal->getClientOriginalName();
            }
            $uploadSuccess = $request->file('carnetfrontal')->move($destinationPath, $filename);
            //$datos->carnetfrontal = $destinationPath.$filename;
            $documento = array_add($documento, 'carnetfrontal', $destinationPath.$filename);

        }
        if($datos->hasFile('carnetfrontalempresa')){
            $carnetfrontalempresa = $datos->file('carnetfrontalempresa');
            if($carnetfrontalempresa->getClientOriginalName()=='image.jpg'){
                $bandera_imagen ++;
                $filename = time().'-'.$datos->id_RequestTag.'-'.$bandera_imagen.$carnetfrontalempresa->getClientOriginalName();
            }else{
                $filename = time().'-'.$datos->id_RequestTag.'-'.$carnetfrontalempresa->getClientOriginalName();
            }
            $uploadSuccess = $datos->file('carnetfrontalempresa')->move($destinationPath, $filename);
            //$datos->carnetfrontalempresa = $destinationPath.$filename;
            $documento = array_add($documento, 'carnetfrontalempresa', $destinationPath.$filename);
        }
        if($datos->hasFile('primerainscripcion')){
            $primerainscripcion = $datos->file('primerainscripcion');
            if($primerainscripcion->getClientOriginalName()=='image.jpg'){
                $bandera_imagen ++;
                $filename = time().'-'.$datos->id_RequestTag.'-'.$bandera_imagen.$primerainscripcion->getClientOriginalName();
            }else{
                $filename = time().'-'.$datos->id_RequestTag.'-'.$primerainscripcion->getClientOriginalName();
            }
            $uploadSuccess = $datos->file('primerainscripcion')->move($destinationPath, $filename);
            //$datos->primerainscripcion = $destinationPath.$filename;
            $documento = array_add($documento, 'primerainscripcion', $destinationPath.$filename);
        }
        if($datos->hasFile('compranotarial')){
            $compranotarial = $datos->file('compranotarial');
            if($compranotarial->getClientOriginalName()=='image.jpg'){
                $bandera_imagen ++;
                $filename = time().'-'.$datos->id_RequestTag.'-'.$bandera_imagen.$compranotarial->getClientOriginalName();
            }else{
                $filename = time().'-'.$datos->id_RequestTag.'-'.$compranotarial->getClientOriginalName();
            }
            $uploadSuccess = $datos->file('compranotarial')->move($destinationPath, $filename);
            //$datos->compranotarial = $destinationPath.$filename;
            $documento = array_add($documento, 'destinationPath', $destinationPath.$filename);
        }
        if($datos->hasFile('padron')){
            $padron = $datos->file('padron');
            if($padron->getClientOriginalName()=='image.jpg'){
                $bandera_imagen ++;
                $filename = time().'-'.$datos->id_RequestTag.'-'.$bandera_imagen.$padron->getClientOriginalName();
            }else{
                $filename = time().'-'.$datos->id_RequestTag.'-'.$padron->getClientOriginalName();
            }
            $uploadSuccess = $datos->file('padron')->move($destinationPath, $filename);
            //$datos->padron = $destinationPath.$filename;
            $documento = array_add($documento, 'padron', $destinationPath.$filename);
        }
        if($datos->hasFile('cav')){
            $cav = $datos->file('cav');
            if($cav->getClientOriginalName()=='image.jpg'){
                $bandera_imagen ++;
                $filename = time().'-'.$datos->id_RequestTag.'-'.$bandera_imagen.$cav->getClientOriginalName();
            }else{
                $filename = time().'-'.$datos->id_RequestTag.'-'.$cav->getClientOriginalName();
            }
            $uploadSuccess = $datos->file('cav')->move($destinationPath, $filename);
            //$datos->cav = $destinationPath.$filename;
            $documento = array_add($documento, 'cav', $destinationPath.$filename);
        }

        $documento = array_add($documento, 'id_RequestTag', $datos->id_RequestTag);

        $existe = Documents::where("id_RequestTag",'=',"$datos->id_RequestTag")->first();
        
        if(!isset($existe)){

            $tarea = Documents::create($documento);
            toast('Documentos Guardados Correctamente','success');
            return redirect()->action([FirmasController::class, 'index'], ['id' => $datos->id_RequestTag]);

        }else{
            $existe->update($documento);

            $tagpendiente = Tagpendientes::where("requesttag_id",'=',"$datos->id_RequestTag")->first();
            $data = [];

            if($tagpendiente->firma == 'incompleto'){
                $data = array_add($data, 'documentos', 'completo');
                $tagpendiente->update($data);
                toast('Datos Guardados Correctamente','success');
                return redirect()->action([FirmasController::class, 'index'], ['id' => $datos->id_RequestTag]);
                //dd('update incompleto');
            }else{
                $data = array_add($data, 'documentos', 'completo');
                $data = array_add($data, 'estado', 'Pendiente');
                $tagpendiente->update($data);

                $tag = RequestTag::find($datos->id_RequestTag);
                $tagdata = [];
                $tagdata = array_add($tagdata, 'estado', 'Pendiente');
                $tag->update($tagdata);

                toast('Datos Guardados Correctamente','success');
                return redirect('suscripcion');
                //dd('update completo');
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function edit(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentsRequest  $request
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentsRequest $request, Documents $documents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documents $documents)
    {
        //
    }
}
