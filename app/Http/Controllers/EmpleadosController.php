<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Arr;
use App\Models\Empleados;
use App\Models\Locals;
use App\Http\Requests\EmpleadoRequest;


class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$emp = Empleados::all();
        $emp = DB::select('select e.id, e.rut, e.pasaporte, e.nombre, e.apellidos, l.nombre as nombre_local  from empleados as e left join locals as l on e.local_id = l.id where e.deleted_at is null');
        return view ('empleado.index', compact('emp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Locals::all();
        return view ('empleado.create', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {

        try {
            $datos = $request;
            //dd($datos);
            Empleados::create($datos->only('rut', 'pasaporte', 'nombre', 'apellidos', 'direccion', 'local_id', 'password')
          //  + [
          //          'password' => bcrypt($datos->input('password'))
          //  ]
            );
            //Empleados::create($datos->all());
            toast('Colaborador Guardado Correctamente','success');
            return redirect('empleado');

        } catch (\Throwable $th) {
            dd($th);
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
        $emp = Empleados::find($id);
        $locales = Locals::all();
        return view('empleado.update', compact('emp', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {
        try {
            $empleado=Empleados::findOrFail($id);
            $data = $request->only('rut', 'pasaporte', 'nombre', 'apellidos', 'direccion', 'local_id', 'password');
            //$data['password']=bcrypt($request->password);
            //$data = $request->all();
            $empleado->update($data);
            toast('Colaborador Modificado Correctamente','success');
            return redirect('empleado');

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

        $delete=Empleados::find($id)->delete();
        if ($delete) {
            toast('Colaborador Eliminado Correctamente','success');
            return redirect('empleado');
        } else {
            toast('Operación Rechazada','error');
            return redirect()->back();
        }
    }
}
