<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class theprice extends Model
{
    //
    protected $table = "theprice";
    //
    public function usedName()
    {
        // return $this->hasOne(usedName::class, 'usedNo', 'usedNo');
        return $this->belongsTo(usedName::class, 'usedNo', 'usedNo');

    }
}
