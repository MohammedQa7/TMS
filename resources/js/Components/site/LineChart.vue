<script setup lang="ts">
import eventBus from '@/Composable/eventBus';
import LineChart from '../ui/chart-line/LineChart.vue';
import { ref } from 'vue';
import Card from '../ui/card/Card.vue';
import CardContent from '../ui/card/CardContent.vue';
import CardHeader from '../ui/card/CardHeader.vue';
import CardTitle from '../ui/card/CardTitle.vue';
import CardDescription from '../ui/card/CardDescription.vue';
const chartData = ref();
eventBus.on('statistics', (data) => {
    chartData.value = data;
    console.log(chartData);

})

const data = [
    {
        'week': 'last week',
        'Completed tasks': 30,
    },
    {
        'week': 'this week',
        'Completed tasks': 90,
    },

]
</script>

<template>
    <CardHeader>
        <CardTitle>Completed Tasks</CardTitle>
        <CardDescription>Last Week</CardDescription>
    </CardHeader>
    <LineChart :data="chartData" :index="'day'" :categories="['Completed Tasks']" :y-formatter="(tick, i) => {
        return typeof tick === 'number'
            ? Number.isInteger(tick) ? tick : ''
            : ''
    }" />
</template>