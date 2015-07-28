<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes included in the model's JSON form.
     *
     * @var array
     */
    protected $fillable = array('name', 'country_code', 'icon');

    /**
     * The rules for country fields, automatic validation.
     *
     * @var array
     */
    private $rules = array(
        'name' => 'required|min:2',
        'country_code' => 'required|min:2'
    );

    public function getImageUrl( $withBaseUrl = false )
    {
        if(!$this->icon) return NULL;

        $imgDir = '/images/countries/' . $this->id;
        $url = $imgDir . '/' . $this->icon;

        return $withBaseUrl ? URL::asset( $url ) : $url;
    }
}
