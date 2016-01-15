<?php echo 'nous sommes le ' . date("d/m/Y") . ','; ?><br />
<?php
$periode = 'la nuit';
if (date('H')>=5 && date('H')<=11) $periode = 'le matin';
else if (date('H')==12) $periode = 'le midi';
else if (date('H')>=13 && date('H')<=18) $periode = 'l\'après-midi';
else if (date('H')>=19 && date('H')<=22) $periode = 'le soir';
else $periode = 'le matin';

echo 'c\'est ' . $periode . '.';
?>