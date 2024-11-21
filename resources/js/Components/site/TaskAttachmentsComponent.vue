<template>
    <Collapsible v-model:open="isOpen" class="w-full space-y-2">
        <div class="flex items-center justify-between space-x-4 px-4">
            <h4 v-if="!isOpen" class="text-sm font-semibold">* Attachments are collapsed</h4>
            <h4 v-else class="text-sm font-semibold"></h4>
            <CollapsibleTrigger as-child>
                <Button variant="ghost" size="sm" class="w-9 p-0">
                    <ChevronsUpDownIcon class="h-4 w-4" />
                    <span class="sr-only">Toggle</span>
                </Button>
            </CollapsibleTrigger>
        </div>
        <CollapsibleContent class="space-y-2">
            <div v-for="(attachment, index) in taskDialogStore?.singleTask?.attachments" :key="index"
                class=" rounded-md border px-4 py-3 font-mono text-sm underline cursor-pointer"
                @click.prevent="download(attachment)">
                {{ attachment.fileOriginalName }}
            </div>
        </CollapsibleContent>
    </Collapsible>
</template>

<script setup>
import { Button } from '@/components/ui/button'
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible'
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import { ChevronsUpDownIcon } from 'lucide-vue-next';
import { ref } from 'vue'
const taskDialogStore = useTaskDialogStore();
const isOpen = ref(true);

const download = (attachment) => {
    const url = route('download', { attachmentPath: attachment['filePath'] });
    window.location.href = url
}
</script>