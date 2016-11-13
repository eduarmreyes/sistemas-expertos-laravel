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
     * Delete persona from the DB
     * Return json with success or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function deletePersonaById(Request $request) {
        $bIsNew = false;
        if ($request->id !== "undefined") {
            $oPersona = Persona::find($request->id);
            $oPersona->Activo =  false;
            $bPersonaSaved = $oPersona->save();
        } else {
            $aResponse = \Response::json(array(
                "reason" => "Id {$request->id} not found",
                "success" => false
            ));
        }


        $aResponse = \Response::json(array(
            "persona" => $oPersona,
            "success" => $bPersonaSaved
        ));

        return $aResponse;
    }

    /**
     * Return json with their Personas from DB.
     *
     * @return Response
     */
    public function getPersonas(Request $request) {
        $aWhere = [["Activo", "=", 1]];
        if ($request->id) {
            array_push($aWhere, ["id", "=", $request->id]);
        }
        // get personas from user
        $personas = DB::table("personas")
            ->where($aWhere)
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
        $bIsNew = false;
        if ($request->id !== "undefined") {
            $oPersona = Persona::find($request->id);
        } else {
            $oPersona = new Persona;
            $bIsNew = true;
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
            "is_new" => $bIsNew,
            "persona" => $oPersona,
            "success" => $bPersonaSaved
        ));

        return $aResponse;
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