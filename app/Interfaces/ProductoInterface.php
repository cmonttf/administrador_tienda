<?php
namespace App\Interfaces;

use App\DAO\ProductoDAO;
use App\DTO\ProductoDTO;

/**
 * Interface ProductoInterface
 *
 * Define el contrato para las operaciones de acceso a datos relacionadas
 * con los productos dentro de la aplicación. Cualquier clase que implemente
 * esta interfaz (como ProductoDAO) deberá proveer una implementación concreta
 * del método declarado.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\Interfaces
 */
interface ProductoInterface
{
    /**
     * Obtiene el listado completo de productos disponibles.
     *
     * Debe retornar un arreglo con los datos de los productos
     * incluyendo nombre, imagen, precio de venta y stock.
     *
     * @return array Lista de productos en formato de arreglo.
     */
    public static function obtenerListadoProductos(): array;

    /**
     * Guarda un nuevo producto en el sistema.
     *
     * Recibe un DTO con los datos del producto y persiste la información
     * en la base de datos. Una vez creado el registro, retorna el
     * identificador (ID) autoincremental generado.
     *
     * @param ProductoDTO $producto DTO con la información del producto a guardar.
     * @return int ID del producto recién insertado.
     */
    public static function guardarProductoNuevo(ProductoDTO $producto): int;
}
