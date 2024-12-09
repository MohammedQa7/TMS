<script setup>
import { BarChart } from '@/Components/ui/chart-bar'
import CardHeader from '../ui/card/CardHeader.vue';
import CardContent from '../ui/card/CardContent.vue';
import CardTitle from '../ui/card/CardTitle.vue';
import Card from '../ui/card/Card.vue';
import eventBus from '@/Composable/eventBus';
import { ref } from 'vue';
import CardDescription from '../ui/card/CardDescription.vue';
const barChart = ref();
eventBus.on('userProductivity', (data) => {
  barChart.value = data;
})

const now = new Date();
const lastMonth = new Date(now.getFullYear(), now.getMonth() - 1);
const formattedLastMonth = lastMonth.toLocaleString('default', { month: 'long' });
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle>Users Productivity</CardTitle>
      <CardDescription>Last {{ formattedLastMonth }} </CardDescription>
    </CardHeader>
    <CardContent>
      <BarChart index="username" :data="barChart" :categories="['Completed Tasks']" :y-formatter="(tick, i) => {
        return typeof tick === 'number'
          ? Number.isInteger(tick) ? tick : ''
          : ''
      }" :rounded-corners="4" />
    </CardContent>
  </Card>
</template>