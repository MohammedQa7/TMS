<script setup>
import { BarChart } from '@/Components/ui/chart-bar'
import CardHeader from '../ui/card/CardHeader.vue';
import CardContent from '../ui/card/CardContent.vue';
import CardTitle from '../ui/card/CardTitle.vue';
import Card from '../ui/card/Card.vue';

const data = [
  { name: 'Jan', total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
  { name: 'Feb', total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
  { name: 'Mar', total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
  { name: 'Apr', total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
  { name: 'May', total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
  { name: 'Jun', total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
  { name: 'Jul', total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
]
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle>Recent Sales</CardTitle>
    </CardHeader>
    <CardContent>
      <BarChart index="name" :data="data" :categories="['total', 'predicted']" :y-formatter="(tick, i) => {
        return typeof tick === 'number'
          ? `$ ${new Intl.NumberFormat('us').format(tick).toString()}`
          : ''
      }" :rounded-corners="4" />
    </CardContent>
  </Card>
</template>