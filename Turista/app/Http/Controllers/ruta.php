<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ruta extends Controller
{
    public function nuevap1()
    {
    	$consult=DB::table('tipologia')
					->select('nombre')
					->distinct()
					->join('poi_tipologia','poi_tipologia.fk_id_tipologia','=','tipologia.id_tipologia')
					->orderBy('nombre','asc')
					->where('poi_tipologia.estado','1')
					->get();
		return view('nuevar')->with('tp',$consult);
    }
    public function nuevap2()
    {
    	$tipol=request('tip');
    	$t=request('time');
    	if(isset($tipol) && isset($t)){
	    	session(['tip' => $tipol]);
		 	session(['time' => $t]);
    	}else{
	    	session()->forget('tip');
		 	session()->forget('time');
		 	return back()->with('status','Por favor rellene todos los campos');
    	}
    	$d=request('del');
    	if ($d=='0') {
    		$consult=DB::table('municipio')
					->select('municipio.nombre')
					->distinct()
					->join('poi','poi.fk_id_municipio','=','municipio.id_municipio')
					->orderBy('nombre','asc')
					->get();
    	return view('mun')->with('mun',$consult);
    	}else if ($d=='1') {
    		$consult=DB::select("select poi.id_poi,poi.nombre,string_agg(tipologia.nombre,',') as tipologia ,poi.coordenadax,poi.coordenaday
				from poi,poi_tipologia,tipologia 
				where poi.id_poi=poi_tipologia.fk_id_poi 
				and poi_tipologia.fk_id_tipologia=tipologia.id_tipologia
				group by poi.id_poi
				order by poi.id_poi asc");
    		$s;
            $b=1;
            $nom='';
           
    		$tipolo=session('tip');
    		
    		foreach ($consult as $poi) {
    		for($i=0; $i < count($tipolo) ; $i++) {
    			if(preg_match('/'.$tipolo[$i].'/i', $poi->tipologia)){
                      $s[]=$poi; 
    				
                    }
                   
    		}
    		}

    		$a = array_values(array_map("unserialize", array_unique(array_map("serialize", $s))));
    		$count=1;
		return view('map')->with('pois',$a);
    	}
    }
    public function nuevap3()
    {
     $mun=request('mun');
     if(!is_null($mun)){
       
     $mun="'".implode("','",$mun)."'";
     $tipo="'".implode("','",session('tip'))."'";
     
       $consult=DB::select("select poi.id_poi,poi.nombre,string_agg(tipologia.nombre,',') as tipologia,max(			 municipio.nombre) as mun
				from poi,poi_tipologia,tipologia,municipio
				where poi.id_poi=poi_tipologia.fk_id_poi 
				and poi_tipologia.fk_id_tipologia=tipologia.id_tipologia
				and poi.fk_id_municipio=municipio.id_municipio
				and municipio.nombre in (".$mun.")
				and tipologia.nombre in (".$tipo.")
				group by poi.id_poi
				order by poi.id_poi asc");
    		$sitios;
    	foreach ($consult as $value) {
    	$sitios[]=$value->id_poi;
    	}
    	
    	$sit=implode(",",$sitios);
        if (is_null(session('sitios'))) {
        	session(['sitios' => $sit]);
        }else{
        session()->forget('sitios');
	    session(['sitios' => $sit]);
		}
              $consult2=DB::table('formula')
        		 ->select('nombre','peso','id_formula')
        		 ->get();
        return view('ecu')->with('f',$consult2);
    	}
    }
        public function nuevap3b()
    {
        $sitios=request('pois');
        if(isset($sitios)){
	    	session(['sitios' => $sitios]);
    	}else{
	    	session()->forget('sitios');
		 	return back()->with('status','Por favor rellene todos los campos');
    	}
        $consult=DB::table('formula')
        		 ->select('nombre','peso','id_formula')
        		 ->get();
      return view('ecu')->with('f',$consult);
    }
    public function nuevap4()
    {
        $sitios=session('sitios');
        $pesos=request('pesos');
        $id=request('id');
        $consult=DB::select('select poi.id_poi,poi.tiempoestancia,poi.nombre as pn,formula.nombre,formula.id_formula,poi_formula.valor,poi.coordenaday,poi.coordenadax
			from poi,formula,poi_formula
			where poi.id_poi=poi_formula.fk_id_poi
			and poi_formula.fk_id_formula=formula.id_formula
			and poi.id_poi in('.$sitios.')');
        $val;
        $tiempo;
        foreach ($consult as $p) {
        	for ($i=0; $i <count($id) ; $i++) { 
        	if($p->id_formula==$id[$i]){
        	 $val[]=array('id' => $p->id_poi,
        	 'nombre'=>$p->pn,
        	 'item'=>$p->nombre,
        	 'res'=>$pesos[$i]*$p->valor,
        	 'tiempo'=>$p->tiempoestancia,
        	 'coordenadax'=>$p->coordenadax,
        	 'coordenaday'=>$p->coordenaday
        	);
        	}
        	}
        }
       
        $resultado=[];
        $resultado_id=[];

        
      foreach($val as $data){
        if(!in_array($data['id'],$resultado_id)){
            $resultado[$data['id']] = $data['res'];
            $resultado_id[] = $data['id'];
            $tiempo[$data['id']]=array('tiempo'=>$data['tiempo'],
        							   'cx'=>$data['coordenadax'],
        							   'cy'=>$data['coordenaday'],
        							   'nombre'=>$data['nombre']);
        }else{
            $resultado[$data['id']] += $data['res'];
            $tiempo[$data['id']]=array('tiempo'=>$data['tiempo'],
        							   'cx'=>$data['coordenadax'],
        							   'cy'=>$data['coordenaday'],
        							   'nombre'=>$data['nombre']);
        }

    }

   arsort($resultado);
   $res;
  foreach ($resultado as $key => $value) {
  	$res[]=$key;
  }
  return view('rutat')->with('pun',$res)->with('t',$tiempo);
    }
    public function nuevap5()
    {
    	echo "Guayaba";
    }
}
