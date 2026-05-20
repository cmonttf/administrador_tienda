<?php

namespace App\DTO;

/**
 * DTO encargado de transportar los datos necesarios
 * para actualizar un producto.
 */
class ActualizarProductoDTO extends BaseDTO
{
    /**
     * Constructor principal del DTO.
     *
     * @param int $id ID del producto a actualizar.
     * @param string $nombre Nombre del producto.
     * @param int $precio Precio de venta del producto.
     * @param string $descripcion Descripción del producto.
     * @param int $stock Cantidad disponible en stock.
     * @param int $costo Costo interno del producto.
     */
    public function __construct(
        public int $id,
        public string $nombre,
        public int $precio,
        public string $descripcion,
        public int $stock,
        public int $costo
    )
    {}

    /**
     * Crea una instancia del DTO a partir de un arreglo de datos.
     *
     * Valida y obtiene los campos obligatorios utilizando
     * el método heredado campoObligatorio().
     *
     * @param array $dato Datos recibidos desde request o fuente externa.
     * @param int $id ID del producto a actualizar.
     *
     * @return self
     */
    public static function fromArray(array $dato, int $id): self
    {
        return new self(
            id: $id,
            nombre: self::campoObligatorio($dato, "nombre"),
            precio: self::campoObligatorio($dato, "precio"),
            descripcion: self::campoObligatorio($dato, "descripcion"),
            stock: self::campoObligatorio($dato, "stock"),
            costo: self::campoObligatorio($dato, "costo")
        );
    }
}
