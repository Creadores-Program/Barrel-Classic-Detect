<?php
echo "Packing Barrel-Classic-Detect...\n";
$pharFile = "Barrel-Classic-Detect.phar";
$phar = new Phar($pharFile);
$phar->setAlias("Barrel-Classic-Detect.phar");
$phar->buildFromDirectory(dirname(__FILE__) . '/plugin');
if(Phar::canCompress(Phar::GZ)){
    $phar->compressFiles(Phar::GZ);
} elseif (Phar::canCompress(Phar::BZ2)){
    $phar->compressFiles(Phar::BZ2);
}
$phar->setStub("<?php __HALT_COMPILER(); ?>");
echo "Done!\n";
?>
