<?php 
$r1=range(0,9);
$r1rand=array_rand($r1);
$r2=range(9,1);
$r2rand=array_rand($r2);
$pat=$r1rand."+".$r2rand."= ?";
$capsum=$r1rand+$r2rand;



?>