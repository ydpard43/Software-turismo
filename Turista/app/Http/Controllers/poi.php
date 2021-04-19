<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class poi extends Controller
{
public function consult()
{
	$consult = DB::table('poi')
					->select('poi.nombre as nomp','municipio.nombre as nomm','imagen')
					->join('municipio','municipio.id_municipio','=','poi.fk_id_municipio')
					->orderBy('poi.nombre','asc')
					->get();
	$consult2=DB::table('municipio')
					->select('nombre')
					->orderBy('nombre','asc')
					->get();
	return view('poiss')->with('poi',$consult)->with('municipios',$consult2);
}
public function ind($id)
{
		$consult = DB::select("select poi.nombre as nomp,poi.id_poi,municipio.nombre as nomm,imagen,tipologia.nombre,poi.descripcion,poi.costo from poi,municipio,tipologia,poi_tipologia where poi.nombre='".$id."' and municipio.id_municipio=poi.fk_id_municipio 
			and poi.id_poi=poi_tipologia.fk_id_poi and poi_tipologia.fk_id_tipologia=tipologia.id_tipologia");
		$consult2=DB::table('poi_turista')
						->select('poi_turista.opinion','poi_turista.estrellas','turista.alias','turista.id_turista')
						->join('turista','turista.id_turista','=','poi_turista.fk_id_turista')
						->join('poi','poi.id_poi','=','poi_turista.fk_id_poi')
						->where('poi_turista.fk_id_poi',$consult[0]->id_poi)
						->get();

		$s[0]=0;
		$con[0]=0;
		foreach ($consult2 as $estrellas) {

			$s[0]+=$estrellas->estrellas;
			$con[0]+=1;
		}
		if($s[0]!=0 && $con[0]!=0){
		$prom=round($s[0]/$con[0]);
	    }else {
	    $prom=0;
	    }
	return view('verp')->with('poi',$consult)->with('opiniones',$consult2)->with('estrellas',$prom);
}
public function opin()
{
    $consulta=DB::table('poi_turista')
    		->insert([
    			'opinion'=>request('op'),
    			'estrellas'=>request('estrellas'),
    			'fk_id_poi'=>request('poi'),
    			'fk_id_turista'=>session('id')
    		]);
    return back();
}
public function opatc()
{
	if (null==request('estrellas')) {
		$estrellas=0;
	}else{
		 $estrellas=request('estrellas');
	}
	$consult= DB::table('poi_turista')
				->where('poi_turista.fk_id_turista',session('id'))
				->where('poi_turista.fk_id_poi',request('poi'))
				->update(['estrellas'=>$estrellas,
						  'opinion'=>request('op')]);
	return back();

}

}
