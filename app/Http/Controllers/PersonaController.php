<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Persona;

/**
 * Class PersonaController
 * @package App\Http\Controllers
 */
class PersonaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        return view('personas');
    }

    /**
     * Return json with their Personas from DB.
     *
     * @return Response
     */
    public function getPersonas() {
        // get personas from user
        $personas = DB::table("personas")
            ->where([
                ["Activo", "=", 1]
            ])
            ->get();
        $aResponse = \Response::json(array(
            "personas" => $personas,
            "success" => true
        ));
        return $aResponse;
    }

    /**
     * Save persona to the DB
     * Return json with new or just updated persona schema
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function savePersonas(Request $request) {
        $this->validatePersona($request);
        if ($request->id !== "undefined") {
            $oPersona = Persona::find($request->id);
        } else {
            $oPersona = new Persona;
        }

        $oPersona->Nombres = $request->txtPersonaNombre;
        $oPersona->Apellidos = $request->txtPersonaApellidos;
        $oPersona->FechaNacimiento =  date("Y-m-d", strtotime($request->txtPersonaBirthday));;
        $oPersona->Correo =  $request->txtPersonaCorreo;
        $oPersona->Estatura =  $request->txtPersonaEstatura;
        $oPersona->Peso =  $request->txtPersonaPeso;
        $oPersona->Sexo =  $request->chkPersonaSexo;
        $oPersona->Activo =  true;
        $bPersonaSaved = $oPersona->save();

        $aResponse = \Response::json(array(
            "persona" => $oPersona,
            "success" => $bPersonaSaved
        ));

        return $aResponse;
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validatePersona(Request $request)
    {
        $this->validate($request, [
            "txtPersonaNombre" => 'required',
            'txtPersonaApellidos' => 'required',
            'txtPersonaBirthday' => 'required',
            'txtPersonaCorreo' => 'required|email',
            'txtPersonaEstatura' => 'required|numeric',
            'txtPersonaPeso' => 'required|numeric',
            'chkPersonaSexo' => 'required',
        ]);
    }

}