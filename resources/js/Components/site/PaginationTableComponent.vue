<template>
    <div class="flex items-center gap-1">
        <div class="prev-btn space-x-1">
            <Button class="w-10 h-10" variant="outline">
                <ChevronsLeft class="h-4 w-4" />
            </Button>
            <Button class="w-10 h-10" variant="outline">
                <ChevronLeft class="h-4 w-4" />
            </Button>
        </div>

        <!-- numbers button -->
        <div v-for="(link, index) in pagination.links" :key="index">
            <Button v-if="index != 0 && index != pagination.links.length - 1"
                :variant="link.active ? 'default' : 'outline'" class="p-0">
                <Link :href="link.url" class=" w-10  p-0">
                <p>{{ link.label }}</p>
                </Link>
            </Button>
        </div>

        <div class="next-btn space-x-1">
            <Button class="w-10 h-10" variant="outline" :disabled="link">
                <ChevronRight class="h-4 w-4" />
            </Button>
            <Button class="w-10 h-10 " variant="outline" >
                <ChevronsRight class="h-4 w-4" />
            </Button>
        </div>
    </div>
</template>

<script setup>
import { ChevronLeft, ChevronRight, ChevronsLeft, ChevronsRight } from 'lucide-vue-next';
import Button from '../ui/button/Button.vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const propsData = defineProps({
    pagination: Object,
})



</script>