<?php

namespace App\DTO;

class ProductoCantidadDTO extends BaseDTO
{
    public function __construct(
        public string $nombre,
        public int $cantidad
    )
    {}

    public static function fromObject(object $dato): self
    {
        return new self(
            nombre: self::campoObligatorioObjeto($dato, "nombre"),
            cantidad: self::campoObligatorioObjeto($dato, "stock")
        );
    }
}
