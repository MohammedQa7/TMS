<template>
    <div class="grid h-screen w-full">
        <!-- <Sidebar />
        <DashboardHeader />
        <slot /> -->
        <NewSidebar>
            <DashboardHeader />
            <slot />
        </NewSidebar>

        <DeleteDialog />
    </div>


</template>
<script setup lang="ts">
import Sidebar from '@/Components/site/Sidebar.vue'
import DashboardHeader from '@/Components/site/DashboardHeader.vue'
import NewSidebar from '@/Components/site/NewSidebar.vue';
import DeleteDialog from '@/Components/site/DeleteDialog.vue';


</script>
