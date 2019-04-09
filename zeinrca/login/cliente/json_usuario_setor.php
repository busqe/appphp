<?
echo "
{
	\"android\": [
";	
  $x = 0;
  $z= 2;
  while($x < $z){
	  
	  if($x < ($z-1)){
	  		$virgula =",";
	  }else{
	  	   $virgula ="";
	  }
	  
	echo "
    {
		\"ver\": \"".$x."\",
		\"name\": \"Setor ".$x."\",
		\"api\": \"Usuarios: ".$x."\"
	}" .$virgula;
  
  $x ++;
	}
echo "
    ]
}
";	
?>  
