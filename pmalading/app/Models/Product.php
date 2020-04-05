<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    // //
    protected $table = "usedName";

    // public function shopName()
    // {
    //     return $this->hasOne(shopName::class, 'shopId', 'shopId');
    // }
    public function goods()
    {
        $UU = time()*1000;
        return $this->hasMany(goods::class, 'usedNo', 'usedNo')->where('endTime','>',$UU);


    }
    public function theprice()
    {
        // $UU = time()*1000;
        return $this->hasOne(theprice::class, 'usedNo', 'usedNo');
    }
}
