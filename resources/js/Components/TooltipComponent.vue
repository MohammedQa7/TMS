<template>
    <TooltipProvider :delay-duration="100">
        <Tooltip>
            <TooltipTrigger>
                <slot />
            </TooltipTrigger>
            <TooltipContent>
                <p>{{ tooltipText }}</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>

<script setup>
import { TooltipProvider } from 'radix-vue';
import Tooltip from './ui/tooltip/Tooltip.vue';
import TooltipTrigger from './ui/tooltip/TooltipTrigger.vue';
import TooltipContent from './ui/tooltip/TooltipContent.vue';


const propsData = defineProps({
    tooltipText: String,
})


</script>