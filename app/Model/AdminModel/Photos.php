<?php

namespace App\Model\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $table = 'uploaded_photos';

    protected $primaryKey = 'id';
}
