<?php
include 'PEAR/Registry.php';

$reg = new PEAR_Registry;
foreach ($reg->listPackages() as $package) {
    print "$package\n"."<br>";
}
?>