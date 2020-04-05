<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class goods extends Model
{
    //
    public function usedName()
    {

        return $this->hasOne(usedName::class, 'usedNo', 'usedNo');
    }
    //     public function theprice()
    // {
    //     // $UU = time()*1000;
    //     return $this->hasone(theprice::class, 'usedNo', 'usedNo');
    // }
    public function theprice()
    {
        // $UU = time()*1000;
        return $this->hasOne(theprice::class, 'usedNo', 'usedNo');
    }
}
