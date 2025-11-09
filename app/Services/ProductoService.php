<?php
namespace App\Services;

use App\DTO\ListaProductoDTO;
use App\Helpers\ConstantesHelper;
use App\Interfaces\ProductoInterface;
use Exception;


/**
 * Class ProductoService
 *
 * Servicio encargado de la lógica de negocio relacionada con los productos.
 * Actúa como capa intermedia entre el controlador y la capa de acceso a datos (DAO),
 * garantizando la transformación de los datos en objetos DTO y el manejo de errores.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\Services
 */
class ProductoService
{
    /**
     * Inyección de dependencias del acceso a datos de productos.
     *
     * @param ProductoInterface $productoInterface Implementación del contrato de acceso a datos.
     */
    public function __construct(
        private ProductoInterface $productoInterface
    )
    {}

    /**
     * Obtiene y transforma el listado de productos en objetos DTO.
     *
     * Recupera la información desde la capa DAO mediante la interfaz `ProductoInterface`,
     * valida que existan resultados y transforma cada registro en una instancia de `ListaProductoDTO`.
     *
     * @throws Exception Si no se logra obtener ningún producto desde la base de datos.
     *
     * @return ListaProductoDTO[] Arreglo de objetos DTO representando los productos.
     */
    public function obtenerListadoProductos(): array
    {
        $datos = $this->productoInterface::obtenerListadoProductos();

        if (count($datos) === ConstantesHelper::CERO) {
            throw new Exception("No se pudo obtener el listado de los productos.");
        }

        return array_map(
            fn($dato) => new ListaProductoDTO(
                $dato->nombre,
                $dato->imagen,
                $dato->precioVenta,
                $dato->stock
            ),
            $datos
        );
    }
}
