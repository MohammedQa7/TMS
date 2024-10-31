<template>
    <div class="flex min-h-screen w-full flex-col">
        <MainDashboardContent />
    </div>
</template>
<script setup lang="ts">
import MainDashboardContent from '@/Components/site/MainDashboardContent.vue'
import MainLayout from '../Layouts/MainLayout.vue'


defineOptions({
    layout: MainLayout
})
</script>
