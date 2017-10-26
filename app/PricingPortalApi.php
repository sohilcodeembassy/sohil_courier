<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricingPortalApi extends Model
{
	protected $table = 'pricing_portal_api';

    public function api()
    {
        return $this->belongsTo('App\Api');
    }
}
