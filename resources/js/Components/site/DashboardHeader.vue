<template>
    <header class="sticky top-0 z-10 flex items-center gap-1  bg-background border-b px-4 py-2">
        <SidebarTrigger class="-ml-1" />
        <h1 class="text-xl font-semibold">
            Dashboard
        </h1>
        <ResponsiveDashboardDrawer />

        <div class="ml-auto ">

            <DarkModeToggler  />
        </div>
    </header>
</template>

<script setup lang="ts">
import Button from '../ui/button/Button.vue';
import ResponsiveDashboardDrawer from './ResponsiveDashboardDrawer.vue';
import DarkModeToggler from '../DarkModeToggler.vue';
import { Share } from 'lucide-vue-next';
import SidebarTrigger from '../ui/sidebar/SidebarTrigger.vue';

</script>