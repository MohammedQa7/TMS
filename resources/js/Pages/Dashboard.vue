<template>
    <div class="flex min-h-screen w-full flex-col">
        <MainDashboardContent :data="statics" />
    </div>
</template>
<script setup lang="ts">
import MainDashboardContent from '@/Components/site/MainDashboardContent.vue'
import MainLayout from '../Layouts/MainLayout.vue'
import eventBus from '@/Composable/eventBus';
import { onMounted, watch, watchEffect } from 'vue';

const propsData = defineProps({
    statics: Array,
    userProductivity: Array,
})


onMounted(() => {
    eventBus.emit('statistics', propsData.statics);
    eventBus.emit('userProductivity', propsData.userProductivity);
})


defineOptions({
    layout: MainLayout
})
</script>