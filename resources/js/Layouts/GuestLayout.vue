<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DarkModeToggler from '@/Components/DarkModeToggler.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="p-4 absolute top-0 right-0">
        <DarkModeToggler />
    </div>
    <div class="flex min-h-screen flex-col items-center  sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
            <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="mt-6 ">
            <slot />
        </div>
    </div>
</template>
