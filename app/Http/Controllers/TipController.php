<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipR;
use App\Models\Tip;
use App\Models\Avion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipController extends BaseController
{
    public function index()
    {
        $tipovi = Tip::all();
        return $this->porukaOUspehu(TipR::collection($tipovi), 'Prikazani su svi tipovi.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tip' => 'required',
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $tip = Tip::create($input);

        return $this->porukaOUspehu(new TipR($tip), 'Kreiran je novi tip.');
    }


    public function show($ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->porukaOGresci('Tip sa zadatim id-em ne postoji.');
        }
        return $this->porukaOUspehu(new TipR($tip), 'Tip sa zadatim id-em je prikazan.');
    }


    public function update(Request $request, $ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->porukaOGresci('Tip sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'tip' => 'required',
        ]);

        if($validator->fails()){
            return $this->porukaOGresci($validator->errors());
        }

        $tip->tip = $input['tip'];
        $tip->save();

        return $this->porukaOUspehu(new TipR($tip), 'Podaci o tipu su azurirani.');
    }

    public function destroy($ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->porukaOGresci('Tip sa zadatim id-em ne postoji.');
        }

        $povezaniAvioni = Avion::where('tipID', $tip->id)->exists();

        if ($povezaniAvioni) {
            return $this->porukaOGresci('Ne možete obrisati tip jer postoje povezani avioni.');
        }

        $tip->delete();
        return $this->porukaOUspehu([], 'Tip je obrisan.');
    }

}
