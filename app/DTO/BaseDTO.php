<?php

namespace App\DTO;

abstract class BaseDTO
{
    public static function campoObligatorio(array $datos, string $clave, ?string $mensaje = null): mixed
    {
        if (!array_key_exists($clave, $datos)) {
            $mensaje .= "El campo {$clave} es obligatorio.";
            throw new \Exception($mensaje);
        }

        return $datos[$clave];
    }

}
