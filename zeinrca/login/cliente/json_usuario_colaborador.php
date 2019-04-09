<?
echo "
{
	\"android\": [
";	
  $x = 0;
  $z= 90;
  while($x < $z){
	  
	  if($x < ($z-1)){
	  		$virgula =",";
	  }else{
	  	   $virgula ="";
	  }
	  
	echo "
    {
		\"ver\": \"".$x."\",
		\"name\": \"Colaborador Nome ".$x."\",
		\"api\": \"Codigo: ".$x."\"
	}" .$virgula;
  
  $x ++;
	}
echo "
    ]
}
";	
?>  
