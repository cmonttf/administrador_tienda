<?php
namespace App\Services;

use App\DTO\ListaProductoDTO;
use App\DTO\ProductoDTO;
use App\Helpers\ConstantesHelper;
use App\Helpers\ProductoHelper;
use App\Interfaces\ProductoInterface;
use Exception;
use Illuminate\Http\UploadedFile;

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

        return array_map(
            fn($dato) => new ListaProductoDTO(
                $dato->id,
                $dato->nombre,
                $dato->imagen,
                $dato->precioVenta,
                $dato->stock
            ),
            $datos
        );
    }

    public function guardarProductoNuevo(
        string $nombre,
        int $precio,
        string $descripcion,
        int $stock,
        int $costo,
        UploadedFile $imagen
    ): bool
    {
        $datos = new ProductoDTO(
            $nombre,
            $precio,
            $descripcion,
            $stock,
            $costo,
            $imagen->getClientOriginalName()
        );

        $id = $this->productoInterface::guardarProductoNuevo($datos);

        return ProductoHelper::guardarImagen($imagen, $id);
    }
}
