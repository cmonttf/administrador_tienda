<?php

namespace App\DTO;

/**
 * Data Transfer Object (DTO) para representar un Producto.
 *
 * Este DTO encapsula la información necesaria para la creación o
 * manipulación de un producto dentro del sistema, asegurando
 * tipado fuerte y una estructura clara de datos.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\DTO
 */
class ProductoDTO
{
    /**
     * Constructor del DTO Producto.
     *
     * @param string $nombre      Nombre del producto.
     * @param int    $precio      Precio de venta del producto.
     * @param string $descripcion Descripción detallada del producto.
     * @param int    $stock       Cantidad disponible en inventario.
     * @param int    $costo       Costo interno del producto.
     * @param string $imagen      Ruta o nombre de la imagen asociada al producto.
     */
    public function __construct(
        public string $nombre,
        public int $precio,
        public string $descripcion,
        public int $stock,
        public int $costo,
        public string $imagen
    )
    {
    }
}
