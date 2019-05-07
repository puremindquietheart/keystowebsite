<?php

namespace App\Model\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Bikes extends Model
{
    protected $table = 'bike_details';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
