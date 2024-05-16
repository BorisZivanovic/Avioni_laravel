<?php

namespace App\Http\Controllers;

use App\Models\Let;
use App\Http\Controllers\Controller;
use App\Http\Resources\LetR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class LetController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $letovi = Let::all();
        return $this->porukaOUspehu(LetR::collection($letovi), 'Prikazani su svi letovi.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'polaziste' => 'required',
            'odrediste' => 'required',
            'datum' => 'required',
            'avionID' => 'required'
        ]);
        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $let = Let::create($input);

        return $this->porukaOUspehu(new LetR($let), 'Kreiran je novi let.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Let  $let
     * @return \Illuminate\Http\Response
     */
    public function show($ID)
    {
        $let = Let::find($ID);

        if (is_null($let)) {
            return $this->porukaOGresci('Let sa zadatim id-em ne postoji.');
        }
        return $this->porukaOUspehu(new LetR($let), 'Let sa zadatim id-em je prikazan.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Let  $let
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID)
    {
        $let = Let::find($ID);
        if (is_null($let)) {
            return $this->porukaOGresci('Let sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'polaziste' => 'required',
            'odrediste' => 'required',
            'datum' => 'required',
            'avionID' => 'required'
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $let->polaziste = $input['polaziste'];
        $let->odrediste = $input['odrediste'];
        $let->datum = $input['datum'];
        $let->avionID = $input['avionID'];
        $let->save();

        return $this->porukaOUspehu(new LetR($let), 'Podaci o letu su azurirani.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Let  $let
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID)
    {

        if (Gate::allows('manage-users')) {

            $let = Let::find($ID);
            if (is_null($let)) {
                return $this->porukaOGresci('Let sa zadatim id-em ne postoji.');
            }

            $let->delete();

            return $this->porukaOUspehu([], 'Let je obrisan.');

        } else {
            abort(403, 'Nemate dozvolu da obrišete let, to mogu samo administratori.');
        }
        
    }
}
