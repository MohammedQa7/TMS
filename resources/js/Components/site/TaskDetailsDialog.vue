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
                <div class="col-span-9  border border-red-400 overflow-y-auto p-6">
                    <div class="flex flex-col gap-20 h-[300dvh]">
                        <div class="task-header flex flex-col gap-4">
                            <div class="task-name flex justify-start items-center gap-2">
                                <StickyNote class="size-6" />
                                <h1 class="text-2xl font-extrabold">Task name</h1>
                                <!-- <Input type="text" placeholder="task name" class=" h-12" /> -->
                            </div>
                            <div class="flex flex-col   gap-2">
                                <div class="task-description flex justify-start items-center gap-2">
                                    <Text class="size-6" />
                                    <h1 class="text-2xl font-extrabold">Task Description</h1>
                                </div>
                                <div class="rich-editor border border-red-400">
                                    <div class="control-group">
                                        <div class="button-group">
                                            <Select v-model="heading">
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Select a heading" />
                                                    <SelectContent>
                                                        <SelectGroup>
                                                            <SelectItem value="paragraph">Paragraph</SelectItem>
                                                            <SelectItem value="h1">H1</SelectItem>
                                                            <SelectItem value="h2">H2</SelectItem>
                                                            <SelectItem value="h3">H3</SelectItem>
                                                            <SelectItem value="h4">H4</SelectItem>
                                                            <SelectItem value="h5">H5</SelectItem>
                                                            <SelectItem value="h6">H6</SelectItem>
                                                        </SelectGroup>
                                                    </SelectContent>
                                                </SelectTrigger>
                                            </Select>
                                            <Button variant="outline" @click="editor.chain().focus().toggleBold().run()"
                                                :disabled="!editor.can().chain().focus().toggleBold().run()"
                                                :class="{ ' bg-muted-foreground': editor.isActive('bold') }">
                                                <Bold class="size-4" />
                                            </Button>
                                            <Button variant="outline" aria-label="Toggle italic"
                                                @click="editor.chain().focus().toggleItalic().run()"
                                                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('italic') }">
                                                <Italic class="w-4 h-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleStrike().run()"
                                                :disabled="!editor.can().chain().focus().toggleStrike().run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('strike') }">
                                                <Strikethrough class="size-4" />
                                            </Button>
                                            <Button variant="outline" @click="editor.chain().focus().toggleCode().run()"
                                                :disabled="!editor.can().chain().focus().toggleCode().run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('code') }">
                                                <Code class="size-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 1 }) }">
                                                <Heading1 class="size-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 2 }) }">
                                                <Heading2 class="size-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 3 }) }">
                                                <Heading3 class="size-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 4 }) }">
                                                <Heading4 class="size-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleHeading({ level: 5 }).run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 5 }) }">
                                                <Heading5 class="size-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleHeading({ level: 6 }).run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 6 }) }">
                                                <Heading6 class="size-4" />
                                            </Button>
                                            <Button variant="outline"
                                                @click="editor.chain().focus().toggleBulletList().run()"
                                                :class="{ 'bg-muted-foreground': editor.isActive('bulletList') }">
                                                <List class="size-4" />
                                            </Button>

                                            <Button variant="outline" @click="editor.chain().focus().undo().run()"
                                                :disabled="!editor.can().chain().focus().undo().run()">
                                                <Undo class="size-4" />
                                            </Button>
                                            <Button variant="outline" @click="editor.chain().focus().redo().run()"
                                                :disabled="!editor.can().chain().focus().redo().run()">
                                                <Redo class="size-4" />
                                            </Button>

                                        </div>
                                    </div>

                                </div>
                                
                                <div class="border rounded  ">
                                    <EditorContent :editor="editor" />
                                </div>

                            </div>

                        </div>
                        <div class="task-activity flex justify-start items-center gap-2">
                            <Kanban class="size-6" />
                            <h1 class="text-2xl font-extrabold">Task name</h1>
                        </div>

                    </div>
                </div>

                <div class="col-span-3 border border-red-400">

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
import { Kanban, StickyNote, Text, X } from 'lucide-vue-next';
import { DialogClose } from 'radix-vue';
import { ref, onMounted, watch } from 'vue';
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Button from '../ui/button/Button.vue';
import { Bold, Code, Code2Icon, Heading1, Heading2, Heading3, Heading4, Heading5, Heading6, Italic, List, ListOrdered, MessageSquareCode, MessageSquareQuote, Redo, Strikethrough, Undo } from 'lucide-vue-next';
import Select from '../ui/select/Select.vue';
import SelectTrigger from '../ui/select/SelectTrigger.vue';
import SelectValue from '../ui/select/SelectValue.vue';
import SelectContent from '../ui/select/SelectContent.vue';
import SelectGroup from '../ui/select/SelectGroup.vue';
import SelectItem from '../ui/select/SelectItem.vue';

const heading = ref();
const content = ref('');
const editor = useEditor({
    content: content.value,
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

