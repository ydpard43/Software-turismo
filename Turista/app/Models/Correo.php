<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
	protected $table='correoturista';
	protected $fillable=['fk_id_turista','id_correoturista','estado'];
	public $timestamps = false;
	protected $primaryKey = 'fk_id_turista';
    use HasFactory;
}
