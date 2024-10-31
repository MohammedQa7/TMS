<template>

    <div class="control-group">
        <div class="button-group">
            <Button variant="outline" @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().chain().focus().toggleBold().run()"
                :class="{ ' bg-muted-foreground': editor.isActive('bold') }">
                <Bold class="size-4" />
            </Button>
            <Button variant="outline" aria-label="Toggle italic" @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                :class="{ 'bg-muted-foreground': editor.isActive('italic') }">
                <Italic class="w-4 h-4" />
            </Button>

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
            <Button variant="outline" @click="editor.chain().focus().toggleStrike().run()"
                :disabled="!editor.can().chain().focus().toggleStrike().run()"
                :class="{ 'bg-muted-foreground': editor.isActive('strike') }">
                <Strikethrough class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleCode().run()"
                :disabled="!editor.can().chain().focus().toggleCode().run()"
                :class="{ 'bg-muted-foreground': editor.isActive('code') }">
                <Code class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 1 }) }">
                <Heading1 class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 2 }) }">
                <Heading2 class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 3 }) }">
                <Heading3 class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 4 }) }">
                <Heading4 class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleHeading({ level: 5 }).run()"
                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 5 }) }">
                <Heading5 class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleHeading({ level: 6 }).run()"
                :class="{ 'bg-muted-foreground': editor.isActive('heading', { level: 6 }) }">
                <Heading6 class="size-4" />
            </Button>
            <Button variant="outline" @click="editor.chain().focus().toggleBulletList().run()"
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

</template>

<script setup>
import { Bold, Code, Code2Icon, Heading1, Heading2, Heading3, Heading4, Heading5, Heading6, Italic, List, ListOrdered, MessageSquareCode, MessageSquareQuote, Redo, Strikethrough, Undo } from 'lucide-vue-next';
import Button from '../ui/button/Button.vue';
import Select from '../ui/select/Select.vue';
import SelectTrigger from '../ui/select/SelectTrigger.vue';
import SelectValue from '../ui/select/SelectValue.vue';
import SelectContent from '../ui/select/SelectContent.vue';
import SelectGroup from '../ui/select/SelectGroup.vue';
import SelectItem from '../ui/select/SelectItem.vue';
import { ref, watch } from 'vue';

const heading = ref();
const propsData = defineProps({
    editor: Object,
})


watch((heading), (value) => {
    switch (value) {
        case "paragraph":
            propsData.editor.chain().focus().setParagraph().run()
            break
        case "h1":
            propsData.editor.chain().focus().toggleHeading({ level: 1 }).run()
            break
        case "h2":
            propsData.editor.chain().focus().toggleHeading({ level: 2 }).run()
            break
        case "h3":
            propsData.editor.chain().focus().toggleHeading({ level: 3 }).run()
            break
        case "h4":
            propsData.editor.chain().focus().toggleHeading({ level: 4 }).run()
            break
        case "h5":
            propsData.editor.chain().focus().toggleHeading({ level: 5 }).run()
            break
        case "h6":
            propsData.editor.chain().focus().toggleHeading({ level: 6 }).run()
            break
    }
})

</script>