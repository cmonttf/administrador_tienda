<?php

namespace App\DTO;

/**
 * Data Transfer Object para representar un mensaje simple.
 *
 * Este DTO encapsula un mensaje de texto y se utiliza para transportar
 * información básica entre capas de la aplicación de forma tipada
 * y segura.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\DTO
 */
class MensajeDTO
{
    /**
     * Crea una nueva instancia del DTO de mensaje.
     *
     * @param string $mensaje Texto del mensaje a transportar.
     */
    public function __construct(public string $mensaje)
    {}
}
