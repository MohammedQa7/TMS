<template>
    <div class="flex min-h-screen w-full flex-col ">
        <div class="project-info p-4 ">
            <Card>
                <CardContent class="p-4 flex justify-between items-center ">
                    <div class="project-information flex flex-row items-center gap-10 ">
                        <div class="project-name space-y-1">
                            <Link variant="link" class="p-0">
                            <a href="" class="text-xs   flex items-center gap-2 transition-all hover:underline">
                                <ChevronLeft class="w-4 h-4" />
                                BACK TO PROJECTS
                            </a>
                            </Link>
                            <h1 class="text-2xl font-bold">
                                Syncor
                            </h1>
                        </div>

                        <div class="project-name space-y-1">
                            <p class="text-xs text-muted-foreground">
                                ESTIMATED FINISH DATE
                            </p>
                            <h1 class="text-2xl font-bold">
                                Mar/21/2024
                            </h1>
                        </div>

                        <div class="project-name space-y-1">
                            <p class="text-xs text-muted-foreground">
                                PEOPLE ON PROJECT
                            </p>
                            <div class="flex -space-x-2 mt-2">
                                <a href="">
                                    <svg class="size-8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
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
                                            <g fill="none" fill-rule="evenodd" transform="translate(1 1)">
                                                <g transform="translate(3 1)">
                                                    <mask id="info-b" fill="#ffffff">
                                                        <use xlink:href="#info-a"></use>
                                                    </mask>
                                                    <use fill="#D8D8D8" xlink:href="#info-a"></use>
                                                    <g fill="#FFA0A0" mask="url(#info-b)">
                                                        <rect width="24" height="24" transform="translate(-4 -2)">
                                                        </rect>
                                                    </g>
                                                </g>
                                                <mask id="info-d" fill="#ffffff">
                                                    <use xlink:href="#info-c"></use>
                                                </mask>
                                                <use fill="#000000" fill-rule="nonzero" xlink:href="#info-c"></use>
                                                <g fill="#7600FF" mask="url(#info-d)">
                                                    <rect width="24" height="24" transform="translate(-1 -1)">
                                                    </rect>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg class="size-8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
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
                                            <g fill="none" fill-rule="evenodd" transform="translate(1 1)">
                                                <g transform="translate(3 1)">
                                                    <mask id="info-b" fill="#ffffff">
                                                        <use xlink:href="#info-a"></use>
                                                    </mask>
                                                    <use fill="#D8D8D8" xlink:href="#info-a"></use>
                                                    <g fill="#FFA0A0" mask="url(#info-b)">
                                                        <rect width="24" height="24" transform="translate(-4 -2)">
                                                        </rect>
                                                    </g>
                                                </g>
                                                <mask id="info-d" fill="#ffffff">
                                                    <use xlink:href="#info-c"></use>
                                                </mask>
                                                <use fill="#000000" fill-rule="nonzero" xlink:href="#info-c"></use>
                                                <g fill="#7600FF" mask="url(#info-d)">
                                                    <rect width="24" height="24" transform="translate(-1 -1)">
                                                    </rect>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>

                                <div class=" rounded-full size-8 flex justify-center items-center  bg-muted">
                                    <p class="text-xs">+4</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-user">
                        <AddPeopleDialog :btn-text="'Add people'" />
                    </div>
                </CardContent>
            </Card>
            <div class="task-lists-with-status max-w-full h-screen p-4 px-0 overflow-hidden">
                <ScrollArea class="w-full whitespace-nowrap h-screen">
                    <div class="flex space-x-4 w-full">
                        <Card class=" w-96">
                            <CardContent class="grid grid-cols-12 gap-4 pt-4 pb-0">
                                <div class="project-information flex flex-row items-center gap-10  col-span-9">
                                    <div class="flex items-center gap-3 project-name space-y-1">
                                        <h1 class="text-xl font-bold whitespace-normal break-words">
                                            To do
                                        </h1>
                                        <p> 4</p>
                                    </div>
                                </div>

                                <div class="add-user flex justify-end  items-start col-span-3 ">
                                    <CardSetting />
                                </div>
                            </CardContent>
                            <CardContent class="p-0">
                                <div class="tasks p-4">
                                    <draggableComponent v-model="lists2" v-bind="dragOptions" class="list-group mb-40"
                                        @start="drag = true" @end="test22">
                                        <template #item="{ element }">

                                            <Card class="bg-muted max-w-96 h-full mb-4">
                                                <CardContent class="p-4">
                                                    <div class="grid grid-cols-12 mb-2 gap-4 ">
                                                        <div class="task-basic-info flex items-center gap-2 col-span-9">
                                                            <Badge class=" bg-muted-foreground  rounded px-1">
                                                                <CalendarClock class="w-4 h-4 me-1" />
                                                                <p>Sep 05</p>
                                                            </Badge>
                                                            <Badge variant="outline"
                                                                class=" bg-warningBadge rounded px-1">
                                                                <p class=" text-warningBadge-foreground">Low</p>
                                                            </Badge>
                                                        </div>
                                                        <div class="add-user flex justify-end  items-start col-span-3 ">
                                                            <CardSetting />
                                                        </div>
                                                    </div>

                                                    <div class="project-information  col-span-9 ">
                                                        <div @click.prevent="toggleTaskDialog"
                                                            class="project-name space-y-1 mb-2 whitespace-normal break-words cursor-pointer">
                                                            <h1 class="text-xl font-bold ">
                                                                {{ element.name }}
                                                            </h1>

                                                            <p class="text-sm text-muted-foreground">Lorem ipsum
                                                                dolor
                                                                sit amet
                                                                consectetur adipisicing elit. Quia
                                                                voluptatum nesciunt dolor..</p>
                                                        </div>
                                                        <div
                                                            class="project-details flex justify-between items-center mt-4 whitespace-normal break-words">
                                                            <div
                                                                class="project-members flex justify-center items-center ">
                                                                <div class="flex -space-x-2  me">
                                                                    <a href="">
                                                                        <svg class="size-8" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            fill="#000000">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                            </g>
                                                                            <g id="SVGRepo_tracerCarrier"
                                                                                stroke-linecap="round"
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
                                                                                        <mask id="info-b"
                                                                                            fill="#ffffff">
                                                                                            <use xlink:href="#info-a">
                                                                                            </use>
                                                                                        </mask>
                                                                                        <use fill="#D8D8D8"
                                                                                            xlink:href="#info-a">
                                                                                        </use>
                                                                                        <g fill="#FFA0A0"
                                                                                            mask="url(#info-b)">
                                                                                            <rect width="24" height="24"
                                                                                                transform="translate(-4 -2)">
                                                                                            </rect>
                                                                                        </g>
                                                                                    </g>
                                                                                    <mask id="info-d" fill="#ffffff">
                                                                                        <use xlink:href="#info-c">
                                                                                        </use>
                                                                                    </mask>
                                                                                    <use fill="#000000"
                                                                                        fill-rule="nonzero"
                                                                                        xlink:href="#info-c"></use>
                                                                                    <g fill="#7600FF"
                                                                                        mask="url(#info-d)">
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
                                                                            <g id="SVGRepo_tracerCarrier"
                                                                                stroke-linecap="round"
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
                                                                                        <mask id="info-b"
                                                                                            fill="#ffffff">
                                                                                            <use xlink:href="#info-a">
                                                                                            </use>
                                                                                        </mask>
                                                                                        <use fill="#D8D8D8"
                                                                                            xlink:href="#info-a">
                                                                                        </use>
                                                                                        <g fill="#FFA0A0"
                                                                                            mask="url(#info-b)">
                                                                                            <rect width="24" height="24"
                                                                                                transform="translate(-4 -2)">
                                                                                            </rect>
                                                                                        </g>
                                                                                    </g>
                                                                                    <mask id="info-d" fill="#ffffff">
                                                                                        <use xlink:href="#info-c">
                                                                                        </use>
                                                                                    </mask>
                                                                                    <use fill="#000000"
                                                                                        fill-rule="nonzero"
                                                                                        xlink:href="#info-c"></use>
                                                                                    <g fill="#7600FF"
                                                                                        mask="url(#info-d)">
                                                                                        <rect width="24" height="24"
                                                                                            transform="translate(-1 -1)">
                                                                                        </rect>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                                <div class="assign-task-user">
                                                                    <!-- <AddTaskMembersDialog /> -->
                                                                    <Button @click.prevent="toggleTaskInviteDialog"
                                                                        variant="outline" class="size-8 rounded-full">
                                                                        <UserPlus />
                                                                    </Button>
                                                                </div>
                                                            </div>

                                                            <div class="task-comments">
                                                                <Badge variant="secondary">
                                                                    <div
                                                                        class="flex justify-center items-center space-x-2">
                                                                        <MessageSquare class="size-4" />
                                                                        <p><span>2</span> comments</p>
                                                                    </div>
                                                                </Badge>
                                                            </div>

                                                            <div class="task-attachments">
                                                                <Badge variant="secondary">
                                                                    <div
                                                                        class="flex justify-center items-center space-x-2">
                                                                        <Folders class="size-4" />
                                                                        <p><span>2</span> files</p>
                                                                    </div>
                                                                </Badge>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </CardContent>
                                            </Card>
                                        </template>
                                    </draggableComponent>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                    <ScrollBar orientation="horizontal" />
                </ScrollArea>
            </div>
            <TaskDetailsDialog v-if="taskDialog" :isOpen="taskDialog" @Close="toggleTaskDialog" />
            <TaskInvitation v-if="taskInviteDialog" :isOpen="taskInviteDialog" @Close="toggleTaskInviteDialog" />
        </div>

    </div>


</template>

<script setup>
import AddPeopleDialog from '@/Components/site/AddPeopleDialog.vue';
import CardSetting from '@/Components/site/CardSetting.vue';
import Badge from '@/Components/ui/badge/Badge.vue';
import Card from '@/Components/ui/card/Card.vue';
import CardContent from '@/Components/ui/card/CardContent.vue';
import { ScrollArea, ScrollBar } from '@/Components/ui/scroll-area'
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
import { CalendarClock, ChevronLeft, Folders, MessageSquare, UserPlus } from 'lucide-vue-next';
import draggableComponent from 'vuedraggable';
import { ref, computed } from 'vue';
import AddTaskMembersDialog from '@/Components/site/AddTaskMembersDialog.vue';
import TaskDetailsDialog from '@/Components/site/TaskDetailsDialog.vue';
import TaskInvitation from '@/Components/site/TaskInvitation.vue';
import Button from '@/components/ui/button/Button.vue';

const taskDialog = ref(false);
const taskInviteDialog = ref(false);

const lists2 = ref([
    { id: 1, name: 'Laravel' },
    { id: 2, name: 'Node' },
]);

const drag = ref(false);
const dragOptions = computed(() => {
    return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
    };
})



const toggleTaskDialog = (eventData = null) => {
    if (eventData) {
        taskDialog.value = eventData;
    } else {
        taskDialog.value = !taskDialog.value;
    }
}
const toggleTaskInviteDialog = (eventData = null) => {
    if (eventData) {
        taskInviteDialog.value = eventData;
    } else {
        taskInviteDialog.value = !taskInviteDialog.value;
    }
}


defineOptions({
    layout: MainLayout
})
</script>

<style>
.button {
    margin-top: 35px;
}

.flip-list-move {
    transition: transform 0.5s;
}

.no-move {
    transition: transform 0s;
}

.ghost {
    opacity: 0.5;
    background: hsl(217.2 32.6% 17.5%);
    cursor: grabbing;
}

.list-group {
    min-height: 20px;
}
</style>