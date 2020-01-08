<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['orderdate', 'username', 'firstname', 'surname', 'email', 'address', 'phone', 'city', 'county', 'postcode', 'ordertotal'];
}