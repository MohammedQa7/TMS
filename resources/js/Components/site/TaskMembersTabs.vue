<template>
    <div v-if="taskDialogStore.innerLoading" class="loading-indicator flex justify-center items-center">
        <Loader2 class="size-9 animate-spin text-center" />
    </div>
    <Tabs v-else v-model="currentTab" :default-value="currentTab" class="w-full">
        <TabsList class="grid w-full grid-cols-2">
            <TabsTrigger value="inviteMembers">
                Invite Members
            </TabsTrigger>
            <TabsTrigger value="currentMembers" class="w-full text-muted-foreground">
                Current Members
            </TabsTrigger>
        </TabsList>
        <TabsContent value="inviteMembers">
            <Card>
                <CardHeader>
                    <CardTitle>Invite Members</CardTitle>
                    <CardDescription>
                        You can directly invite them or copy the link and send it.
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-5">
                    <div class="flex justify-center items-center gap-2">
                        <Input />
                        <TooltipProvider>
                            <Tooltip :delay-duration="100">
                                <TooltipTrigger as-child>
                                    <Button @click.prevent="CopyLink">
                                        <Copy v-if="!isCopied" class="size-4" />
                                        <CheckCircle v-else class="size-4" />
                                        <p v-show="isCopied">{{ copyBtnText }}</p>
                                    </Button>
                                </TooltipTrigger>
                                <TooltipContent>
                                    <p>{{ copyBtnText }}</p>
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>
                    </div>
                    <Separator label="Or" />
                    <div class="grid gap-2">
                        <Label for="members">Members</Label>
                        <Popover>
                            <PopoverTrigger as-child>
                                <Button variant="outline" size="sm" class=" w-auto justify-between items-center flex">
                                    <p>+ Assign members </p>
                                    <div class="flex  justify-center items-center">
                                        <Badge v-for="(selectedItems, index) in selectedMembers" :key="index"
                                            variant="ghost" v-if="!isSelectedAboveTwo" class="ms-2">
                                            {{ selectedItems.name }}</Badge>

                                        <Badge v-else class="ms-2">
                                            {{ selectedMembers.length }} selected</Badge>
                                    </div>
                                </Button>
                            </PopoverTrigger>

                            <PopoverContent class="p-0 max-w-[460px] w-[460px]" side="bottom">
                                <Command>
                                    <CommandInput placeholder="search by name..." />
                                    <CommandList>
                                        <CommandEmpty>No results found.</CommandEmpty>
                                        <CommandGroup>
                                            <CommandItem v-for="member in taskDialogStore.members" :key="member.name"
                                                :value="member.name" @select="SelectItems(member)" class="flex justify-between
                                            items-center" :class="{ 'bg-muted': selectedMembers.includes(member) }">
                                                <div class="members-details flex items-center gap-2">
                                                    <img class="rounded-full size-8 object-cover"
                                                        src="../../../../public/Assets/images/testimage.png" alt="test">
                                                    <div class="flex flex-col items-start">
                                                        <span>{{ member.name }}</span>
                                                        <span class="text-xs text-muted-foreground">{{ member.email }}
                                                            .
                                                            Junior Laravel
                                                            Developer</span>
                                                    </div>
                                                </div>
                                                <Check v-show="selectedMembers.includes(member)" class="size-4" />
                                            </CommandItem>
                                        </CommandGroup>
                                    </CommandList>
                                </Command>
                            </PopoverContent>
                        </Popover>
                    </div>

                </CardContent>
            </Card>
        </TabsContent>
        <TabsContent value="currentMembers">
            <div v-if="taskDialogStore.innerLoading" class="loading-indicator flex justify-center items-center">
                <Loader2 class="size-9 animate-spin text-center" />
            </div>
            <Card v-else>
                <CardHeader>
                    <CardTitle>Members</CardTitle>
                    <CardDescription>
                        Remove any memeber you want
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-2">
                    <ScrollArea v-if="taskDialogStore.currentMembers.length > 0" class="h-64">
                        <div v-for="member in taskDialogStore.currentMembers" :key="member.name"
                            class="flex justify-between items-center mb-4">
                            <div class="members-details flex items-center gap-2">
                                <img class="rounded-full size-8 object-cover"
                                    src="../../../../public/Assets/images/testimage.png" alt="test">
                                <div class="flex flex-col items-start">
                                    <span>{{ member.name }}</span>
                                    <span class="text-xs text-muted-foreground">mohammed@gmail.com .
                                        Junior Laravel
                                        Developer</span>
                                </div>
                            </div>

                            <TooltipComponent :tooltip-text="'remove member from task'">
                                <Button @click.prevent="toggleDeleteDialog(member.id)" variant="destructive">
                                    <MinusCircle class="size-5" />
                                </Button>
                            </TooltipComponent>
                        </div>
                    </ScrollArea>
                    <Card v-else>
                        <CardContent class="p-4 text-center">
                            <div class="inline-block px-6 py-3 border rounded-lg bg-primary-foreground ">
                                <XCircleIcon />
                            </div>
                            <h1 class=" font-semibold text-sm">No members were found</h1>
                        </CardContent>
                    </Card>
                </CardContent>
            </Card>
        </TabsContent>
    </Tabs>
</template>

<script setup>
import { Button } from '@/components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/components/ui/tabs'
import ScrollArea from '../ui/scroll-area/ScrollArea.vue'
import { CommandInput, CommandItem } from '../ui/command'
import { ChartColumnStacked, Check, CheckCircle, Copy, Loader2, MinusCircle, XCircle, XCircleIcon } from 'lucide-vue-next'
import TooltipProvider from '../ui/tooltip/TooltipProvider.vue'
import Tooltip from '../ui/tooltip/Tooltip.vue'
import TooltipTrigger from '../ui/tooltip/TooltipTrigger.vue'
import TooltipContent from '../ui/tooltip/TooltipContent.vue'
import { PopoverContent } from 'radix-vue'
import CommandList from '../ui/command/CommandList.vue'
import CommandEmpty from '../ui/command/CommandEmpty.vue'
import CommandGroup from '../ui/command/CommandGroup.vue'
import { computed, ref, watch } from 'vue'
import Popover from '../ui/popover/Popover.vue'
import PopoverTrigger from '../ui/popover/PopoverTrigger.vue'
import Badge from '../ui/badge/Badge.vue'
import Command from '../ui/command/Command.vue'
import Separator from '../ui/separator/Separator.vue'
import { useTaskDialogStore } from '@/store/TaskDialogStore'
import TooltipComponent from '../TooltipComponent.vue'
import eventBus from '@/Composable/eventBus'
const emit = defineEmits();
const taskDialogStore = useTaskDialogStore();
const isCopied = ref(false);
const copyBtnText = ref('Copy');
const inviteLink = ref('www.google.com');
const currentTab = ref('inviteMembers');

const selectedMembers = ref([]);
const SelectItems = (selectedStatusFromUser) => {
    if (!selectedMembers.value.includes(selectedStatusFromUser)) {
        selectedMembers.value.push(selectedStatusFromUser);
    } else {
        const clickedIndex = selectedMembers.value.findIndex(item => item.value == selectedStatusFromUser.value)
        selectedMembers.value.splice(clickedIndex, 1);
    }
}
const isSelectedAboveTwo = computed(() => {
    return selectedMembers.value.length >= 4;
});


// Send a event to the parent component when the selected items chagnes 
watch((selectedMembers), (membersArray) => {
    emit('bindSelectedMembers', membersArray)
}, { deep: true });

// watch of the tab changed to make a request for getting the users in a specific tab
watch((currentTab), (value) => {
    if (value == 'currentMembers') {
        taskDialogStore.getTaskUsers();
    }
})


const toggleDeleteDialog = (member) => {
    eventBus.emit('open-delete', {
        route: route('remove-member-from-task', { task: taskDialogStore.taskID, member: member, }),
        successText: 'Member was removed',
        errorText: 'Something went wrong while removing the member',
    },);
}



const CopyLink = () => {
    navigator.clipboard.writeText(inviteLink.value);
    copyBtnText.value = 'Copied';
    isCopied.value = !isCopied.value;
    setTimeout(() => {
        copyBtnText.value = 'Copy';
        isCopied.value = !isCopied.value;
    }, 3000);

}
</script>
