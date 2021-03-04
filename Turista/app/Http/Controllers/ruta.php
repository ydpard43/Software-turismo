<?php

namespace App\Http\Controllers;
use Brick\Math\BigDecimal;
use Illuminate\Http\Request;
use DB;

class ruta extends Controller
{
  public $poi_conectados;
  public $lista_rutas;
    public $n_poi=0;
    public $poi;
    public $matriz;
    public $contador=1;
    public $pn=array();
   
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
         $tipo="'".implode("','",session('tip'))."'";
         $vtp;
        $consult=DB::select('select poi.id_poi,poi.tiempoestancia,poi.nombre as pn,formula.nombre,formula.id_formula,poi_formula.valor,poi.coordenaday,poi.coordenadax,imagenpoi.id_imagenpoi
			from poi,formula,poi_formula,imagenpoi
			where poi.id_poi=poi_formula.fk_id_poi
			and poi_formula.fk_id_formula=formula.id_formula
        and imagenpoi.fk_id_poi=poi.id_poi
			and poi.id_poi in('.$sitios.')');
        $consult20=DB::select('select poi.id_poi,count(tipologia.nombre) as t
from poi,tipologia,poi_tipologia
where poi.id_poi in('.$sitios.') 
      and poi.id_poi=poi_tipologia.fk_id_poi 
      and poi_tipologia.fk_id_tipologia=tipologia.id_tipologia
       and tipologia.nombre in ('.$tipo.')
      group by poi.id_poi');
        foreach ($consult20 as $key ) {
          $vtp[$key->id_poi]=$key->t;
        }
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
            $resultado[$data['id']] = $data['res']+$vtp[$data['id']];
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
        $this->pn[$key->id_poi]=$key->pn." ";
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
     $ban=99999999;
      }
    for ($i=0; $i <count($pois) ; $i++) { 
     for ($j=0; $j <count($pois) ; $j++) {
      if ($i!=$j) {
        $pois[$i][$j]=($pois[$i][$j])-$vmin[$i];
      }

     }}
     $vmin=[];
           for ($i=0; $i <count($pois) ; $i++) { 
     for ($j=0; $j <count($pois) ; $j++) { 
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
       // echo $pois[$j][$i].' ';
       if ($j!=$i) {
        $pois[$j][$i]=($pois[$j][$i])-$vmin[$i];
      }
      }
     // echo "<br>";
    } 

    $a=0;
  $this->lista_rutas[] = new route();
  $this->n_poi=count($poi);
  $this->poi=$poi;
  $this->matriz=$pois; 
    $this->poi_conectados[] = new Conexion(); 
    for($i = 0; $i < count($this->matriz); $i++) {
            $poi_c = new Conexion();
            for ($j = 0; $j < count($this->matriz); $j++) {
                if ($this->matriz[$i][$j]!="-1") {                     
                    $poi_c->setConexiones($j);
                    $poi_c->setValor($this->matriz[$i][$j]);
                   
                }
            }
            $this->poi_conectados[]=($poi_c);
          
        }
        
      $this->formar_posi($x=Array(),$y=Array(), 0, "0");
     
      $result=$this->rutas_aptas();
       return view('guardarr')->with('rt',$result)->with('p',$this->pn);

            }

  public function nuevap6()
  {
    $sitios=request('indice');
      $consult=DB::select('select poi.id_poi,poi.tiempoestancia,poi.nombre as pn,poi.coordenaday as cy,poi.coordenadax as cx,imagenpoi.id_imagenpoi as img
            from poi,imagenpoi where poi.id_poi in('.$sitios.')
            and imagenpoi.fk_id_poi=poi.id_poi'
            );
       $poi=explode(",",$sitios);
       $sum=0;
       $time=0;
       $poi_anterior;
       $poi_actual;
       $cd;
       $tiempo;
       $nombres;
  
       foreach ($consult as $key) {
         $cd[]=$key->cy.','.$key->cx;
         $tiempo[]=$key->tiempoestancia;
         $nombres[]=array('nombre'=>$key->pn,'img'=>$key->img);
       }
       foreach ($poi as $key => $value) {

        if ($key==0) {
         $poi_anterior=$cd[$key];
         
       }else{
       
          $poi_actual=$cd[$key];
            $data = file_get_contents('http://0.0.0.0:5000/route/v1/car/'.$poi_anterior.';'.$poi_actual, null, stream_context_create([
                'http' => [
                'protocol_version' => 1.1,
                'header'           => [
                'Connection: close',],],]));
        $data=json_decode($data);
        
        $sum=$sum+(($data->routes[0]->distance)/1000); 
        $time=$time+$tiempo[$key]+(round(($data->routes[0]->duration)/60));
          $poi_anterior=$cd[$key];

       } 
       }
       return view('guardarrp2')->with('time',$time)->with('total',$sum)->with('poi',$poi)->with('nombres',$nombres);

  }
  public function nuevap7()
  {
    $ruta=request('poi');
    
    $consult=DB::table('ruta')
              ->select(DB::raw('MAX(id_ruta) as id'))
              ->where('fk_id_turista','1')
              ->get();
    if (isset($consult[0]->id)) {
      return $consult2=DB::table('ruta')
        ->insert([
          'id_ruta'=>$consult[0]->id+1,
          'estrellas'=>request('estrellas'),
          'fk_id_poi'=>request('poi'),
          'fk_id_turista'=>session('id')
        ]);


      $consult[0]->id;
    }else{
      return -1;
    }
    
  }
   public function formar_posi($recorrido,$valor,$poi_anterior,$val_anterior)
    {
        $recorrido[]=$poi_anterior;                            
        $valor[]=$val_anterior;
        if(count($recorrido)==$this->n_poi){

            $res[]=0;
            $r = new route();
            foreach ($recorrido as $iterador=>$key){
                $r->setRuta($this->poi[$key]);  
            }
            foreach ($valor as $iterador=>$key) {
                $res[] = (float)$key;
                $r->setPuntaje((float)$key);
            }
            $r->setRes($res);
            $this->lista_rutas[]=$r;
  
        }else{
           
           if (count($recorrido)-1==0) {
             $cont=0;
           }else{
             $cont=count($recorrido)-1;
           }          
      //var_export(count($this->poi_conectados[count($recorrido)]->getConexiones()));
        for ($i=0; $i <count($this->poi_conectados[$recorrido[$cont]+1]->getConexiones()); $i++) { 
        
         if (!(in_array($this->poi_conectados[$recorrido[$cont]+1]->getConexiones()[$i],$recorrido))) {
               $this->formar_posi($reco=unserialize(serialize($recorrido)),
                $val=unserialize(serialize($valor)),$this->poi_conectados[$recorrido[$cont]+1]->getConexiones()[$i],
                "".$this->poi_conectados[$recorrido[$cont]+1]->getValor()[$i]);
              }
          
          }

          }
           
      
         }
        

        
      
    
        public function mostrar_rutas(){
       //echo "Rutas validas <br>";
           echo "<pre>";
     for ($i=1; $i <count($this->lista_rutas) ; $i++) { 
    
      for($j=0;$j< count($this->lista_rutas[$i]->getRuta());$j++){
        print_r($this->pn[$this->lista_rutas[$i]->getRuta()[$j]]."   ");
         //print_r($this->lista_rutas[$i]->getPuntaje()[$j]. "  ");
      }
      
      echo "Resultado ";
      print_r(array_sum($this->lista_rutas[$i]->getRes()));
      echo "<br>";
     }
    }

      public function rutas_aptas(){
        $res_ant= 999999;
        $index=[];
        $cont=0;
        foreach($this->lista_rutas as $iterador_rutas=>$valor){
          if ($iterador_rutas!=0) {
            if((bccomp($res_ant,array_sum($valor->getRes()),100))==1){
                $index=[];
                $index[]=$cont;
              //  var_export($cont);
                $res_ant=array_sum($valor->getRes());
            }else if((bccomp($res_ant,array_sum($valor->getRes()),100))==0){
                $index[]=$cont;
            }
            $cont++;
          }
        }

        $result=[];
        #echo "Rutas más aptas:";
        foreach ($index as $iterador=>$value) {
         foreach ($this->lista_rutas[$value+1]->getRuta() as $key => $value2) {
         # echo $this->pn[$value2]." ";
         }
          $result[]=$this->lista_rutas[$value+1]->getRuta();
        
         #var_export(round(array_sum($this->lista_rutas[$value+1]->getRes()),4));
          
          
           // $ruta=$ruta."\n".($this->lista_rutas[$iterador]->getRuta()."Valor: ".$this->lista_rutas[$iterador]->getRes());
        }
        return $result;
      
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
class route{
    private $ruta =array();
    private $puntaje = array();
    private $res;

  public function getRes() {
        return $this->res;
    }

    public function setRes($res) {
        $this->res = $res;
    }

    public function getRuta() {
        return $this->ruta;
    }

    public function setRuta($ruta) {
        $this->ruta[]=$ruta;
    }

    public function getPuntaje() {
        return $this->puntaje;
    }

    public function setPuntaje($puntaje) {
        $this->puntaje[]=($puntaje);
    }
}
class Conexion {
    private  $conexiones = array();
    private $valor = array();

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor[]=$valor;
    }

    public function getConexiones() {
        return $this->conexiones;
    }

    public function setConexiones($conexiones) {
        $this->conexiones[]=$conexiones;
    }
}

