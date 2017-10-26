<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function user_packages(){
        return $this->hasMany('App\UserPackages');
    }

    public function package_size(){
        return $this->hasMany('App\PackageSize');
    }

    public function package_type_re(){
        return $this->hasOne('App\PackageTypes');
    }

}
