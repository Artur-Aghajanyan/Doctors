<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientsModel extends Model
{
    //
    protected $table = 'data';
    protected $fillable = array('name', 'surname', 'phone', 'doctor', 'time', 'type', 'date');

}
