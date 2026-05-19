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
class ListaProductoDTO extends BaseDTO
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

    /**
     * Crea una instancia del DTO a partir de un objeto.
     *
     * @param object $dato Objeto con los datos del producto.
     *
     * @return self Nueva instancia del DTO construida desde el objeto recibido.
     *
     * @throws \Exception Se lanza cuando alguna propiedad obligatoria no existe.
     */
    public static function fromObject(object $dato): self
    {
        return new self(
            id: self::campoObligatorioObjeto($dato, "id"),
            nombre: self::campoObligatorioObjeto($dato, "nombre"),
            imagen: self::campoObligatorioObjeto($dato, "imagen"),
            precioVenta: self::campoObligatorioObjeto($dato, "precioVenta"),
            stock: self::campoObligatorioObjeto($dato, "stock")
        );
    }
}
