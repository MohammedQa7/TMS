<template>
    <div class="flex items-center gap-1">
        <div class="prev-btn space-x-1">
            <Button class="w-10 h-10 " variant="outline" :disabled="pagination.current_page == 1">
                <Link :href="page.url + '&page=' + 1" class=" w-10  p-0">
                <ChevronsLeft class="h-4 w-4" />
                </Link>
            </Button>
            <Button class="w-10 h-10 " variant="outline" :disabled="pagination.current_page == 1">
                <Link :href="page.url + '&page=' + pagination.links[0].url" class=" w-10  p-0">
                <ChevronLeft class="h-4 w-4" />
                </Link>
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
            <Button class="w-10 h-10 " variant="outline" :disabled="pagination.last_page == pagination.current_page">
                <Link :href="pagination.links.slice(-1)[0].url" class=" w-10  p-0">
                    
                <ChevronRight class="h-4 w-4" />
                </Link>
            </Button>
            <Button class="w-10 h-10 " variant="outline" :disabled="pagination.last_page == pagination.current_page">
                <Link :href="page.url + '&page=' + pagination.last_page" class=" w-10  p-0">
                <ChevronsRight class="h-4 w-4" />
                </Link>
            </Button>
            <h1></h1>
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

console.log(propsData.pagination);



</script>