<template>
    <Dialog>
        <DialogTrigger>
            <Button variant="outline" class="rounded-full">
                <UserPlus />
                {{ text }}
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Create Workspace</DialogTitle>
            </DialogHeader>
            <!-- Main Content -->
            <div class="creation-fields space-y-5">
                <div class="grid gap-2">
                    <Label for="subject">Name</Label>
                    <Input id="subject" placeholder="I need help with..." />
                </div>
                <div class="grid gap-2">
                    <Label for="description">Description</Label>
                    <Textarea id="description" placeholder="Please include all information relevant to your issue." />
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="grid col-span-2 gap-2">
                        <Label for="area">Due date</Label>
                        <DatePicker />
                    </div>
                    <div class="grid col-span-1 gap-2">
                        <Label for="security-level">Estimated budget</Label>
                        <Drawer>
                            <DrawerTrigger>
                                <Button variant="outline" :class="cn(
                                    'flex  justify-start text-left h-auto',
                                    !budget && 'text-muted-foreground',
                                )">
                                    <DollarSign class="mr-2 h-4 w-4" />
                                    <template v-if="budget > 0">
                                        {{ budget }}
                                    </template>
                                    <template v-else>
                                        Enter budget
                                    </template>
                                </Button>
                            </DrawerTrigger>
                            <DrawerContent>
                                <div class="mx-auto w-full max-w-sm">
                                    <DrawerHeader>
                                        <DrawerTitle>Budget</DrawerTitle>
                                        <DrawerDescription>Set your estimated workspace budget </DrawerDescription>
                                    </DrawerHeader>
                                    <div class="p-4 pb-0">
                                        <div class="flex items-center justify-center space-x-2">
                                            <Button variant="outline" size="icon" class="h-8 w-8 shrink-0 rounded-full"
                                                :disabled="budget <= 0" @click="budget -= 10">
                                                <MinusIcon class="h-4 w-4" />
                                                <span class="sr-only">Decrease</span>
                                            </Button>
                                            <div class="flex-1 text-center">
                                                <div class="text-7xl font-bold ">
                                                    <Input
                                                        class=" outline-none border-none text-7xl font-bold   text-center h-auto"
                                                        v-model="budget" />
                                                </div>
                                            </div>

                                            <Button variant="outline" size="icon" class="h-8 w-8 shrink-0 rounded-full"
                                                @click="budget += 10">
                                                <PlusIcon class="h-4 w-4" />
                                                <span class="sr-only">Increase</span>
                                            </Button>
                                        </div>
                                        <div class="my-3 px-3 h-[120px]">
                                            <VisXYContainer :data="data" class="h-[120px]" :style="{
                                                'opacity': 0.9,
                                                '--theme-primary': `hsl(var(--foreground))`,
                                            }">
                                                <VisStackedBar :x="(d: Data, i: number) => i" :y="(d: Data) => d.goal"
                                                    color="var(--theme-primary)" :bar-padding="0.1"
                                                    :rounded-corners="0" />
                                            </VisXYContainer>
                                        </div>
                                    </div>
                                    <DrawerFooter>
                                        <DrawerClose>
                                            <Button class="w-full">
                                                Submit
                                            </Button>
                                        </DrawerClose>
                                        <DrawerClose as-child>
                                            <Button @click.prevent="budget = null" variant="outline">
                                                Cancel
                                            </Button>
                                        </DrawerClose>
                                    </DrawerFooter>
                                </div>
                            </DrawerContent>
                        </Drawer>
                    </div>
                </div>

                <div class="grid gap-2">
                    <Label for="members">Members</Label>
                    <Popover v-model:open="open" class="">
                        <PopoverTrigger as-child>
                            <Button variant="outline" size="sm" class=" w-auto justify-between items-center flex">
                                <p>+ Assign members </p>
                                <div class="flex  justify-center items-center">
                                    <Badge v-for="(selectedItems, index) in selectedStatus" :key="index" variant="ghost"
                                        v-if="!isSelectedAboveTwo" class="ms-2">
                                        {{ selectedItems.label }}</Badge>

                                    <Badge v-else class="ms-2">
                                        {{ selectedStatus.length }} selected</Badge>
                                </div>
                            </Button>
                        </PopoverTrigger>

                        <PopoverContent class="p-0 max-w-[460px] w-[460px]" side="bottom">
                            <Command>
                                <CommandInput placeholder="search by name..." />
                                <CommandList>
                                    <CommandEmpty>No results found.</CommandEmpty>
                                    <CommandGroup >
                                        <CommandItem v-for="status in statuses" :key="status.value"
                                            :value="status.value" @select="SelectItems(status)" class="flex justify-between
                                            items-center" :class="{ 'bg-muted': selectedStatus.includes(status) }">
                                            <div class="members-details flex items-center gap-2">
                                                <img class="rounded-full size-8 object-cover"
                                                    src="../../../../public/Assets/images/testimage.png" alt="test">
                                                <div class="flex flex-col items-start">
                                                    <span>{{ status.label }}</span>
                                                    <span class="text-xs text-muted-foreground">mohammed@gmail.com .
                                                        Junior Laravel
                                                        Developer</span>
                                                </div>
                                            </div>
                                            <Check v-show="selectedStatus.includes(status)" class="size-4" />
                                        </CommandItem>
                                    </CommandGroup>
                                </CommandList>
                            </Command>
                        </PopoverContent>
                    </Popover>
                </div>

            </div>

            <DialogFooter>
                <Button>
                    Save changes
                </Button>

            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import Button from '../ui/button/Button.vue';
import { DollarSign, UserPlus, PlusIcon, MinusIcon, HelpCircle, Circle, ArrowUpCircle, CheckCircle2, XCircle, Check } from 'lucide-vue-next';
import Label from '../ui/label/Label.vue';
import Textarea from '../ui/textarea/Textarea.vue';
import Input from '../ui/input/Input.vue';
import DatePicker from './DatePicker.vue';
import Drawer from '../ui/drawer/Drawer.vue';
import { DrawerClose, DrawerTrigger } from 'vaul-vue';
import { computed, ref, watch } from 'vue';
import { cn } from '@/utils'
import { VisStackedBar, VisXYContainer } from '@unovis/vue'
import DrawerContent from '../ui/drawer/DrawerContent.vue';
import DrawerHeader from '../ui/drawer/DrawerHeader.vue';
import DrawerDescription from '../ui/drawer/DrawerDescription.vue';
import DrawerTitle from '../ui/drawer/DrawerTitle.vue';
import DrawerFooter from '../ui/drawer/DrawerFooter.vue';
import Popover from '../ui/popover/Popover.vue';
import PopoverTrigger from '../ui/popover/PopoverTrigger.vue';
import Badge from '../ui/badge/Badge.vue';
import PopoverContent from '../ui/popover/PopoverContent.vue';
import CommandList from '../ui/command/CommandList.vue';
import CommandInput from '../ui/command/CommandInput.vue';
import Command from '../ui/command/Command.vue';
import CommandEmpty from '../ui/command/CommandEmpty.vue';
import CommandGroup from '../ui/command/CommandGroup.vue';
import CommandItem from '../ui/command/CommandItem.vue';

type Data = typeof data[number]
const data = [
    { goal: 400 },
    { goal: 300 },
    { goal: 200 },
    { goal: 300 },
    { goal: 200 },
    { goal: 278 },
    { goal: 189 },
    { goal: 239 },
    { goal: 300 },
    { goal: 200 },
    { goal: 278 },
    { goal: 189 },
    { goal: 349 },
]
const budget = ref(0);

watch((budget), (value) => {

    if (value <= 0) {
        budget.value = 0;
    }
})
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
    return selectedStatus.value.length >= 4;
})
const propsData = defineProps({
    text: null
});
</script>