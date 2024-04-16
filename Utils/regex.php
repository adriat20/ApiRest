<?php
function validarDNI($dni) {
    // Expresión regular para validar DNI o NIF español
    $patron = '/^\d{8}[A-Za-z]$/';
    
    // Verificar si el DNI coincide con el patrón
    if (preg_match($patron, $dni)) {
        return true; // El DNI es válido
    } else {
        return false; // El DNI no es válido
    }
}
?>
