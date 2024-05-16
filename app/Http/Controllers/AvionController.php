<?php

namespace App\Http\Controllers;

use App\Http\Resources\AvionR;
use App\Models\Avion;
use App\Models\Let;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AvionController extends BaseController
{

    public function index()
    {
        $avioni = Avion::all();
        return $this->porukaOUspehu(AvionR::collection($avioni), 'Prikazani su svi avioni.');
    }


    public function store(Request $request)
    {

       /* $request->validate([
            'proizvodjacID' => 'required',
            'model' => 'required',
            'tipID' => 'required',
            'opis' => 'required'
        ]);*/

        $input = $request->all();
        $validator = Validator::make($input, [
            'proizvodjacID' => 'required',
            'model' => 'required',
            'tipID' => 'required',
            'opis' => 'required'
        ]);
        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $avion = Avion::create($input);

        return $this->porukaOUspehu(new AvionR($avion), 'Kreiran je novi avion.');
    }


    public function show($ID)
    {
        $avion = Avion::find($ID);

        if (is_null($avion)) {
            return $this->porukaOGresci('Avion sa zadatim id-em ne postoji.');
        }
        return $this->porukaOUspehu(new AvionR($avion), 'Avion sa zadatim id-em je prikazan.');
    }


    public function update(Request $request, $ID)
    {
        $avion = Avion::find($ID);
        if (is_null($avion)) {
            return $this->porukaOGresci('Avion sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'proizvodjacID' => 'required',
            'model' => 'required',
            'tipID' => 'required',
            'opis' => 'required'
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $avion->proizvodjacID = $input['proizvodjacID'];
        $avion->model = $input['model'];
        $avion->tipID = $input['tipID'];
        $avion->opis = $input['opis'];
        $avion->save();

        return $this->porukaOUspehu(new AvionR($avion), 'Podaci o avionu su azurirani.');
    }

    public function destroy($ID)
    {
        $avion = Avion::find($ID);
        if (is_null($avion)) {
            return $this->porukaOGresci('Avion sa zadatim id-em ne postoji.');
        }

        $povezaniLetovi = Let::where('avionID', $avion->id)->exists();

        if ($povezaniLetovi) {
            return $this->porukaOGresci('Ne možete obrisati avion jer postoje povezani letovi.');
        }

        $avion->delete();

        return $this->porukaOUspehu([], 'Avion je obrisan.');
    }
}
