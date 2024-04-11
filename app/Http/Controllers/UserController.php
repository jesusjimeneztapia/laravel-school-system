<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserPutRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->where('state', '1');
        $data = [];
        foreach ($users as $i => $user) {
            $nro = $i + 1;

            $btnDetails =
                '<a href="'.route('users.show', ['user'=>$user]).'" class="btn btn-xs btn-default text-info mx-1 shadow" title="Detalles">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';
            $btnEdit =
                '<a href="'.route('users.edit', ['user'=>$user]).'" class="btn btn-xs btn-default text-warning mx-1 shadow" title="Editar">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
            $btnDelete = "
                <button class='btn btn-xs btn-default text-danger mx-1 shadow' title='Eliminar' onclick='answer($user, \"".route('users.destroy', $user)."\")'>
                    <i class='fa fa-lg fa-fw fa-trash'></i>
                </button>";
            setlocale(LC_TIME, 'es_ES.UTF-8');

            $date = date('l j F Y', strtotime($user->created_at));
            $stateColor = $user->state == '1' ? 'text-success' : 'text-danger';
            $stateLabel = $user->state == '1' ? 'Activo' : 'Inactivo';
            $state = "<span class='$stateColor'>$stateLabel</span>";
            $data[] = [$nro, $user->name, $user->role()->get('name')[0]->name, $user->email, $date, $state, '<nobr>'.$btnDetails.$btnEdit.$btnDelete.'</nobr>'];
        }
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all()->where('state', '1');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPostRequest $request)
    {
        $password = $request->input('password');
        $repeated_password = $request->input('repeated_password');

        if ($password != $repeated_password) {
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'error',
                config('constants.TOASTR_MESSAGE') => 'Las contraseñas no coinciden, intentelo de nuevo',
                config('constants.TOASTR_TITLE') => 'Error al crear usuario'
            ]);
            return redirect()->back()->withInput()->withErrors(['repeated_password' => 'La contraseña no coincide.']);
        }

        $password = password_hash($password, PASSWORD_BCRYPT);
        $name = $request->input('name');
        $email = $request->input('email');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->state = "1";
        $user->role_id = $request->input('role_id');

        try {
            $user->save();
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El usuario '$name' fue creado con éxito",
                config('constants.TOASTR_TITLE') => 'Nuevo usuario creado'
            ]);
            return redirect()->route('users.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al crear el usuario';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                $message = "El usuario con el correo electrónico '$email' ya existe";
                $errors = ['email' => 'El correo electrónico ya está registrado.'];
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => $mode,
                config('constants.TOASTR_MESSAGE') => $message,
                config('constants.TOASTR_TITLE') => $title
            ]);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all()->where('state', '1');
        $role_id = $user->role()->get('id')[0]->id;
        return view('admin.users.edit', compact('user', 'roles', 'role_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPutRequest $request, User $user)
    {
        $password = $request->input('password');
        if ($password) {
            $repeatedPassword = $request->input('repeated_password');
            if ($password != $repeatedPassword) {
                $request->session()->put(config('constants.TOASTR'), [
                    config('constants.TOASTR_MODE') => 'error',
                    config('constants.TOASTR_MESSAGE') => 'Las contraseñas no coinciden, intentelo de nuevo',
                    config('constants.TOASTR_TITLE') => 'Error al actualizar usuario'
                ]);
                return redirect()->back()->withInput()->withErrors(['repeated_password' => 'La contraseña no coincide.']);
            }
            $user->password = password_hash($password, PASSWORD_BCRYPT);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->name = $name;
        $user->email = $email;

        try {
            $user->save();
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El usuario '$name' fue actualizado con éxito",
                config('constants.TOASTR_TITLE') => 'Usuario actualizado'
            ]);
            return redirect()->route('users.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al actualizar el usuario';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                $message = "El usuario con el correo electrónico '$email' ya existe";
                $errors = ['email' => 'El correo electrónico ya está registrado.'];
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => $mode,
                config('constants.TOASTR_MESSAGE') => $message,
                config('constants.TOASTR_TITLE') => $title
            ]);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $email = $user->email;
        $name = $user->name;
        try {
            $user->delete();
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El usuario '$name' con el correo electrónico '$email' fue eliminado con éxito",
                config('constants.TOASTR_TITLE') => 'Usuario eliminado'
            ]);
        } catch (QueryException $e) {
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'error',
                config('constants.TOASTR_MESSAGE') => 'Ocurrió algún error inesperado, intente más tarde',
                config('constants.TOASTR_TITLE') => 'Error al eliminar el usuario'
            ]);
        }
        return redirect()->route('users.index');
    }
}
