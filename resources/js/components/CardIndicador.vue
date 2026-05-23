<template>

    <div class="card-indicador">

        <div class="contenido">

            <h3 class="titulo">
                {{ titulo }}
            </h3>

            <p class="valor">
                {{ valorFormateado }}
            </p>

        </div>

    </div>

</template>

<script setup>

import { computed } from 'vue';

/*
|--------------------------------------------------------------------------
| PROPS
|--------------------------------------------------------------------------
*/

const props = defineProps({

    titulo: {
        type: String,
        required: true
    },

    valor: {
        type: [Number, String],
        required: true
    },

    tipo: {
        type: String,
        default: 'numero'
    }

});

/*
|--------------------------------------------------------------------------
| FORMATO VALOR
|--------------------------------------------------------------------------
*/

const valorFormateado = computed(() => {

    /*
    |--------------------------------------------------------------------------
    | MONEDA
    |--------------------------------------------------------------------------
    */

    if (props.tipo === 'moneda') {

        return new Intl.NumberFormat('es-CL', {

            style: 'currency',

            currency: 'CLP'

        }).format(props.valor);

    }

    /*
    |--------------------------------------------------------------------------
    | NÚMERO
    |--------------------------------------------------------------------------
    */

    return new Intl.NumberFormat('es-CL')
        .format(props.valor);

});

</script>

<style scoped>

.card-indicador {

    background: white;

    border-radius: 16px;

    padding: 24px;

    box-shadow: 0 2px 10px rgba(0,0,0,0.08);

    transition: all 0.2s ease;

}

.card-indicador:hover {

    transform: translateY(-3px);

    box-shadow: 0 8px 20px rgba(0,0,0,0.12);

}

.contenido {

    display: flex;

    flex-direction: column;

    gap: 10px;

}

.titulo {

    font-size: 14px;

    color: #666;

    margin: 0;

    font-weight: 600;

    text-transform: uppercase;

    letter-spacing: 1px;

}

.valor {

    font-size: 32px;

    font-weight: bold;

    margin: 0;

    color: #111;

}

</style>
