<template>
    <div class="grid h-screen w-full pl-[56px]  overflow-x-hidden">
        <Sidebar />
        <DashboardHeader />
        <div class="flex flex-col ">
        </div>
        <slot />
    </div>
</template>
<script setup lang="ts">
import { ref, computed, reactive } from 'vue'
import Sidebar from '@/Components/site/Sidebar.vue'
import DashboardHeader from '@/Components/site/DashboardHeader.vue'
const isCollabsed = ref(false);
const ToggleNav = () => {
    isCollabsed.value = !isCollabsed.value;
}

</script>
