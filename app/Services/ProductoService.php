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

    /**
     * Guarda un nuevo producto en el sistema junto con su imagen asociada.
     *
     * Este método se encarga de:
     * - Construir un DTO con los datos del producto.
     * - Persistir el producto mediante la capa de acceso a datos.
     * - Almacenar la imagen del producto utilizando su identificador.
     *
     * @param string       $nombre       Nombre del producto.
     * @param int          $precio       Precio de venta del producto.
     * @param string       $descripcion  Descripción detallada del producto.
     * @param int          $stock        Cantidad disponible en inventario.
     * @param int          $costo        Costo interno del producto.
     * @param UploadedFile $imagen       Archivo de imagen asociado al producto.
     *
     * @return bool Retorna true si el producto y su imagen se guardan correctamente,
     *              false en caso de error.
     */
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

    /**
     * Obtiene y retorna la información de un producto a partir de su identificador.
     *
     * Este método consulta la capa de acceso a datos para recuperar un producto
     * específico. En caso de no existir registros asociados al ID proporcionado,
     * se lanza una excepción.
     *
     * @param int $id Identificador único del producto.
     *
     * @return ProductoDTO DTO que contiene los datos del producto solicitado.
     *
     * @throws Exception Si no se encuentran datos asociados al producto.
     */
    public function mostrarProductoPorId(int $id)
    {
        $resultado = $this->productoInterface::obtenerProductoPorId($id);

        if (count($resultado) === ConstantesHelper::CERO) {
            throw new Exception("No se pudo obtener los datos del producto {$id}.");
        }

        $dato = $resultado[0];

        return new ProductoDTO(
            $dato->nombre,
            $dato->precioVenta,
            $dato->descripcion,
            $dato->stock,
            $dato->precioCosto,
            $dato->imagen
        );
    }
}
