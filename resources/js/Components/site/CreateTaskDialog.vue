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

                                <file-pond class="h-full" name="attachments" ref="filepond" class-name="my-pond"
                                    allow-multiple="true" :allow-image-edit="true"
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
import FilePondPluginImageEdit from 'filepond-plugin-image-edit/dist/filepond-plugin-image-edit.esm.js';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import 'filepond-plugin-image-edit/dist/filepond-plugin-image-edit.min.css';
import 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.min.css'
import '@pqina/pintura/pintura.css';
import {
    openEditor,
    createDefaultImageReader,
    createDefaultImageWriter,
    processImage,
    getEditorDefaults,
} from '@pqina/pintura/pintura.js';

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
const FilePond = vueFilePond(FilePondPluginImagePreview, FilePondPluginImageEdit);
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

const imageEditorOptions = ref({
    allowReorder: true,
    filePosterMaxHeight: 256,
    // used to create the editor, receives editor configuration, should return an editor instance
    createEditor: openEditor,

    // Required, used for reading the image data
    imageReader: [createDefaultImageReader],

    // optionally. can leave out when not generating a preview thumbnail and/or output image
    imageWriter: [
        // The image writer to use
        createDefaultImageWriter,
        // optional image writer instructions, this instructs the image writer to resize the image to match a width of 384 pixels
        {
            targetSize: {
                width: 128,
            },
        },

        /* Uncomment when editing videos, remove above code
        () =>
            createDefaultMediaWriter(
                // Generic Media Writer options, passed to image and video writer
                {
                    targetSize: {
                        width: 400,
                    },
                },
                [
                    // For handling images
                    createDefaultImageWriter(),

                    // For handling videos
                    createDefaultVideoWriter({
                        // Video writer instructions here
                        // ...

                        // Encoder to use
                        encoder: createMediaStreamEncoder({
                            imageStateToCanvas,
                        }),
                    }),
                ]
            ),
            */
    ],

    // used to generate poster images, runs an editor in the background
    imageProcessor: processImage,

    // Pintura Image Editor properties
    editorOptions: {
        // pass the editor default configuration options
        ...getEditorDefaults({
            /* Uncomment when editing videos
            locale: { ...plugin_trim_locale_en_gb },
            */
        }),

        // we want a square crop
        imageCropAspectRatio: 1,
    },

    /* uncomment if you've used FilePond with version 6 of Pintura and are loading old file metadata
    // map legacy data objects to new imageState objects
    legacyDataToImageState: legacyDataToImageState,
    */

});



//  filepond init function
function handleFilePondInit() {
    // example of instance method call on pond reference
    filepond.value.getFiles();

    // filepond.value._pond.on('addfile', (error, file) => {
    //     if (error) {
    //         console.error('FilePond error:');
    //     } else {

    //     }
    // });


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