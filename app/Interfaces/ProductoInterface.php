<?php
namespace App\Interfaces;

use App\DAO\ProductoDAO;

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
}
