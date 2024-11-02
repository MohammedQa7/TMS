<template>
    <Dialog :open="isOpen">
        <DialogContent :hideCloseButton="true" class="max-w-5xl grid-rows-[auto_minmax(0,1fr)_auto] p-0 max-h-[90dvh]">
            <DialogHeader class="p-6 pb-0">
                <DialogTitle>Edit task</DialogTitle>
                <DialogDescription>
                    Make changes to the task here. Click save when you're done.
                </DialogDescription>
            </DialogHeader>
            <div class="grid grid-cols-12 gap-4 ">
                <div class="col-span-9 overflow-y-auto p-6">
                    <div class="flex flex-col gap-20">
                        <!-- Task Name + description + attachments -->
                        <div class="task-header flex flex-col gap-4 space-y-5">
                            <div class="task-name flex justify-start items-center gap-2">
                                <StickyNote class="size-6" />
                                <h1 class="text-2xl font-extrabold">Task name</h1>
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
                                    <div class="textarea">
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
                                                    25/25/2025
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
                                                        <a href="">
                                                            <svg class="size-8" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                </g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <defs>
                                                                        <path id="info-a"
                                                                            d="M10.5134277,0.293457031 C12.3116048,6.98051974 11.4737956,10.510549 8,10.8835449 C1.8918457,10.8835449 -0.0366210938,14.6247559 0.773681641,16.5002441 C1.58398438,18.3757324 4.12866211,19.8500977 6.21289062,20.2067871 C8.29711914,20.5634766 11.6750488,20.5915527 15.8925781,16.5002441 C20.1101074,12.4089355 17.1142578,5.80639648 15.8925781,4.07495117 C15.078125,2.9206543 13.2850749,1.66015625 10.5134277,0.293457031 Z">
                                                                        </path>
                                                                        <path id="info-c"
                                                                            d="M11,22 C4.92486775,22 0,17.0751322 0,11 C0,4.92486775 4.92486775,0 11,0 C17.0751322,0 22,4.92486775 22,11 C22,17.0751322 17.0751322,22 11,22 Z M11,20.24 C16.1031111,20.24 20.24,16.1031111 20.24,11 C20.24,5.89688891 16.1031111,1.76 11,1.76 C5.89688891,1.76 1.76,5.89688891 1.76,11 C1.76,16.1031111 5.89688891,20.24 11,20.24 Z M10,10 C10,9.44771525 10.4477153,9 11,9 C11.5522847,9 12,9.44771525 12,10 L12,15 C12,15.5522847 11.5522847,16 11,16 C10.4477153,16 10,15.5522847 10,15 L10,10 Z M11,8 C10.4477153,8 10,7.55228475 10,7 C10,6.44771525 10.4477153,6 11,6 C11.5522847,6 12,6.44771525 12,7 C12,7.55228475 11.5522847,8 11,8 Z">
                                                                        </path>
                                                                    </defs>
                                                                    <g fill="none" fill-rule="evenodd"
                                                                        transform="translate(1 1)">
                                                                        <g transform="translate(3 1)">
                                                                            <mask id="info-b" fill="#ffffff">
                                                                                <use xlink:href="#info-a">
                                                                                </use>
                                                                            </mask>
                                                                            <use fill="#D8D8D8" xlink:href="#info-a">
                                                                            </use>
                                                                            <g fill="#FFA0A0" mask="url(#info-b)">
                                                                                <rect width="24" height="24"
                                                                                    transform="translate(-4 -2)">
                                                                                </rect>
                                                                            </g>
                                                                        </g>
                                                                        <mask id="info-d" fill="#ffffff">
                                                                            <use xlink:href="#info-c">
                                                                            </use>
                                                                        </mask>
                                                                        <use fill="#000000" fill-rule="nonzero"
                                                                            xlink:href="#info-c"></use>
                                                                        <g fill="#7600FF" mask="url(#info-d)">
                                                                            <rect width="24" height="24"
                                                                                transform="translate(-1 -1)">
                                                                            </rect>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                        <a href="">
                                                            <svg class="size-8" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                </g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                </g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <defs>
                                                                        <path id="info-a"
                                                                            d="M10.5134277,0.293457031 C12.3116048,6.98051974 11.4737956,10.510549 8,10.8835449 C1.8918457,10.8835449 -0.0366210938,14.6247559 0.773681641,16.5002441 C1.58398438,18.3757324 4.12866211,19.8500977 6.21289062,20.2067871 C8.29711914,20.5634766 11.6750488,20.5915527 15.8925781,16.5002441 C20.1101074,12.4089355 17.1142578,5.80639648 15.8925781,4.07495117 C15.078125,2.9206543 13.2850749,1.66015625 10.5134277,0.293457031 Z">
                                                                        </path>
                                                                        <path id="info-c"
                                                                            d="M11,22 C4.92486775,22 0,17.0751322 0,11 C0,4.92486775 4.92486775,0 11,0 C17.0751322,0 22,4.92486775 22,11 C22,17.0751322 17.0751322,22 11,22 Z M11,20.24 C16.1031111,20.24 20.24,16.1031111 20.24,11 C20.24,5.89688891 16.1031111,1.76 11,1.76 C5.89688891,1.76 1.76,5.89688891 1.76,11 C1.76,16.1031111 5.89688891,20.24 11,20.24 Z M10,10 C10,9.44771525 10.4477153,9 11,9 C11.5522847,9 12,9.44771525 12,10 L12,15 C12,15.5522847 11.5522847,16 11,16 C10.4477153,16 10,15.5522847 10,15 L10,10 Z M11,8 C10.4477153,8 10,7.55228475 10,7 C10,6.44771525 10.4477153,6 11,6 C11.5522847,6 12,6.44771525 12,7 C12,7.55228475 11.5522847,8 11,8 Z">
                                                                        </path>
                                                                    </defs>
                                                                    <g fill="none" fill-rule="evenodd"
                                                                        transform="translate(1 1)">
                                                                        <g transform="translate(3 1)">
                                                                            <mask id="info-b" fill="#ffffff">
                                                                                <use xlink:href="#info-a">
                                                                                </use>
                                                                            </mask>
                                                                            <use fill="#D8D8D8" xlink:href="#info-a">
                                                                            </use>
                                                                            <g fill="#FFA0A0" mask="url(#info-b)">
                                                                                <rect width="24" height="24"
                                                                                    transform="translate(-4 -2)">
                                                                                </rect>
                                                                            </g>
                                                                        </g>
                                                                        <mask id="info-d" fill="#ffffff">
                                                                            <use xlink:href="#info-c">
                                                                            </use>
                                                                        </mask>
                                                                        <use fill="#000000" fill-rule="nonzero"
                                                                            xlink:href="#info-c"></use>
                                                                        <g fill="#7600FF" mask="url(#info-d)">
                                                                            <rect width="24" height="24"
                                                                                transform="translate(-1 -1)">
                                                                            </rect>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
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
                                                    25/25/2025
                                                </th>
                                            </tr>

                                            <tr>
                                                <th scope="row"
                                                    class=" py-3 font-medium text-muted-foreground whitespace-nowrap ">
                                                    Updated:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6 font-medium text-secondary-foreground whitespace-nowrap ">
                                                    25/25/2025
                                                </th>
                                            </tr>

                                            <tr>
                                                <th scope="row"
                                                    class="py-3 font-medium text-muted-foreground whitespace-nowrap ">
                                                    Dealine:
                                                </th>

                                                <th scope="row"
                                                    class="ps-6  font-medium   text-secondary-foreground whitespace-nowrap ">
                                                    -
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
import { FileStack, Kanban, StickyNote, Text, X } from 'lucide-vue-next';
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

const heading = ref();
const editor = useEditor({
    editorProps: {
        attributes: {
            class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto text-muted-foreground-none  max-h-82 h-32 overflow-y-auto',
        },
    },
    content: 'taskdnalksdn',
    extensions: [StarterKit],
})

watch((heading), (value) => {
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
})


const target = ref(null)

// onClickOutside(target, event => CloseDialog());

const emit = defineEmits();
const propsData = defineProps({
    isOpen: Boolean,
})

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
