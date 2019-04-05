<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class URLShort
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class URLShort extends Model
{
    protected $table = 'url';
    protected $primaryKey = 'id';

    protected $fillable = ['url', 'short', 'visited', 'ex_time'];

}
