<script setup lang="ts">
import LineChart from '../ui/chart-line/LineChart.vue';



const data = [
    {
        'week' : 'last week',
        'Completed tasks': 30,
    },
    {
        'week' : 'this week',
        'Completed tasks': 90,
    },

]
</script>

<template>
    <LineChart :data="data" index="week" :categories="['Completed tasks']" />
</template>