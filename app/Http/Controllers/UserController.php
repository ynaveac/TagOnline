<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Arr;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UsuarioRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view ('usuario.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        try {
            if (trim($request->password)=='') {
                toast('Debe Ingresar una Password','info');
                return redirect()->back();
            }else{
                User::create($request->only('name', 'email', 'username')
                + [
                        'password' => bcrypt($request->input('password'))
                ]);
                //return redirect()->back();
                toast('Usuario Guardado Correctamente','success');
                return redirect('user');
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
        $user = User::find($id);
        return view('usuario.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        try {
            $user=User::findOrFail($id);
            $data = $request->only('name', 'username', 'email');
            if (trim($request->password)=='') {
                $data=$request->except('password');
            } else {
                $data['password']=bcrypt($request->password);
            }
            $user->update($data);
            toast('Usuario Modificado Correctamente','success');
            return redirect('user');
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
        $delete=User::find($id)->delete();
        if ($delete) {
            toast('Usuario Eliminado Correctamente','success');
            return redirect('user');
        } else {
            toast('Operación Rechazada','error');
            return redirect()->back();
        }
        
    }
}

