<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turista extends Model
{
	protected $table='turista';
	protected $fillable=['prnombre','sgnombre','prapellido','sgapellido','alias','contrasena','sexo','imagen','estado'];
	public $timestamps = false;
	protected $primaryKey = 'id_turista';
    use HasFactory;
}
