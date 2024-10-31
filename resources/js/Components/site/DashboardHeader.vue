<template>
    <header class="sticky top-0 z-10 flex h-[57px] items-center gap-1 border-b bg-background px-4">
        <h1 class="text-xl font-semibold">
            Dashboard
        </h1>
        <ResponsiveDashboardDrawer />

        <Button variant="outline" size="sm" class="ml-auto gap-1.5 text-sm">
            <Share class="size-3.5" />
            Share
        </Button>
        <DarkModeToggler />
    </header>
</template>

<script setup lang="ts">
import Button from '../ui/button/Button.vue';
import ResponsiveDashboardDrawer from './ResponsiveDashboardDrawer.vue';
import DarkModeToggler from '../DarkModeToggler.vue';
import { Share } from 'lucide-vue-next';

</script>