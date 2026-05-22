<?php

namespace App\Utils;

use ArrayObject;
use DomainException;

/**
 * Clase abstracta base para manejo de colecciones tipadas.
 *
 * Permite:
 * - Restringir el tipo de objetos almacenados.
 * - Validar duplicados mediante una propiedad única.
 * - Utilizar objetos como colecciones fuertemente tipadas.
 *
 * Las clases hijas deben definir:
 *
 * @property string $validType
 * @property string $uniqueProperty
 *
 * Ejemplo:
 *
 * protected $validType = Producto::class;
 * protected $uniqueProperty = 'id';
 *
 * @package App\Utils
 */
abstract class ObjectList extends ArrayObject
{
    /**
     * Clase permitida dentro de la colección.
     *
     * @var string
     */
    protected $validType;

    /**
     * Propiedad utilizada para validar unicidad.
     *
     * @var string
     */
    protected $uniqueProperty;

    /**
     * Constructor de la colección.
     *
     * Recorre los elementos entregados inicialmente
     * y valida que:
     * - Sean del tipo permitido.
     * - Cumplan restricciones de unicidad.
     *
     * @param array $data Datos iniciales de la colección.
     *
     * @throws DomainException Cuando el tipo del objeto no es válido.
     */
    public function __construct(array $data = array())
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR Y AGREGAR ELEMENTOS INICIALES
        |--------------------------------------------------------------------------
        */

        foreach ($data as $item) {

            /*
            |--------------------------------------------------------------------------
            | VALIDAR TIPO DE OBJETO
            |--------------------------------------------------------------------------
            */

            $this->assertValidType($item);

            /*
            |--------------------------------------------------------------------------
            | AGREGAR ELEMENTO A LA COLECCIÓN
            |--------------------------------------------------------------------------
            */

            $this->append($item);
        }
    }

    /**
     * Sobrescribe el método offsetSet original de ArrayObject.
     *
     * Permite agregar validaciones adicionales:
     * - Verificación de tipo permitido.
     * - Restricción de elementos duplicados.
     *
     * @param mixed $index Índice del elemento.
     * @param mixed $val   Objeto a insertar.
     *
     * @return void
     *
     * @throws DomainException Cuando el objeto no es válido
     *                         o ya existe dentro de la colección.
     */
    public function offsetSet(mixed $index, mixed $val): void
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR TIPO DEL OBJETO
        |--------------------------------------------------------------------------
        */

        $this->assertValidType($val);

        /*
        |--------------------------------------------------------------------------
        | VALIDAR RESTRICCIÓN DE UNICIDAD
        |--------------------------------------------------------------------------
        */

        $index = $this->assertUniqueConstraint($index, $val);

        /*
        |--------------------------------------------------------------------------
        | INSERTAR ELEMENTO EN LA COLECCIÓN
        |--------------------------------------------------------------------------
        */

        parent::offsetSet($index, $val);
    }

    /**
     * Verifica que el objeto pertenezca al tipo permitido.
     *
     * @param mixed $val Instancia a validar.
     *
     * @return void
     *
     * @throws DomainException Cuando el objeto no pertenece
     *                         al tipo configurado.
     */
    protected function assertValidType(mixed $val): void
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR TIPO DE INSTANCIA
        |--------------------------------------------------------------------------
        */

        if (!$val instanceof $this->validType) {

            /*
            |--------------------------------------------------------------------------
            | LANZAR EXCEPCIÓN POR TIPO INVÁLIDO
            |--------------------------------------------------------------------------
            */

            throw new DomainException(
                'No se puede agregar un objeto de la clase '
                . get_class($val)
                . ', se esperaba '
                . $this->validType
            );
        }
    }

    /**
     * Verifica que el objeto no exista previamente en la colección.
     *
     * Utiliza la propiedad configurada en $uniqueProperty
     * para generar el índice único de almacenamiento.
     *
     * @param mixed $index Índice actual.
     * @param mixed $val   Objeto a validar.
     *
     * @return mixed Índice final utilizado para almacenar el objeto.
     *
     * @throws DomainException Cuando el objeto ya existe.
     */
    protected function assertUniqueConstraint(
        mixed $index,
        mixed $val
    ): mixed
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDAR EXISTENCIA DE PROPIEDAD ÚNICA
        |--------------------------------------------------------------------------
        */

        if (property_exists($val, $this->uniqueProperty)) {

            /*
            |--------------------------------------------------------------------------
            | UTILIZAR PROPIEDAD ÚNICA COMO ÍNDICE
            |--------------------------------------------------------------------------
            */

            $index = $val->{$this->uniqueProperty};

            /*
            |--------------------------------------------------------------------------
            | VALIDAR DUPLICADOS
            |--------------------------------------------------------------------------
            */

            if ($this->offsetExists($index)) {

                /*
                |--------------------------------------------------------------------------
                | LANZAR EXCEPCIÓN POR OBJETO DUPLICADO
                |--------------------------------------------------------------------------
                */

                throw new DomainException(
                    'El objeto ingresado ya existe'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | RETORNAR ÍNDICE FINAL
        |--------------------------------------------------------------------------
        */

        return $index;
    }
}
