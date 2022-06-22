<?php

require('fpdm.php');

$pdf = new FPDM('registration_form.pdf');
$pdf->Merge();
$pdf->Output();
?>
