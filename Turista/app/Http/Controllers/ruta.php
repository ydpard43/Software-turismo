<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Ruta;
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
    		$consult=DB::select("select poi.id_poi,poi.nombre,string_agg(tipologia.nombre,',') as tipologia ,poi.coordenadax,poi.coordenaday,max(imagenpoi.id_imagenpoi) as img
				from poi,poi_tipologia,tipologia,imagenpoi 
				where poi.id_poi=poi_tipologia.fk_id_poi 
				and poi_tipologia.fk_id_tipologia=tipologia.id_tipologia
        and imagenpoi.fk_id_poi=poi.id_poi
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
        		 ->select('nombre','peso','id_formula','valormaximo')
        		 ->get();
        return view('ecu')->with('f',$consult2);
    	}else{
                $consult=DB::table('municipio')
          ->select('municipio.nombre')
          ->distinct()
          ->join('poi','poi.fk_id_municipio','=','municipio.id_municipio')
          ->orderBy('nombre','asc')
          ->get();
      return view('mun')->with('mun',$consult)->with('status','Seleccione uno o mas municipios');
       
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
        		 ->select('nombre','peso','id_formula','valormaximo')
        		 ->get();
    return view('ecu')->with('f',$consult);
    }
    public function nuevap4()
    {
        $sitios=session('sitios');
        $pesos=request('pesos');
        $id=request('id');
        $consult=DB::select('select poi.id_poi,poi.tiempoestancia,poi.nombre as pn,formula.nombre,formula.id_formula,poi_formula.valor,poi.coordenaday,poi.coordenadax,imagenpoi.id_imagenpoi
			from poi,formula,poi_formula,imagenpoi
			where poi.id_poi=poi_formula.fk_id_poi
			and poi_formula.fk_id_formula=formula.id_formula
        and imagenpoi.fk_id_poi=poi.id_poi
			and poi.id_poi in('.$sitios.')');
        $val;
        $tiempo;
          $tt=session('time');
         $pp=[];

        foreach ($consult as $p) {
        	for ($i=0; $i <count($id) ; $i++) { 
        	if($p->id_formula==$id[$i]){
        	 $val[]=array('id' => $p->id_poi,
        	 'nombre'=>$p->pn,
        	 'item'=>$p->nombre,
        	 'res'=>$pesos[$i]*$p->valor,
        	 'tiempo'=>$p->tiempoestancia,
        	 'coordenadax'=>$p->coordenadax,
        	 'coordenaday'=>$p->coordenaday,
           'img'=>$p->id_imagenpoi
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
        							   'nombre'=>$data['nombre'],
                         'img'=>$data['img']);
        }else{
            $resultado[$data['id']] += $data['res'];
            $tiempo[$data['id']]=array('tiempo'=>$data['tiempo'],
        							   'cx'=>$data['coordenadax'],
        							   'cy'=>$data['coordenaday'],
        							   'nombre'=>$data['nombre'],
                         'img'=>$data['img']
                       );
        }

    }
   arsort($resultado);
   $res;
  foreach ($resultado as $key => $value) {

  	$res[]=$key;
  }
  
  foreach ($res as $key=>$value) {
 
 if ($key==0) {
 if ($tt-$tiempo[$value]['tiempo']>=0) {
    $tt=$tt-$tiempo[$value]['tiempo'];
    $pp[]=$value;
    $coor1=$tiempo[$value]['cy'].",".$tiempo[$value]['cx'];
 }
 }else{
    $coor2=$tiempo[$value]['cy'].",".$tiempo[$value]['cx'];
    $data = file_get_contents('http://0.0.0.0:5000/route/v1/car/'.$coor1.';'.$coor2, null, stream_context_create([
                'http' => [
                'protocol_version' => 1.1,
                'header'           => [
                'Connection: close',],],]));
     $data=json_decode($data);
    if (($tt-round($data->routes[0]->duration/60)-$tiempo[$value]['tiempo'])>=0) {
    $pp[]=$value;
    $tt=$tt-round($data->routes[0]->duration/60)-$tiempo[$value]['tiempo'];
}
$coor1=$tiempo[$value]['cy'].",".$tiempo[$value]['cx'];

}
  }
  return view('rutat')->with('pun',$pp)->with('t',$tiempo);
    }
    public function nuevap5()
    {
    	$sitios=request('pois');
        $consult=DB::select('select poi.id_poi,poi.tiempoestancia,poi.nombre as pn,poi.coordenaday as cy,poi.coordenadax as cx
            from poi where poi.id_poi in('.$sitios.')');
        $poi=explode(",",$sitios);
        $cd=[];
        $pois=array();
        $ban=9999999;
        $vmin=[];
        for ($i=0; $i <count($poi); $i++) { 
        foreach ($consult as $key) {
        if ($poi[$i]==$key->id_poi) {
        $cd[]=$key->cy.','.$key->cx;
        echo " cx ".$key->cx.",".$key->cy." poi ".$key->id_poi;
        echo "<br>";
        }
        }
        }
        for($a=0;$a<count($cd);$a++){
        for ($b=0;$b<count($cd);$b++) { 
        if ($a==$b) {
        $pois[$a][$b]=-1;
        }else{
        $data = file_get_contents('http://0.0.0.0:5000/route/v1/car/'.$cd[$a].';'.$cd[$b], null, stream_context_create([
                'http' => [
                'protocol_version' => 1.1,
                'header'           => [
                'Connection: close',],],]));
        $data=json_decode($data);
        
        $pois[$a][$b]=$data->routes[0]->distance; 
    }
        }
        
        }
      for ($i=0; $i <count($pois) ; $i++) { 
     for ($j=0; $j <count($pois) ; $j++) { 
      #  echo $pois[$i][$j].'  '; 
        if ($i!=$j) {
        if (bccomp($pois[$i][$j],$ban,10)==-1) {
            $min=($pois[$i][$j]);
            $ban=($pois[$i][$j]);
        }
       }
      }
     
     $vmin[]=$min;
    # echo "<br>";
     $ban=99999999;
      }
      #var_dump($vmin);
      #echo "<br>";
    for ($i=0; $i <count($pois) ; $i++) { 
     for ($j=0; $j <count($pois) ; $j++) {
      if ($i!=$j) {
        $pois[$i][$j]=($pois[$i][$j])-$vmin[$i];
      }

     }}
     $vmin=[];
           for ($i=0; $i <count($pois) ; $i++) { 
     for ($j=0; $j <count($pois) ; $j++) { 
       # echo '    '.$pois[$j][$i].'  '; 
                if ($j!=$i) {
        if (bccomp($pois[$j][$i],$ban,10)==-1) {
            $min=($pois[$j][$i]);
            $ban=($pois[$j][$i]);
        }
       }
      }
      $vmin[]=$min;
      #echo "<br>";
      $ban=99999999;
    }
      #var_dump($vmin);
      #echo "<br>";
         for ($i=0; $i <count($pois) ; $i++) { 
     for ($j=0; $j <count($pois) ; $j++) { 
       # echo $pois[$j][$i].' ';
       if ($j!=$i) {
        $pois[$j][$i]=($pois[$j][$i])-$vmin[$i];
      }
      }
      #echo "<br>";
    }
    $a=0;
    for ($i=0; $i <count($pois) ; $i++) { 
     for ($j=0; $j <count($pois) ; $j++) { 
     //   echo $pois[$i][$j].'  '; 
    if ($pois[$i][$j]==0) {
   
         echo $i."  ".$j." ";

     
        

    }
      }echo "<br>";
    }

     $lista_rutas = Array();
    $poi=Array(16,13,3,8,12,1,10,19,20,5);
    $matriz=Array(Array(-1,0,5,5,10,10,16,20,22,16),
                  Array(0,-1,0,0,5,5,11,13,15,11),
                  Array(5,0,-1,5,5,10,4,20,22,16),
                  Array(5,0,5,-1,0,10,16,20,22,16),
                  Array(10,5,5,0,-1,15,18,25,27,21),
                  Array(9,4,9,9,14,-1,0,4,6,0),
                  Array(15,10,3,15,17,0,-1,10,12,6),
                  Array(23,16,23,23,28,8,14,-1,0,6),
                  Array(25,18,25,25,30,10,16,0,-1,5),
                  Array(15,10,15,15,20,0,6,2,1,-1));
    $poi_conectados =Array();
    $n_poi=count($poi);
    $conexiones=[];
    for($i = 0; $i < count($matriz); $i++) {
    for ($j = 0; $j < count($matriz); $j++) {
        if ($matriz[$i][$j]!="-1") {                             
            $conexiones[]=$j;
            $valor[]=($matriz[$i][$j]);
        }
    }
    if ($i<count($matriz) && $j<count($matriz)) {
    $poi_conectados[]=Array($j,$matriz[$i][$j]);
    }
    
    }



            }
    public function verr()
    { 
          $consult=DB::table('ruta')
          ->select('id_ruta')
          ->join('turista','ruta.fk_id_turista','=','turista.id_turista')
          ->orderBy('id_ruta','asc')
          ->where('turista.id_turista','1')
          ->get();
    
          
    return view('home')->with('rt',$consult);
    }
    public function verr2()
    {
      $id=request('id_ruta');
      $consult=DB::select('select ruta.id_ruta,ruta.fk_id_turista,ruta.tiempo,ruta.seconds,poi.id_poi,poi.coordenadax,poi.coordenaday,poi.nombre,poi_ruta.estado from ruta,poi_ruta,poi,turista where ruta.fk_id_turista=turista.id_turista and poi_ruta.fk_id_ruta=ruta.id_ruta and poi_ruta.fk_id_poi=poi.id_poi and ruta.id_ruta='.$id.' order by ruta.id_ruta');
      return $consult;
    }
    public function actuat()
    {
      $idr=request('id_ruta');
      $time=request('time');
      $seconds=request('seconds');
      $consult=DB::table('ruta')
      ->where('id_ruta',$idr)
      ->update(['tiempo'=>$time,'seconds'=>$seconds]);
      if ($consult) {
        return $seconds;
      }

    }

        
}

