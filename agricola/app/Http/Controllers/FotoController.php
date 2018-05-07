<?php

namespace App\Http\Controllers;

use App\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use auth;
class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $this->validate($request, [
            'images' => 'mimes:jpeg,bmp,png', //only allow this type extension file.
        ]);

        $file = $request->file('images');
        $extension=$file->getClientOriginalExtension();
        // image upload in public/upload folder.
        $file->move('uploads/anuncio/'.$fotoend.'/', $file->getClientOriginalName());*/

        //$fotoend=$a->id;
        if ($request->hasFile('images')){

                $this->validate($request, [
                    'images' => 'mimes:jpeg,bmp,png', //only allow this type extension file.
                ]);

              
                //$extension=$file->getClientOriginalExtension();

                $file = $request->file('images')->store('Usuarios/'.Auth::User()->id);
            
        }


        return redirect()->back();
    }

    public function storeuser (Request $request,$fotoend)
    {
        //

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        //
        return redirect()->route('anuncio.index')->with('message', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        //
    }
}
