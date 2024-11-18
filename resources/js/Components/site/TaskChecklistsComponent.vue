<template>
    <div v-for="(checklist, index) in taskDialogStore?.singleTask?.checklists" :key="index" class="task-name">
        <div class="flex  justify-start items-center gap-2">
            <CheckCircle class="size-6" />
            <h1 class="text-2xl font-extrabold">{{ checklist.title }}</h1>
        </div>
        <div v-for="(checkitem, index) in checklist.items" :key="index" class="flex items-center ms-6 mt-2 space-x-2">
            <Checkbox :checked="checkitem.isCompleted" :id="checkitem.title + checkitem.id"
                @click.prevent="updateIsCompletedItem(checkitem)" />
            <label :for="checkitem.title + checkitem.id"
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                {{ checkitem.title }}
            </label>
        </div>

        <div v-if="isActive.checklist == checklist.id && isActive.active" class="adding-checklist-item mt-4 space-y-2">
            <Input v-model="item.title" placeholder="checklist item" />
            <form @submit.prevent="submit(checklist)">
                <div class="flex items-center gap-2">
                    <Button v-if="!isLoading" type="submit">Add item </Button>
                    <Button v-else type="submit">
                        <Loader2 class="size-9 animate-spin text-center" />
                        Adding item
                    </Button>
                    <Button v-if="!isLoading" variant="outline" @click.prevent="toggleInput()">Cancle</Button>
                </div>
            </form>
        </div>
        <div v-else class="adding-checklist-item mt-4 space-y-2">
            <div class="flex items-center gap-2">
                <Button @click.prevent="toggleInput(checklist.id)">Add item </Button>
            </div>
        </div>

    </div>
</template>

<script setup>
import { CheckCircle, Loader2 } from 'lucide-vue-next';
import Button from '../ui/button/Button.vue';
import Input from '../ui/input/Input.vue';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import { ref, watch } from 'vue';
import Checkbox from '../ui/checkbox/Checkbox.vue';
import axios from 'axios';
const taskDialogStore = useTaskDialogStore();
const isLoading = ref(false);
const isActive = ref({
    checklist: null,
    active: false,
});
const item = ref({
    title: '',
    isCompleted: null,
});

const toggleInput = (checklist) => {
    item.value.title = '';
    if (checklist) {
        isActive.value.checklist = checklist;
        isActive.value.active = true;
    } else {
        isActive.value.checklist = checklist;
        isActive.value.active = !isActive.value.active;
    }
}


const updateIsCompletedItem = (CheckItem) => {
    item.value.isCompleted = !CheckItem.isCompleted;

    // to give the user instans feedback when clicking at the item , if something worng happend it will revert to its original status
    CheckItem.isCompleted = !CheckItem.isCompleted;
    axios.put(route('checklist-item.update', CheckItem.id), {
        item: item.value
    })
        .then((response) => {
            CheckItem.isCompleted = CheckItem.isCompleted;
        })
        .catch(() => {
            CheckItem.isCompleted = !CheckItem.isCompleted;
        })
}

const submit = (CheckList) => {

    if (taskDialogStore.singleTask) {
        isLoading.value = !isLoading.value;
        axios.post(route('checklist-item.store'), {
            checklistID: CheckList.id,
            title: item.value.title,
        })
            .then((response) => {
                isLoading.value = !isLoading.value;
                CheckList['items'].push(response.data);
                item.value.title = '';
            })
            .catch((error) => {

            });
    }
}



</script>