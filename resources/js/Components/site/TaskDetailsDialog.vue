<template>
    <Dialog :open="isOpen">
        <DialogContent :hideCloseButton="true" class="max-w-5xl grid-rows-[auto_minmax(0,1fr)_auto] p-0 max-h-[90dvh]">
            <DialogHeader class="flex-row justify-between px-6 pt-10 pb-0">
                <div>
                    <DialogTitle>Edit task</DialogTitle>
                    <DialogDescription>
                        Make changes to the task here. Click save when you're done.
                    </DialogDescription>
                </div>
                <Button v-if="!taskDialogStore.isLoading" @click.prevent="updateIsCompleted" variant="outline"
                    :class="{ 'bg-lowBadge-foreground text-lowBadge': taskDialogStore?.singleTask?.isCompleted }">
                    <div v-if="!taskDialogStore?.singleTask?.isCompleted"
                        class="button-props flex justify-center items-center gap-2">
                        Mark as completed
                    </div>
                    <div v-else class="button-props flex justify-center items-center gap-2">
                        <Check />
                        Completed
                    </div>
                </Button>
            </DialogHeader>
            <div v-if="taskDialogStore.isLoading" class="loading-indicator flex justify-center items-center">
                <Loader2 class="size-9 animate-spin text-center" />
            </div>
            <div v-else class="grid grid-cols-12 gap-4 ">
                <div class="col-span-9 overflow-y-auto p-6">
                    <div class="flex flex-col gap-20">
                        <!-- Task Name + description + attachments -->
                        <div class="task-header flex flex-col gap-4 space-y-5">
                            <div class="task-name flex justify-start items-center gap-2">
                                <StickyNote class="size-6" />
                                <h1 class="text-2xl font-extrabold">{{ taskDialogStore.singleTask.title }}</h1>
                                <!-- <Input type="text" placeholder="task name" class=" h-12" /> -->
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="task-description flex justify-start items-center gap-2">
                                    <Text class="size-6" />
                                    <h1 class="text-2xl font-extrabold">Task Description</h1>
                                </div>

                                <div class="border">
                                    <div class="rich-editor border border-r-0 border-l-0 border-t-0  p-2">
                                        <RichEditorHeader :editor="editor" />
                                    </div>
                                    <div class="textarea ">
                                        <EditorContent :editor="editor" class="p-2" />
                                    </div>
                                </div>
                            </div>
                            <!-- Task Attachments -->
                            <div class="task-name flex justify-start items-center gap-2">
                                <FileStack class="size-6" />
                                <h1 class="text-2xl font-extrabold">Attachments</h1>
                                <!-- <Input type="text" placeholder="task name" class=" h-12" /> -->
                            </div>
                        </div>
                        <!-- Task activites and comments -->
                        <div class="task-activity flex flex-col justify-center items-start gap-2">
                            <div class="flex justify-start items-center">
                                <Kanban class="size-6" />
                                <h1 class="text-2xl font-extrabold">Task activity</h1>
                            </div>
                            <Textarea placeholder="Write a comment...." />
                        </div>

                    </div>
                </div>

                <!-- Right Side Details -->
                <div class="col-span-3 space-y-5 pe-6">
                    <Card>
                        <CardContent class="py-6 space-y-5">
                            <div class="task-details-info flex  items-center gap-3">
                                <div class="relative overflow-x-auto">

                                    <h1 class="text-sm font-semibold">DETAILS:</h1>
                                    <table class="w-full text-sm text-left rtl:text-right">
                                        <tbody>
                                            <tr>
                                                <th scope="row"
                                                    class=" py-3 font-medium  text-muted-foreground whitespace-nowrap ">
                                                    Team:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6 font-medium text-secondary-foreground whitespace-nowrap ">
                                                    25/25/2025
                                                </th>
                                            </tr>

                                            <tr>
                                                <th scope="row"
                                                    class=" py-3 font-medium text-muted-foreground whitespace-nowrap ">
                                                    Status:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6 font-medium text-secondary-foreground whitespace-nowrap ">
                                                    <Badge variant="outline" class="  "
                                                        :class="appendPriorityClass(taskDialogStore.singleTask.priority, true)">
                                                        <p
                                                            :class="appendPriorityClass(taskDialogStore.singleTask.priority, false)">
                                                            {{ taskDialogStore.singleTask.priority }}</p>
                                                    </Badge>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th scope="row"
                                                    class="py-3 font-medium text-muted-foreground whitespace-nowrap ">
                                                    Assignee:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6  font-medium   text-secondary-foreground whitespace-nowrap ">
                                                    <div class="flex -space-x-2  me">
                                                        <a v-for="(taskMembers, index) in taskDialogStore.singleTask.members"
                                                            :key="index" href="">
                                                            <TooltipComponent :tooltipText="taskMembers.name">
                                                                <img v-if="taskMembers.profilePhoto"
                                                                    class="size-8 rounded-full object-fill"
                                                                    :src="taskMembers.profilePhoto">
                                                                <div
                                                                    class=" rounded-full size-8 flex justify-center items-center  bg-background">
                                                                    <UserCircle2 />
                                                                </div>
                                                            </TooltipComponent>
                                                        </a>
                                                    </div>
                                                </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <Separator />
                            <div class="task-details-info flex   items-center gap-3">
                                <div class="relative overflow-x-auto">
                                    <h1 class="text-sm font-semibold">DATES:</h1>
                                    <table class="w-full text-sm text-left rtl:text-right">
                                        <tbody>
                                            <tr>
                                                <th scope="row"
                                                    class=" py-3 font-medium  text-muted-foreground whitespace-nowrap ">
                                                    Created:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6 font-medium text-secondary-foreground whitespace-nowrap ">
                                                    {{ taskDialogStore.singleTask.createdAt ?? '-' }}
                                                </th>
                                            </tr>

                                            <tr>
                                                <th scope="row"
                                                    class=" py-3 font-medium text-muted-foreground whitespace-nowrap ">
                                                    Updated:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6 font-medium text-secondary-foreground whitespace-nowrap ">
                                                    {{ taskDialogStore.singleTask.updatedAt ?? '-' }}
                                                </th>
                                            </tr>

                                            <tr>
                                                <th scope="row"
                                                    class="py-3 font-medium text-muted-foreground whitespace-nowrap ">
                                                    Dealine:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6  font-medium   text-secondary-foreground whitespace-nowrap ">
                                                    {{ taskDialogStore.singleTask.lastUpdate ?? '-' }}
                                                </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
            <DialogFooter class="p-6 pt-0">
                <Button type="submit">
                    Save changes
                </Button>
            </DialogFooter>
            <DialogClose @click.prevent="CloseDialog"
                class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground">
                <X class="w-4 h-4" />
                <span class="sr-only">Close</span>
            </DialogClose>
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
import { Check, FileStack, Kanban, Loader2, StickyNote, Text, UserCircle2, X } from 'lucide-vue-next';
import { DialogClose } from 'radix-vue';
import { ref, onMounted, watch } from 'vue';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Button from '../ui/button/Button.vue';
import RichEditorHeader from './RichEditorHeader.vue';
import Card from '../ui/card/Card.vue';
import CardContent from '../ui/card/CardContent.vue';
import Separator from '../ui/separator/Separator.vue';
import Textarea from '../ui/textarea/Textarea.vue';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import { appendPriorityClass } from '@/Composable/taskPriorities';
import Badge from '../ui/badge/Badge.vue';
import TooltipComponent from '../TooltipComponent.vue';
import { router, useForm } from '@inertiajs/vue3';
const taskDialogStore = useTaskDialogStore();
const emit = defineEmits();
const propsData = defineProps({
    isOpen: Boolean,
});

const heading = ref();
const editor = useEditor({
    editorProps: {
        attributes: {
            class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto !text-primary ! max-h-82 h-32 overflow-y-auto',
        },
    },
    content: taskDialogStore?.singleTask?.description,
    extensions: [StarterKit],
});

watch(() => taskDialogStore?.singleTask?.description, (value) => {
    if (value) {
        editor.value.commands.setContent(value);
    }
});

watch((heading), (value) => {
    if (editor) {
        switch (value) {
            case "paragraph":
                editor.value.chain().focus().setParagraph().run()
                break
            case "h1":
                editor.value.chain().focus().toggleHeading({ level: 1 }).run()
                break
            case "h2":
                editor.value.chain().focus().toggleHeading({ level: 2 }).run()
                break
            case "h3":
                editor.value.chain().focus().toggleHeading({ level: 3 }).run()
                break
            case "h4":
                editor.value.chain().focus().toggleHeading({ level: 4 }).run()
                break
            case "h5":
                editor.value.chain().focus().toggleHeading({ level: 5 }).run()
                break
            case "h6":
                editor.value.chain().focus().toggleHeading({ level: 6 }).run()
                break
        }
    }
});

// Server Request
const updateIsCompleted = () => {
    router.put(route('tasks.update', { task: taskDialogStore.singleTask.id, isCompleted: !taskDialogStore.singleTask.isCompleted }), {}, {
        preserveScroll: true,
        onSuccess: () => {
            taskDialogStore.singleTask.isCompleted = !taskDialogStore.singleTask.isCompleted;
        }
    });
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
    document.addEventListener('keydown', closeOnEscape);
    JSON.parse(JSON.stringify(taskDialogStore.singleTask))
});

</script>
