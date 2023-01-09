<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Arr;
use App\Models\Locals;
use App\Http\Requests\LocalRequest;


class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $local = Locals::all();
        return view ('local.index', compact('local'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('local.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalRequest $request)
    {
        try {
            $datos = $request;
            Locals::create($datos->all());
            toast('Local Guardado Correctamente','success');
            return redirect('local');

        } catch (\Throwable $th) {
            toast('Operación Rechazada','error');
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
        $local = Locals::find($id);
        return view('local.update', compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalRequest $request, $id)
    {
        try {
            
            $locales=Locals::findOrFail($id);
            //$data = $request->all();
            $data = $request->only('rut', 'nombre', 'direccion');
            
            if (is_null($request->maquina)){
                $data['maquina']=null;
            } else {
                $data['maquina']=$request->maquina;
            }

            if (is_null($request->kiosko)){
                $data['kiosko']=null;
            } else {
                $data['kiosko']=$request->kiosko;
            }

            $locales->update($data);

            toast('Local Modificado Correctamente','success');
            return redirect('local');
            
        } catch (\Throwable $th) {
            toast('Operación Rechazada','error');
            return redirect()->back();
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
        $delete=Locals::find($id)->delete();
        if ($delete) {
            toast('Local Eliminado Correctamente','success');
            return redirect('local');
        } else {
            toast('Operación Rechazada','error');
            return redirect()->back();
        }
    }
}
