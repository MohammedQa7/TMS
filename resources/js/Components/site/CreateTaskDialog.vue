<template>
    <Toaster :type="toastType" />
    <Dialog :open="isOpen">
        <DialogContent :hideCloseButton="true" class="max-h-[90dvh] overflow-y-auto">
            <DialogHeader>
                <DialogTitle>Create Task</DialogTitle>
            </DialogHeader>
            <!-- Main Content -->
            <div v-if="taskDialogStore.innerLoading" class="loading-indicator flex justify-center items-center">
                <Loader2 class="size-9 animate-spin text-center" />
            </div>
            <form v-else @submit.prevent="addTask" class="space-y-5">
                <div class="creation-fields space-y-5">
                    <div class="grid gap-2">
                        <Label for="subject">Name</Label>
                        <Input v-model="form.title" id="subject" placeholder="I need help with..." />
                        <InputError :message="form.errors.title" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="description">Description</Label>
                        <Textarea v-model="form.description" id="description"
                            placeholder="Please include all information relevant to your issue." />
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div class=" col-span-2 space-y-2">
                            <Label for="area">Estimated deadline</Label>
                            <CalendarPickerComponent @bindDate="bindSelectedDate" />

                        </div>

                        <div class=" col-span-2 space-y-2">
                            <Label for="area">Priority</Label>
                            <Popover v-model:open="open">
                                <PopoverTrigger as-child>
                                    <Button variant="outline" role="combobox" :aria-expanded="open"
                                        class="w-[200px] justify-between">
                                        {{ form.priority ? taskDialogStore.taskPriorites.find((priority) =>
                                            priority.value ===
                                            form.priority?.value)?.label :
                                            'Select framework...' }}
                                        <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                                    </Button>
                                </PopoverTrigger>
                                <PopoverContent class="w-[200px] p-0">
                                    <Command v-model="form.priority">
                                        <CommandList>
                                            <CommandEmpty>No results found.</CommandEmpty>
                                            <CommandGroup>
                                                <CommandItem v-for="priority in taskDialogStore.taskPriorites"
                                                    :key="priority.value" :value="priority" @select="open = false"
                                                    :class="{ 'bg-muted': form.priority.value === priority.value }">
                                                    <!-- <Check :class="cn(
                                                        'mr-2 h-4 w-4',
                                                        form.priority.value === priority.value ? 'opacity-100' : 'opacity-0',
                                                    )" />
                                                    {{ priority.label }} -->

                                                    <div class="flex items-start gap-3 text-muted-foreground ">
                                                        <Flag class="size-5 "
                                                            :class="appendPriorityClass(priority.value)" />
                                                        <div class="grid gap-0.5">
                                                            <p>
                                                                <span class="font-medium text-foreground">
                                                                    {{ priority.value }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </CommandItem>
                                            </CommandGroup>
                                        </CommandList>
                                    </Command>
                                </PopoverContent>
                            </Popover>
                            <InputError :message="form.errors.priority" />
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <div class="attachments">
                            <Label class="mb-2">Attachments (Optional)</Label>
                            <!-- FilePond -->
                            <Card>

                                <file-pond class="h-full" name="attachments" ref="filepond" class-name="my-pond" allow-multiple="true"
                                    label-idle="Drag & Drop Or Click to Upload" v-bind:files="myFiles"
                                    v-on:init="handleFilePondInit" :server="{
                                        url: '',
                                        process: {
                                            url: '/attachment/upload',
                                            method: 'post',
                                            onload: handleMultipleFilePondLoad,
                                        },
                                        revert: handleMultipleFilePondRevert,
                                        headers: {
                                            'X-CSRF-TOKEN': $page.props.csrf
                                        }
                                    }" />
                            </Card>
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <Label for="members">Members</Label>
                        <Popover>
                            <PopoverTrigger as-child>
                                <Button variant="outline" size="sm" class=" w-auto justify-between items-center flex">
                                    <p>+ Assign members </p>
                                    <div class="flex  justify-center items-center">
                                        <Badge v-for="(selectedItems, index) in form.selectedMembers" :key="index"
                                            variant="ghost" v-if="!isSelectedAboveTwo" class="ms-2">
                                            {{ selectedItems.name }}</Badge>

                                        <Badge v-else class="ms-2">
                                            {{ form.selectedMembers.length }} selected</Badge>
                                    </div>
                                </Button>
                            </PopoverTrigger>

                            <PopoverContent class="p-0 w-[100%]" side="bottom">
                                <Command>
                                    <CommandInput placeholder="search by name..." />
                                    <CommandList>
                                        <CommandEmpty>No results found.</CommandEmpty>
                                        <CommandGroup>
                                            <div v-for="member in taskDialogStore.members" :key="member.name"
                                                class="grid grid-cols-12 gap-4">
                                                <div class=" col-span-9">
                                                    <CommandItem :value="member.name" @select="SelectItems(member)"
                                                        class="flex  justify-between
                                            items-center"
                                                        :class="{ 'bg-muted': form.selectedMembers.includes(member) }">
                                                        <div class="members-details flex items-center gap-2">
                                                            <img class="rounded-full size-8 object-cover"
                                                                src="../../../../public/Assets/images/testimage.png"
                                                                alt="test">
                                                            <div class="flex flex-col items-start">
                                                                <span>{{ member.name }}</span>
                                                                <span class="text-xs text-muted-foreground">{{
                                                                    member.email
                                                                    }}
                                                                    {{ member.role ?? 'none' }}</span>
                                                            </div>
                                                        </div>
                                                        <Check v-show="form.selectedMembers.includes(member)"
                                                            class="size-4" />

                                                    </CommandItem>
                                                </div>
                                                <div class="col-span-3 flex justify-center items-center">
                                                    <Popover>
                                                        <PopoverTrigger as-child>
                                                            <Button variant="outline" size="sm"
                                                                class=" w-auto justify-between items-center flex">
                                                                <p>Permissions </p>
                                                                <div class="flex  justify-center items-center">
                                                                    <Badge v-if="member.permissions.length > 0"
                                                                        class="ms-2">
                                                                        {{ member.permissions.length }} selected
                                                                    </Badge>
                                                                </div>
                                                            </Button>
                                                        </PopoverTrigger>

                                                        <PopoverContent class="p-0 " side="bottom">
                                                            <Command>
                                                                <CommandList>
                                                                    <CommandEmpty>No results found.</CommandEmpty>
                                                                    <CommandGroup>
                                                                        <div v-for="permission in permissions"
                                                                            :key="permission.name">
                                                                            <CommandItem :value="permission.name"
                                                                                @select="SelectRoles(member, permission.name)"
                                                                                class="flex justify-between items-center"
                                                                                :class="{ 'bg-muted': member.permissions.includes(permission.name) }">
                                                                                <div
                                                                                    class="members-details flex items-center gap-2">
                                                                                    <div
                                                                                        class="flex flex-col items-start">
                                                                                        <span>{{ permission.name
                                                                                            }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </CommandItem>
                                                                        </div>
                                                                    </CommandGroup>
                                                                </CommandList>
                                                            </Command>
                                                        </PopoverContent>
                                                    </Popover>
                                                </div>
                                            </div>

                                        </CommandGroup>
                                    </CommandList>
                                </Command>
                            </PopoverContent>
                        </Popover>
                    </div>

                </div>
                <DialogFooter>
                    <Button type="submit" :disabled="form.processing"> Create </Button>
                </DialogFooter>
            </form>
            <DialogClose @click.prevent="CloseDialog"
                class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground">
                <X class="w-4 h-4" />
                <span class="sr-only">Close</span>
            </DialogClose>
        </DialogContent>
    </Dialog>
</template>

<script setup>
import vueFilePond from 'vue-filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import {
    Dialog,
    DialogContent,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import Button from '../ui/button/Button.vue';
import { Check, ChevronsUpDown, Flag, Loader2, X } from 'lucide-vue-next';
import Label from '../ui/label/Label.vue';
import Textarea from '../ui/textarea/Textarea.vue';
import Input from '../ui/input/Input.vue';
import Popover from '../ui/popover/Popover.vue';
import PopoverTrigger from '../ui/popover/PopoverTrigger.vue';
import PopoverContent from '../ui/popover/PopoverContent.vue';
import CommandList from '../ui/command/CommandList.vue';
import Command from '../ui/command/Command.vue';
import CommandGroup from '../ui/command/CommandGroup.vue';
import CommandItem from '../ui/command/CommandItem.vue';
import { closeDialog } from '@/Composable/closeDialog';
import { Toaster } from '../ui/toast';
import { useToast } from '../ui/toast';
import { ref, onMounted, computed } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import CalendarPickerComponent from './CalendarPickerComponent.vue';
import { DialogClose } from 'radix-vue';
import { appendPriorityClass } from '@/Composable/taskPriorities';
import CommandInput from '../ui/command/CommandInput.vue';
import CommandEmpty from '../ui/command/CommandEmpty.vue';
import Badge from '../ui/badge/Badge.vue';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import InputError from '../InputError.vue';
import Card from '../ui/card/Card.vue';
const taskDialogStore = useTaskDialogStore();
const FilePond = vueFilePond(FilePondPluginImagePreview);
const filepond = ref();
const myFiles = ref([]);
const { toast } = useToast();
const emit = defineEmits();
const open = ref(false);
const toastType = ref('');
const propsData = defineProps({
    isOpen: Boolean,
})
const form = useForm({
    title: '',
    description: '',
    priority: '',
    finishDate: null,
    projectSlug: null,
    groupTaskID: null,
    attachments: [],
    selectedMembers: [],
})
const permissions = ref([
    { name: 'edit' },
    { name: 'delete' },
    { name: 'new' },
])

const addTask = () => {
    form.projectSlug = taskDialogStore.projectSlug;
    form.groupTaskID = taskDialogStore.groupTaskID;
    form.post(route('tasks.store'), {
        onSuccess: () => {
            toastType.value = 'success';
            form.reset();
            filepond.value.removeFiles();
            myFiles.value = [];
            toast({
                title: 'Task created successfuly',
            });
        },
        onError: () => {
            form.reset();
            toastType.value = 'danger';
            toast({
                title: 'Something went wrong while creating task',
            });
        }
    });
}



//  filepond init function
function handleFilePondInit() {
    // example of instance method call on pond reference
    filepond.value.getFiles();
};

// Handling multi Image load/store Filepone
function handleMultipleFilePondLoad(response) {
    response = JSON.parse(response);

    form.attachments.push(response);
    return response;
}

// Handling multi Image Revert Filepone
function handleMultipleFilePondRevert(attachment, load, error) {

    form.attachments = form.attachments.filter((attach) => attach.path !== attachment.path);
    router.post(route('attachment-revert'), {
        attachments_path: attachment.path
    });
}



const bindSelectedDate = (date) => {
    form.finishDate = date.Date;
}

const SelectItems = (selectedMembersFromUser) => {
    if (!form.selectedMembers.includes(selectedMembersFromUser)) {
        form.selectedMembers.push(selectedMembersFromUser);
    } else {
        const clickedIndex = form.selectedMembers.findIndex(item => item == selectedMembersFromUser)
        form.selectedMembers.splice(clickedIndex, 1);
    }
}

const SelectRoles = (member, role) => {
    if (!member?.permissions?.includes(role)) {
        member.permissions.push(role);
    } else {
        const clickedIndex = member.permissions.findIndex(item => item == role)
        member.permissions.splice(clickedIndex, 1);
    }
}
const isSelectedAboveTwo = computed(() => {

    return form.selectedMembers.length >= 2;
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