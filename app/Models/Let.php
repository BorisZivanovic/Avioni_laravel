<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Let extends Model
{
    use HasFactory;

    protected $fillable = ['polaziste', 'odrediste', 'datum', 'avionID'];

    protected $table = 'letovi';

}
