<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all()->where('state', '1');
        $data = [];
        foreach ($roles as $i => $role) {
            $nro = $i + 1;

            $btnDetails =
                '<a href="'.route('roles.show', ['role'=>$role]).'" class="btn btn-xs btn-default text-info mx-1 shadow" title="Detalles">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';
            $btnEdit =
                '<a href="'.route('roles.edit', ['role'=>$role]).'" class="btn btn-xs btn-default text-warning mx-1 shadow" title="Editar">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
            $btnDelete = "
                <button class='btn btn-xs btn-default text-danger mx-1 shadow' title='Eliminar' onclick='answer($role, \"".route('roles.destroy', $role)."\")'>
                    <i class='fa fa-lg fa-fw fa-trash'></i>
                </button>";

            $data[] = [$nro, $role->name, '<nobr>'.$btnDetails.$btnEdit.$btnDelete.'</nobr>'];
        }
        return view('admin.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = trim($request->input('name'));
        $name = mb_strtoupper($name, 'UTF-8');
        $role = new Role();
        $role->name = $name;
        $role->state = '1';

        try {
            $role->save();
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El rol '$name' fue creado con éxito",
                config('constants.TOASTR_TITLE') => 'Nuevo rol creado'
            ]);
            return redirect()->route('roles.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al crear el rol';
            $mode = 'error';
            if ($e->getCode() == 23000) {
                $message = "El rol '$name' ya existe";
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => $mode,
                config('constants.TOASTR_MESSAGE') => $message,
                config('constants.TOASTR_TITLE') => $title
            ]);
            return redirect()->route('roles.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $name = trim($request->input('name'));
        $name = mb_strtoupper($name, 'UTF-8');
        $role->name = $name;

        try {
            $role->save();
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El rol '$name' fue editado con éxito",
                config('constants.TOASTR_TITLE') => 'Rol editado'
            ]);
            return redirect()->route('roles.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al editar el rol';
            $mode = 'error';
            if ($e->getCode() == 23000) {
                $message = "El rol '$name' ya existe";
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => $mode,
                config('constants.TOASTR_MESSAGE') => $message,
                config('constants.TOASTR_TITLE') => $title
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $name = $role->name;
        try {
            $role->delete();
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El rol '$name' fue eliminado con éxito",
                config('constants.TOASTR_TITLE') => 'Rol eliminado'
            ]);
        } catch (QueryException $e) {
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'error',
                config('constants.TOASTR_MESSAGE') => 'Ocurrió algún error inesperado, intente más tarde',
                config('constants.TOASTR_TITLE') => 'Error al eliminar el rol'
            ]);
        }
        return redirect()->route('roles.index');
    }
}
