<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Arr;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Valor_tag;

class Valor_TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valortag = Valor_tag::all();
        return view ('valortag.index', compact('valortag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('valortag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            if (trim($request->valor)=='') {
                toast('Debe Ingresar un valor','info');
                return redirect()->back();
            }else{
                Valor_tag::create($request->all());
                toast('Valor Guardado Correctamente','success');
                return redirect('valortag');
            }
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
        $delete=Valor_tag::find($id)->delete();
        if ($delete) {
            toast('Valor Tag Eliminado Correctamente','success');
            return redirect('valortag');
        } else {
            toast('Operación Rechazada','error');
            return redirect()->back();
        }
    }
}
