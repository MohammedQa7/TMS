<template>
    <div class="grid h-screen w-full">
        <!-- <Sidebar />
        <DashboardHeader />
        <slot /> -->
        <NewSidebar>
            <DashboardHeader />
            <slot />
        </NewSidebar>
    </div>

    
</template>
<script setup lang="ts">
import Sidebar from '@/Components/site/Sidebar.vue'
import DashboardHeader from '@/Components/site/DashboardHeader.vue'
import NewSidebar from '@/Components/site/NewSidebar.vue';

</script>
