<template>
    <div class="grid h-screen w-full pl-[56px] ">
        <Sidebar />
        <DashboardHeader />
        <div class="flex flex-col ">
        </div>
        <slot />
    </div>
</template>
<script setup lang="ts">
import Sidebar from '@/Components/site/Sidebar.vue'
import DashboardHeader from '@/Components/site/DashboardHeader.vue'

</script>
