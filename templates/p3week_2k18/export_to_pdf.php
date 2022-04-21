<?php

require('fpdm.php');


$pdf = new FPDM('registration_form.pdf');
$pdf->Load($_GET, true); 
$pdf->Merge();
$pdf->Output();
?>


