<template>

    <div class="grafico">

        <apexchart
            type="line"
            height="350"
            :options="chartOptions"
            :series="series"
        />

    </div>

</template>

<script setup>

/*
|--------------------------------------------------------------------------
| PROPS
|--------------------------------------------------------------------------
*/

defineProps({

    series: {
        type: Array,
        required: true
    },

    chartOptions: {
        type: Object,
        required: true
    }

});

</script>

<style scoped>

.grafico {

    width: 100%;

}

</style>
