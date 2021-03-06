<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejemplare extends Model
{
    public function imagenes()
    {
        return $this->hasMany(Imagene::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, "ejemplar_id");
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
