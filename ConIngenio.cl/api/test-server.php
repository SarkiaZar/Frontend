<?php
// Verificar si el servidor está funcionando
echo "El servidor está funcionando correctamente.\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "\n";

// Verificar si mod_rewrite está habilitado
if (function_exists('apache_get_modules')) {
    echo "mod_rewrite está " . (in_array('mod_rewrite', apache_get_modules()) ? "habilitado" : "deshabilitado") . "\n";
} else {
    echo "No se puede verificar mod_rewrite\n";
}
?> 