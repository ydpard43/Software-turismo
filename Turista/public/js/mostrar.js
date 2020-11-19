		function mostrar(){

 const ul=document.getElementById("u1");

  if(ul.className=="o"){
      ul.style.display = 'block';
      ul.className=" a";
  } else {
  	  ul.style.display = 'none';
      ul.className="o";
  }
		}