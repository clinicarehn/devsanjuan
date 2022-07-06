<?php
$unidad = $_POST['unidad'];

if($unidad == 1){
echo "<optgroup label='1er Nivel'>
               <option value='1'>Centro de Salud</option>
               <option value='2'>Privados</option>
               <option value='3'>Otros</option>			   
           </optgroup>
  ";
}else if($unidad == 2){
echo "<optgroup label='2do Nivel'>
         <option value='1'>Hospitales Públicos</option>
         <option value='2'>Hospitales Privados</option>  				   
       </optgroup>
  ";
}else if($unidad == 3){
echo "<optgroup label='Mayor Complejidad'>
         <option value='1'>Mayor Complejidad</option> 				   
       </optgroup>
  ";
} 
?>