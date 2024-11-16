<template>
    <div v-if="taskDialogStore.isLoading" class="loading-indicator flex justify-center items-center">
        <Loader2 class="size-9 animate-spin text-center" />
    </div>
    <div v-else class="space-y-3">
        <div class="filter flex">
            <Input v-model="filter.search" placeholder="Search ...." />
        </div>
        <DataTable :columns="columns" :data="propsData.tasks.data" />
        <PaginationTableComponent :pagination="propsData.tasks?.meta" />

    </div>
</template>

<script setup>
import { h, ref, watch } from 'vue'
import DataTable from '../DataTable.vue';
import DropdownAction from '../DataTableActions/DropdownAction.vue';
import { CheckIcon, Loader2, XIcon } from 'lucide-vue-next';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import { appendPriorityClassForTable } from '@/Composable/taskPriorities';
import Input from '../ui/input/Input.vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { debounce } from 'lodash';
import PaginationTableComponent from './PaginationTableComponent.vue';
const taskDialogStore = useTaskDialogStore();
const filter = ref({
    search: '',
})
const propsData = defineProps({
    tasks: Array,
    projectSlug: String,
})

const currentQueryParams = new URLSearchParams(window.location.search);
const viewType = currentQueryParams.get('viewType');

const columns = [
    {
        accessorKey: 'id',
        header: () => h('div', { class: '' }, 'ID'),
        cell: ({ row }) => {
            return h('div', { class: ' font-semibold' }, row.index + 1);
        },
    },
    {
        accessorKey: 'title',
        header: () => h('div', { class: '' }, 'Title'),
        cell: ({ row }) => {
            return h('div', { class: ' font-semibold' }, row.getValue('title'));
        },
    },

    {
        accessorKey: 'isCompleted',
        header: () => h('div', { class: '' }, 'Completed'),
        cell: ({ row }) => {
            var isCompleted = row.getValue('isCompleted');
            return h('div', { class: 'flex items-center space-x-2' }, [
                h(isCompleted ? CheckIcon : XIcon, { class: 'h-5 w-5 text-muted-foreground' }),
                h('span', { class: 'text-muted-foreground font-semibold' }, isCompleted ? 'Completed' : 'Not Completed')
            ])
        },

    },
    {
        accessorKey: 'priority',
        header: () => h('div', { class: '' }, 'Priority'),
        cell: ({ row }) => {
            var priority = row.getValue('priority');
            return h('div', { class: 'flex items-center space-x-2' }, [
                h(appendPriorityClassForTable(priority), { class: 'text-muted-foreground' }),
                h('span', { class: 'text-muted-foreground font-semibold' }, priority)
            ]);
        },
    },
    {
        accessorKey: 'createdAt',
        header: () => h('div', { class: '' }, 'Created At'),
        cell: ({ row }) => {
            return h('div', { class: 'flex items-center space-x-2' }, row.getValue('createdAt'));
        },
    },

    {
        accessorKey: 'deadline',
        header: () => h('div', { class: '' }, 'Deadline'),
        cell: ({ row }) => {
            return h('div', { class: 'flex items-center space-x-2' }, row.getValue('deadline'));
        },
    },
    {
        accessorKey: 'actions',
        header: () => false,
        cell: ({ row }) => {
            const task = row.original
            return h('div', { class: 'relative' }, h(DropdownAction, {
                task,
            }))
        },
    },
]
const filterTasks = debounce((value) => {

    router.get(route('projects.show', [propsData.projectSlug, value, { viewType: viewType }]), {}, {
        preserveScroll: true,
        preserveState: true,
    });

    // axios.get(route('tasks.index', { projectSLUG: propsData.projectSlug, filter: value }))
    //     .then((response) => {
    //         tasksArray.value = response.data.tasks;
    //     })
    //     .catch((error) => {
    //         console.error('Error:', error);
    //     });
}, 300);

watch((filter), (value) => {

    filterTasks(value);
}, { deep: true });

</script>