<?php
namespace App\DTO;

/**
 * Class ListaProductoDTO
 *
 * DTO (Data Transfer Object) que representa la estructura de datos
 * utilizada para transportar información básica de un producto
 * dentro de la aplicación sin exponer directamente el modelo o la entidad.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\DTO
 */
class ListaProductoDTO
{
    /**
     * Constructor del DTO de producto.
     *
     * @param int    $id           Id del producto.
     * @param string $nombre       Nombre del producto.
     * @param string $imagen       Ruta o nombre del archivo de imagen asociado.
     * @param int    $precioVenta  Precio de venta del producto.
     * @param int    $stock        Cantidad disponible en inventario.
     */
    public function __construct(
        public int $id,
        public string $nombre,
        public string $imagen,
        public int $precioVenta,
        public int $stock
    )
    {}
}
