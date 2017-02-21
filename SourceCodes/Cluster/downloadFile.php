<?php
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="sales.csv"');
readfile('../Cluster/down.csv');
?>