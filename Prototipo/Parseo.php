<table>
  <tr>
    <td>
<?php
      //$texto = file_get_contents("http://www.expansion.com/mercados/cotizaciones/indices/igbolsamadrid_I.MA.html");

      system("wget http://www.expansion.com/mercados/cotizaciones/indices/igbolsamadrid_I.MA.html");

      echo $texto;


/*
<td class="primera"><a href="/mercados/cotizaciones/valores/abengoa_NEABG.html" title="ABENGOA">ABENGOA</a></td>--
<td>0,444</td>--
<td class="negativa">-1,33</td>--
<td class="negativa">-0,01</td>
<td class="positiva">8,29</td>--
<td>0,468</td>--
<td>0,440</td>--
<td>61.875</td>
<td>37</td>
<td>10:38</td>--
*/

?>
  <?php

  $cap = array();

  if (preg_match('|<td class="primera"><a href="/mercados/cotizaciones/valores/abengoa_NEABG.html" title="ABENGOA">(.*?)</a></td> |is', $texto , $cap[0])){

  echo "Hola";
  }

 ?>
    </td>
  </tr>
</table>
