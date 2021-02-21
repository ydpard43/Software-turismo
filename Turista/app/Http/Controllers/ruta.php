<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ruta extends Controller
{
  public $poi_conectados;
  public $lista_rutas;
    public $n_poi=0;
    public $poi;
    public $matriz ;
    public $contador=1;
   
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
        //echo " cx ".$key->cx.",".$key->cy." poi ".$key->id_poi;
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
//         echo $i."  ".$j." ";        

    }
      }echo "<br>";
    }
  $this->lista_rutas[] = new route();
  $this->n_poi=7;
  $this->poi=Array("Momias ","Casona Coburgo ","Paramo del Sumapaz ","Museo arqueologico ","Casona Novillero ","Casona Balmoral ","Casona Tulipana ");
  $this->matriz=Array(Array("-1","0.9","0","-1","0","1.6","0.4"),
                      Array("34.65","-1","-1","0","2.05","0.15","0"),
                      Array("0","-1","-1","25.45","27.7","30.6","30"),
                      Array("36.4","0","-1","-1","2.5","1.4","0.6"),
                      Array("32.2","0.5","-1","0.95","-1","0","0"),
                      Array("35.2","0","-1","1.25","1.4","-1","0.2"),
                      Array("34.14","0","-1","0.6","1.55","0.35","-1")); 
    $this->poi_conectados[] = new Conexion(); 
    for($i = 0; $i < count($this->matriz); $i++) {
            $poi_c = new Conexion();
            for ($j = 0; $j < count($this->matriz); $j++) {
                if ($this->matriz[$i][$j]!="-1") {                             //Se añaden las columnas de los puntos de interes mas eficientes en pos_admitidas.
                    $poi_c->setConexiones($j);
                    $poi_c->setValor($this->matriz[$i][$j]);
                }
            }
            $this->poi_conectados[]=($poi_c);
        }
        
       // var_export($this->poi_conectados);
         $this->formar_posi($x=Array(),$y=Array(), 0, "0",1);
     //    $this->mostrar_rutas();
      //   $this->rutas_aptas();

            }
   public function formar_posi($recorrido,$valor,$poi_anterior,$val_anterior,$a)
    {
        $recorrido[]=$poi_anterior;                            //Se agrega el POI siguiente al recorrido.
        $valor[]=$val_anterior;
          // echo $poi_anterior." ".$this->contador;   
         foreach ($recorrido as $key => $value) {
         echo $value."  ";
         }
             echo "<br>";
        foreach ($valor as $key => $value) {
       // echo $value."  ";
         }
             echo "<br>";
     echo "[".$this->contador."]";
           $this->contador= $this->contador+1;
           // var_dump($val_anterior);
             echo "<br>";
        if(count($recorrido)==$this->n_poi){
            $res[]=0;
            $r = new route();
            foreach ($recorrido as $iterador=>$key){
                $r->setRuta($this->poi[$iterador]);                //Guarda las rutas validas en el objeto r.
            }
            foreach ($valor as $iterador=>$key) {
                $res[] = $iterador;
                $r->setPuntaje($iterador);
            }
            $r->setRes($res);
            $this->lista_rutas[]=$r;
  
        }else{
         $ct=count($this->poi_conectados[$a]->getConexiones());
        for ($i=0; $i <$ct ; $i++) { 

         if (!(in_array($this->poi_conectados[$a]->getConexiones()[$i],$recorrido))) {
                
              if ($i==$ct-1) {
                 $this->formar_posi($reco=unserialize(serialize($recorrido)),$val=unserialize(serialize($valor)),$this->poi_conectados[$a]->getConexiones()[$i],$this->poi_conectados[$a]->getValor()[$i],$a);
              }else if($i!=$ct-1){
                    $this->formar_posi($reco=unserialize(serialize($recorrido)),$val=unserialize(serialize($valor)),$this->poi_conectados[$a]->getConexiones()[$i],$this->poi_conectados[$a]->getValor()[$i],$a+1);}
           }
          
          }

          }
           
        echo "<br>";
         }
        

        
      
    
        public function mostrar_rutas(){
        $reco="Rutas validas";
        foreach($this->lista_rutas as $iterador_rutas){
          echo var_dump($iterador_rutas->getRuta());
          echo "<br>otro<br>";
          //  $reco=$reco."\n".($iterador_rutas->getRuta()." Valor: ".$iterador_rutas->getPuntaje()." Resultado: ".$iterador_rutas->getRes());                  //Imprime las rutas validas/optimas con su valor.
        }
      // echo $reco;
    }

      public function rutas_aptas(){
        $res_ant=9999;
        $index=[];
        $cont=0;
        foreach($this->lista_rutas as $iterador_rutas){
            if(($res_ant<=>$iterador_rutas->getRes())==1){
                $index=[];
                $index[]=$cont;
                $res_ant=$iterador_rutas->getRes();
            }else if(($res_ant<=>$iterador_rutas->getRes())==0){
                $index[]=$cont;
            }
            $cont++;
        }
        $ruta="\nRutas más aptas:";
        foreach ($index as $iterador) {
          var_dump($this->lista_rutas[2]->getRuta());
           // $ruta=$ruta."\n".($this->lista_rutas[$iterador]->getRuta()."Valor: ".$this->lista_rutas[$iterador]->getRes());
        }
        echo ($ruta);
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

