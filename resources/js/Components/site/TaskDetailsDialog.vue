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
            <div v-if="taskDialogStore.innerLoading" class="loading-indicator flex justify-center items-center">
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


                            <!-- Task Checklists -->
                            <TaskChecklistsComponent />

                            <!-- Task Attachments -->
                            <div class="task-attach ">
                                <div class="flex justify-start items-center gap-2">
                                    <FileStack class="size-6" />
                                    <h1 class="text-2xl font-extrabold">Attachments</h1>
                                </div>

                                <TaskAttachmentsComponent />

                            </div>
                        </div>
                        <!-- Task activites and comments -->
                        <!-- v-if="taskDialogStore.can.VIEW_CHAT" -->
                        <!--  v-if="taskDialogStore.can.SEND_MESSAGE" -->
                        <div class="task-activity flex flex-col  gap-2">
                            <div class="flex justify-start items-center">
                                <Kanban class="size-6" />
                                <h1 class="text-2xl font-extrabold">Task activity</h1>
                            </div>
                            <div class="message-container space-y-3">
                                <Mentionable :keys="['@']" :items="taskDialogStore.singleTask?.members"
                                    :autoHide="false">
                                    <Textarea v-model="text" />
                                    <template #no-result>
                                        <div class="px-6 py-3">No result</div>
                                    </template>
                                    <template #item-@="{ item }">
                                        <div class="flex justify-start items-center gap-3 px-6">
                                            <div class="avatar w-12 h-12">
                                                <img class="w-full h-full object-cover rounded-full border"
                                                    src="../../../../public/Assets/images/testimage.png" alt="">
                                            </div>
                                            <div class="username">
                                                {{ item.value }}
                                            </div>
                                        </div>
                                    </template>
                                </Mentionable>
                                <div>
                                    <Button @click.prevent="send">
                                        <Send />
                                    </Button>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-col-reverse chat-messages space-y-6">
                                <div v-for="(message, index) in formatedMentionMessages" :key="index"
                                    class="user-info flex items-start gap-2">
                                    <div
                                        class="avatar flex justify-center items-center w-12 h-12 rounded-full overflow-hidden border">
                                        <img v-if="message.sender.profilePhoto" class="w-full h-full object-cover"
                                            :src="message.sender.profilePhoto" alt="">
                                        <div v-else-if="!message.isLog"
                                            class=" rounded-full size-8 flex justify-center items-center  bg-muted">
                                            <UserCircle2 />
                                        </div>
                                        <div v-else
                                            class=" rounded-full size-8 flex justify-center items-center  bg-muted">
                                            <Info />
                                        </div>
                                    </div>
                                    <div class="info">
                                        <HoverCard :open="openOnHover.message == message.id ? openOnHover.open : false">
                                            <HoverCardTrigger>

                                            </HoverCardTrigger>
                                            <HoverCardContent class="w-80" :side="'right'">
                                                <div v-if="hoveredUser" class="flex justify-start space-x-4">
                                                    <Avatar>
                                                        <AvatarImage :src="hoveredUser.profilePhoto" />
                                                        <AvatarFallback>
                                                            <UserCircle2 />
                                                        </AvatarFallback>
                                                    </Avatar>
                                                    <div class="space-y-1">
                                                        <h4 class="text-sm font-semibold">
                                                            @{{ hoveredUser.name }}
                                                        </h4>
                                                        <p v-if="hoveredUser.description" class="text-sm">
                                                            {{ hoveredUser.description }}
                                                        </p>
                                                        <p v-else class="text-sm">
                                                            Doesn't have a bio, but we know he/she is great.
                                                        </p>
                                                        <div class="flex items-center pt-2">
                                                            <CalendarIcon class="mr-2 h-4 w-4 opacity-70" />
                                                            <span class="text-xs text-muted-foreground">
                                                                Joined {{ hoveredUser.joinedAt }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else class="flex justify-between space-x-4">
                                                    <div class="space-y-1">
                                                        <h4 class="text-sm font-semibold ">
                                                            No information was found about that user.
                                                        </h4>
                                                    </div>
                                                </div>
                                            </HoverCardContent>
                                        </HoverCard>
                                        <div v-if="!message.isLog">
                                            <h1>{{ message.sender.name }}</h1>
                                            <p class="text-xs mb-2">{{ message.createdAt }}</p>
                                            <Card class="max-w-96 p-4" v-html="message.message"></Card>
                                        </div>
                                        <div v-else>
                                            <p class="text-xs mb-2">{{ message.createdAt }}</p>
                                            <Card class="max-w-96 p-4" v-html="message.message"></Card>
                                        </div>
                                    </div>
                                </div>

                            </div>
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
                    <CreateCheckListComponent />
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
import { CalendarIcon, Check, FileStack, Info, Kanban, Loader2, Send, StickyNote, Text, UserCircle2, X } from 'lucide-vue-next';
import { DialogClose } from 'radix-vue';
import { ref, onMounted, watch, computed, nextTick } from 'vue';
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
import { router, usePage } from '@inertiajs/vue3';
import { Mentionable } from 'vue-mention';
import HoverCard from '../ui/hover-card/HoverCard.vue';
import HoverCardTrigger from '../ui/hover-card/HoverCardTrigger.vue';
import HoverCardContent from '../ui/hover-card/HoverCardContent.vue';
import AvatarImage from '../ui/avatar/AvatarImage.vue';
import AvatarFallback from '../ui/avatar/AvatarFallback.vue';
import Avatar from '../ui/avatar/Avatar.vue';
import axios from 'axios';
import CreateCheckListComponent from './CreateCheckListComponent.vue';
import TaskChecklistsComponent from './TaskChecklistsComponent.vue';
import TaskAttachmentsComponent from './TaskAttachmentsComponent.vue';
import Echo from 'laravel-echo';
const taskDialogStore = useTaskDialogStore();
const emit = defineEmits();
const page = usePage();
const openOnHover = ref({
    open: false,
    message: null,
})
const hoveredUser = ref(null);
const propsData = defineProps({
    isOpen: Boolean,
});
const text = ref('');


// Formatting message to include mentioned users and apply the hover status on the mentioned user.
const formatedMentionMessages = ref();
watch(() => taskDialogStore?.singleTask, (value) => {
    if (value.chat) {
        const updatedMessages = value.chat.messages.map((messageObj) => {
            const regex = /@([a-zA-Z0-9_]+)/g;
            const formattedMessage = messageObj.message.replace(regex, (match, username) => {
                return `<span 
                id="${messageObj.id}"
                data-username="${username}"
                class="mention underline cursor-pointer">
                ${match}
            </span>`
            });

            return { ...messageObj, message: formattedMessage };
        });

        formatedMentionMessages.value = updatedMessages;
    }

}, { deep: true });

// Message Send Request
const messageObject = ref({});
const send = () => {
    axios.post(route('send-message'), {
        chat: taskDialogStore.singleTask.chat.id,
        message: text.value
    }).then((response) => {
        // messageObject.value = {
        //     id: response.data.id,
        //     message: response.data.message,
        //     createdAt: 'now',
        //     sender: {
        //         id: page.props.auth.user.id,
        //         name: page.props.auth.user.name,
        //         profilePhoto: page.props.auth.user.profile_photo_url,
        //     }
        // }
        // taskDialogStore.singleTask.chat.messages.push(messageObject.value);
    }).catch((error) => {

    });
}



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

    // Listen to chat event when the single task is ready to use "the single task has been recived from the backend and loaded in the DOM"
    window.Echo.private(`liveChat.${taskDialogStore.singleTask.chat.id}`).listen('ChatEvent', (eventData) => {
        console.log(eventData);
        messageObject.value = {
            id: eventData.senderData.id,
            message: eventData.senderData.message,
            createdAt: eventData.senderData.postedAt,
            sender: {
                id: eventData.senderData.userID,
                name: eventData.senderData.name,
                profilePhoto: eventData.senderData.profilePhoto,
            }
        }
        taskDialogStore.singleTask.chat.messages.push(messageObject.value);
    });

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

// Hnadling @username hover to display user data
const handleHoveringCardUserDetails = (event) => {
    if (event.target && event.target.classList.contains('mention')) {
        const username = event.target.dataset.username;

        // Showing a small dialog above the hovered name
        openOnHover.value.message = event.target.id;
        openOnHover.value.open = !openOnHover.value.open;

        //  getting the data of the hovered name from pinia store
        hoveredUser.value = taskDialogStore.singleTask.members.find((user) => user.name == username);
        console.log(hoveredUser);

    } else {
        openOnHover.value.message = null;
        openOnHover.value.open = false;
    }
};



onMounted(() => {
    // nextTick => after we modified the data that needs to be displayed and before the html or DOM beign loaded the code below will be excuted.
    nextTick(() => {
        document.addEventListener('mouseover', handleHoveringCardUserDetails);
    })
    document.addEventListener('keydown', closeOnEscape);
    JSON.parse(JSON.stringify(taskDialogStore.singleTask))
});

</script>
