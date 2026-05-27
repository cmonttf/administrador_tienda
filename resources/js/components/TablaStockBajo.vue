<template>

    <div class="tabla-container">

        <table class="tabla-stock">

            <thead>

                <tr>

                    <th>Producto</th>
                    <th>SKU</th>
                    <th>Stock</th>

                </tr>

            </thead>

            <tbody>

                <!-- LISTADO -->

                <tr
                    v-for="producto in productos"
                    :key="producto.nombre"
                >

                    <td>
                        {{ producto.nombre }}
                    </td>

                    <td>
                        {{ producto.sku }}
                    </td>

                    <td>
                        {{ producto.cantidad }}
                    </td>

                </tr>

                <!-- SIN DATOS -->

                <tr
                    v-if="productos.length === 0"
                >

                    <td
                        colspan="2"
                        class="sin-datos"
                    >

                        No hay productos con stock bajo

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</template>

<script setup>

/*
|--------------------------------------------------------------------------
| PROPS
|--------------------------------------------------------------------------
*/

defineProps({

    productos: {

        type: Array,

        required: true

    }

});

</script>
