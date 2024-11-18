<template>
    <Popover>
        <PopoverTrigger class="w-full">
            <Button variant="outline" class="w-full text-md">
                <ListCheck />
                Checklist
            </Button>
        </PopoverTrigger>
        <PopoverContent class="space-y-3">
            <h1 class="text-lg text-center font-bold">Add checklist</h1>
            <form @submit.prevent="submit" class="space-y-2">
                <Label for="title">Title</Label>
                <Input v-model="title" name="title" placeholder="Title" required />
                <Button v-if="!isLoading" type="submit">Save</Button>
                <Button v-else>
                    <Loader2 class="size-9 animate-spin text-center" />
                    Saving
                </Button>
            </form>
        </PopoverContent>
    </Popover>
</template>


<script setup>
import { ListCheck, Loader2 } from 'lucide-vue-next';
import Popover from '../ui/popover/Popover.vue';
import PopoverTrigger from '../ui/popover/PopoverTrigger.vue';
import Button from '../ui/button/Button.vue';
import PopoverContent from '../ui/popover/PopoverContent.vue';
import Label from '../ui/label/Label.vue';
import Input from '../ui/input/Input.vue';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import axios from 'axios';
import { ref } from 'vue';
const taskDialogStore = useTaskDialogStore();
const title = ref('');
const isLoading = ref(false);
const submit = () => {

    if (taskDialogStore.singleTask) {
        isLoading.value = !isLoading.value;
        axios.post(route('task-checklist.store'), {
            taskID: taskDialogStore.singleTask.id,
            title: title.value,
        })
            .then((response) => {
                isLoading.value = !isLoading.value;
                taskDialogStore.singleTask.checklists.push(response.data);
                title.value = '';
            })
            .catch((error) => {

            });
    }
}
</script>