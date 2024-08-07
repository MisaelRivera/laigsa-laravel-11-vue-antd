<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'ordenes';
    protected $dateFormat = 'H:i:s';
    protected $fillable = [
        'folio',
        'id_cliente',
        'numero_muestras',
        'direccion_muestreo',
        'fecha_recepcion',
        'hora_recepcion',
        'aguas_alimentos',
        'cesavedac',
        'area_recepcion_muestras_limpia',
        'observaciones',
        'temperatura',
        'numero_cotizacion',
        'numero_termometro',
    ];

    protected $casts = [
        'hora_recepcion' => 'datetime:H:i', // Casts time to Carbon instance,
        'cesavedac' => 'boolean',
        'area_recepcion_muestras_limpia' => 'boolean',
    ];

    public $timestamps = false;
    use HasFactory;

    public function cliente ()
    {
        return $this->belongsTo(Client::class, 'id_cliente', 'id');
    }

    public function siralab () {
        return $this->hasOne(Siralab::class, 'id_orden');
    }

    /*public function muestras ()
    {
        if ($this->aguas_alimentos === 'Aguas') {
            return $this->hasMany(WaterSample::class, 'id_orden');
        } else {
            return $this->hasMany(FoodSample::class, 'id_orden');
        }
    }*/

    public function muestras_aguas () {
        return $this->hasMany(WaterSample::class, 'id_orden');
    }

    public function muestras_alimentos () {
        return $this->hasMany(FoodSample::class, 'id_orden');
    }

    /*protected function supervision (): Attribute {
        return Attribute::make(
            get: function ($value) {
               $result = DB::table('ordenes')
                ->selectRaw("IF((SELECT cesavedac FROM ordenes WHERE id = ?) = 1 OR (SELECT COUNT(id) FROM muestras WHERE muestras.id_orden = ? AND muestras.muestreador = 'Cliente') > 0, true, false) as result", [$this->attributes['id'], $this->attributes['id']])
                ->first();
                if ((int)$result->result === 1) {
                    return false;
                } else {
                    return $value;
                }
            }
        );
    } */

    public static function getOrderWithLastFolio()
    {
        return static::with(['cliente'])
            ->orderBy('fecha_recepcion', 'desc')
            ->orderBy('hora_recepcion', 'desc')
            ->orderBy('folio', 'desc')->first();
    }
}
