<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function getMenu() {
        // get menu for user
        $menu = DB::table("menusistema")
            ->where([
                ["Activo", "=", 1]
            ])
            ->orderBy("Nivel")
            ->get();

        $aResponse = \Response::json(array(
            "success" => true,
            "menu" => $menu
        ));

        return $aResponse;

    }
}