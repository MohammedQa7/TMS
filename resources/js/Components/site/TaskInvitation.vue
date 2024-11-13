<template>
    <Dialog :open="isOpen">
        <DialogContent :hideCloseButton="true">
            <div class="space-y-5">
                <DialogHeader>
                    <DialogTitle>Task Inivitaion</DialogTitle>
                    <DialogDescription>
                        Make changes to your profile here. Click save when you're done.
                    </DialogDescription>
                </DialogHeader>


                <!-- Main content -->
                <div>
                    <TaskMembersTabs @bindSelectedMembers="getSelectedMembers" />
                </div>

                <DialogFooter>
                    <Button @click.prevent="submit" :disabled="form.processing">Save Changes</Button>
                </DialogFooter>

                <DialogClose @click.prevent="CloseDialog"
                    class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground">
                    <X class="w-4 h-4" />
                    <span class="sr-only">Close</span>
                </DialogClose>
            </div>

        </DialogContent>
    </Dialog>
</template>

<script setup>
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import { closeDialog } from '@/Composable/closeDialog';
import { X } from 'lucide-vue-next';
import { DialogClose } from 'radix-vue';
import { ref, onMounted } from 'vue';
import TaskMembersTabs from './TaskMembersTabs.vue';
import Button from '../ui/button/Button.vue';
import { router, useForm } from '@inertiajs/vue3';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
const taskDialogStore = useTaskDialogStore();
const emit = defineEmits();
const propsData = defineProps({
    isOpen: Boolean,
});
const form = useForm({
    title: null,
    description: null,
    priority: null,
    finishDate: null,
    selectedMembers: null
})

const getSelectedMembers = (membersArray) => {
    if (Object.keys(membersArray).length > 0) {
        form.selectedMembers = membersArray;
    } else {
        form.selectedMembers = null;
    }
}

const submit = () => {
    form.put(route('tasks.update', { task: taskDialogStore.taskID }))
}

const CloseDialog = () => {
    closeDialog(emit);
}
const closeOnEscape = (e) => {
    if (e.key === 'Escape') {
        closeDialog(emit);
    }
};
onMounted(() => {
    document.addEventListener('keydown', closeOnEscape)
});

</script>