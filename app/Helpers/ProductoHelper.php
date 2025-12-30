<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

/**
 * Helper para la gestión de imágenes de productos.
 *
 * Esta clase contiene métodos estáticos para guardar y eliminar
 * imágenes asociadas a productos dentro del directorio público.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\Helpers
 */
class ProductoHelper
{
    /**
     * Guarda una imagen en el directorio público /img.
     *
     * - Verifica si el directorio existe.
     * - Si no existe, lo crea con permisos 0755.
     * - Mueve la imagen al directorio indicado.
     *
     * @param UploadedFile $imagen Archivo de imagen a guardar.
     * @return bool Retorna true si la imagen se guardó correctamente, false en caso contrario.
     */
    public static function guardarImagen(UploadedFile $imagen, int $id): bool
    {
        $ruta = public_path("img/productos/{$id}");

        if (!file_exists($ruta)) {
            mkdir($ruta, 0755, true);
        }

        if($imagen->move($ruta, $imagen->getClientOriginalName())){
            return true;
        }

        return false;
    }

    /**
     * Elimina una imagen del directorio público /img.
     *
     * - Verifica si el archivo existe.
     * - Si existe, lo elimina del sistema de archivos.
     *
     * @param string $imagen Nombre del archivo de imagen a eliminar.
     * @return bool Retorna true si la imagen fue eliminada, false si no existe o falla la eliminación.
     */
    public static function borrarImagen(string $imagen, int $id): bool
    {
        $ruta = public_path("img/productos/{$id}/{$imagen}");

        return file_exists($ruta) && unlink($ruta);
    }
}
