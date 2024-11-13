<template>
    <div class="text-center bg-gradient-to-r from-secondary-foreground to-muted-foreground p-1">
        <h1 class="font-bold text-sm text-muted">{{ text }}</h1>
    </div>
</template>


<script setup>
const propsData = defineProps({
    text: String
})
</script>