<script setup lang="ts">
import type { Icon } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import {
    Command,
    CommandEmpty,
    CommandGroup,
    CommandInput,
    CommandItem,
    CommandList,
} from '@/components/ui/command'

import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover'
import { cn } from '@/utils'
import {
    ArrowUpCircle,
    CheckCircle2,
    CheckIcon,
    Circle,
    HelpCircle,
    XCircle,
} from 'lucide-vue-next'
import { computed, ref } from 'vue'
import Badge from './ui/badge/Badge.vue'
import { validators } from 'tailwind-merge'

interface Status {
    value: string
    label: string
    icon: Icon
}

const statuses: Status[] = [
    {
        value: 'backlog',
        label: 'Backlog',
        icon: HelpCircle,
    },
    {
        value: 'todo',
        label: 'Todo',
        icon: Circle,
    },
    {
        value: 'in progress',
        label: 'In Progress',
        icon: ArrowUpCircle,
    },
    {
        value: 'done',
        label: 'Done',
        icon: CheckCircle2,
    },
    {
        value: 'canceled',
        label: 'Canceled',
        icon: XCircle,
    },
]

const open = ref(false)
// const value = ref<typeof statuses[number]>()

const selectedStatus = ref([]);
const SelectItems = (selectedStatusFromUser) => {
    if (!selectedStatus.value.includes(selectedStatusFromUser)) {
        selectedStatus.value.push(selectedStatusFromUser);
    } else {
        const clickedIndex = selectedStatus.value.findIndex(item => item.value == selectedStatusFromUser.value)
        selectedStatus.value.splice(clickedIndex, 1);
    }
}

const isSelectedAboveTwo = computed(() => {
    return selectedStatus.value.length >= 3;
})


</script>

<template>
    <div class="flex items-center space-x-4">
        <p class="text-sm text-muted-foreground">
            Status
        </p>
        <Popover v-model:open="open">
            <PopoverTrigger as-child>
                <Button variant="outline" size="sm" class=" w-auto justify-between items-center flex">
                    <p>+ Set status </p>
                    <div class="flex  justify-center items-center">
                        <Badge v-for="(selectedItems, index) in selectedStatus" :key="index" variant="ghost"
                            v-if="!isSelectedAboveTwo" class="ms-2">
                            {{ selectedItems.label }}</Badge>

                        <Badge v-else class="ms-2">
                            {{ selectedStatus.length }} selected</Badge>
                    </div>
                </Button>
            </PopoverTrigger>

            <PopoverContent class="p-0" side="right" align="start">
                <Command>
                    <CommandInput placeholder="Change status..." />
                    <CommandList>
                        <CommandEmpty>No results found.</CommandEmpty>
                        <CommandGroup>
                            <CommandItem v-for="status in statuses" :key="status.value" :value="status.value"
                                @select="SelectItems(status)">
                                <div class="mr-2  h-4 w-4 items-center justify-center rounded-sm border border-primary"
                                    :class="{ ' bg-primary': selectedStatus.includes(status) }">
                                    <CheckIcon v-show="selectedStatus.includes(status)" :class="cn('h-4 w-4')" />
                                </div>
                                <span>{{ status.label }}</span>

                            </CommandItem>
                        </CommandGroup>
                    </CommandList>
                </Command>
            </PopoverContent>
        </Popover>
    </div>
</template>