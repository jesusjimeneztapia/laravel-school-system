<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\settings\institutions\InstitutionPostRequest;
use App\Http\Requests\settings\institutions\InstitutionPutRequest;
use App\Models\settings\Institution;
use Illuminate\Database\QueryException;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institutions = Institution::all()->where('state', '1');
        $data = [];
        foreach ($institutions as $i => $institution) {
            $nro = $i + 1;
            $name = $institution->name;

            $btnDetails =
                '<a href="'.route('settings.institutions.show', ['institution'=>$institution]).'" class="btn btn-xs btn-default text-info mx-1 shadow" title="Detalles">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';
            $btnEdit =
                '<a href="'.route('settings.institutions.edit', ['institution'=>$institution]).'" class="btn btn-xs btn-default text-warning mx-1 shadow" title="Editar">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
            $btnDelete = "
                <button class='btn btn-xs btn-default text-danger mx-1 shadow' title='Eliminar' onclick='answer(\"$name\", \"".route('settings.institutions.destroy', $institution)."\")'>
                    <i class='fa fa-lg fa-fw fa-trash'></i>
                </button>";

            $date = date('l j F Y', strtotime($institution->created_at));
            $stateColor = $institution->state == '1' ? 'text-success' : 'text-danger';
            $stateLabel = $institution->state == '1' ? 'Activo' : 'Inactivo';
            $state = "<span class='$stateColor'>$stateLabel</span>";

            $logo = "";
            if ($institution->logo) {
                $url = asset($institution->logo);
                $logo = "<img src='$url' class='img-md h-auto' />";
            }

            $null = '<span class="text-secondary">-</span>';
            $data[] = [$nro, $institution->name, $logo, $institution->direction, $institution->phone ?? $null, $institution->cellphone ?? $null, $institution->email ?? $null, $date, $state, '<nobr>'.$btnDetails.$btnEdit.$btnDelete.'</nobr>'];
        }
        return view('admin.settings.institutions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstitutionPostRequest $request)
    {
        $name = $request->input('name');

        $institution = new Institution();
        $institution->name = $name;
        $institution->email = $request->input('email');
        $institution->phone = $request->input('phone');
        $institution->cellphone = $request->input('cellphone');
        $institution->direction = $request->input('direction');

        $logo = $request->file('logo');
        $logoPath = null;
        if ($logo) {
            $ext = $logo->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $path = 'images/institutions/';
            $logo->move($path, $filename);
            $institution->logo = $path.$filename;
            $logoPath = $institution->logo;
        }

        try {
            $institution->save();
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "La institución '$name' fue creada con éxito",
                config('constants.TOASTR_TITLE') => 'Nueva institución creada'
            ]);
            return redirect()->route('settings.institutions.index');
        } catch (QueryException $e) {
            if ($logoPath) {
                unlink($logoPath);
            }
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al crear la institución';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                $message = "La institución con el nombre '$name' ya existe";
                $errors = ['name' => 'La institución ya está registrada.'];
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
    public function show(Institution $institution)
    {
        return view('admin.settings.institutions.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institution $institution)
    {
        return view('admin.settings.institutions.edit', compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstitutionPutRequest $request, Institution $institution)
    {
        $name = $request->input('name');

        $institution->name = $name;
        $institution->email = $request->input('email');
        $institution->phone = $request->input('phone');
        $institution->cellphone = $request->input('cellphone');
        $institution->direction = $request->input('direction');

        $logo = $request->file('logo');
        $logoPath = null;
        $oldLogo = null;
        if ($logo) {
            $oldLogo = $institution->logo;
            $ext = $logo->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $path = 'images/institutions/';
            $logo->move($path, $filename);
            $institution->logo = $path.$filename;
            $logoPath = $institution->logo;
        }

        try {
            $institution->save();
            if ($oldLogo && $oldLogo != 'images/logo.webp') {
                unlink($oldLogo);
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "La institución '$name' fue actualizada con éxito",
                config('constants.TOASTR_TITLE') => 'Institución actualizada'
            ]);
            return redirect()->route('settings.institutions.index');
        } catch (QueryException $e) {
            if ($logoPath) {
                unlink($logoPath);
            }
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al actualizar la institución';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                $message = "La institución con el nombre '$name' ya existe";
                $errors = ['name' => 'La institución ya está registrada.'];
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
    public function destroy(Institution $institution)
    {
        $name = $institution->name;
        $logo = $institution->logo;
        try {
            $institution->delete();
            if ($logo) {
                unlink($logo);
            }
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "La institución '$name' fue eliminada con éxito",
                config('constants.TOASTR_TITLE') => 'Institución eliminada'
            ]);
        } catch (QueryException $e) {
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'error',
                config('constants.TOASTR_MESSAGE') => 'Ocurrió algún error inesperado, intente más tarde',
                config('constants.TOASTR_TITLE') => 'Error al eliminar la institución'
            ]);
        }
        return redirect()->route('settings.institutions.index');
    }
}
