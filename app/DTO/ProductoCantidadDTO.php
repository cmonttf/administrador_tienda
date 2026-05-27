<?php

namespace App\DTO;

class ProductoCantidadDTO extends BaseDTO
{
    public function __construct(
        public string $nombre,
        public string $sku,
        public int $cantidad
    )
    {}

    public static function fromObject(object $dato): self
    {
        return new self(
            nombre: self::campoObligatorioObjeto($dato, "nombre"),
            sku: self::campoObligatorioObjeto($dato, "sku"),
            cantidad: self::campoObligatorioObjeto($dato, "stock")
        );
    }
}
