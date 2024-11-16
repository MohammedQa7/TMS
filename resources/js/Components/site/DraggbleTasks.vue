<template>

    <Card v-for="(groupTask, index) in projectCloned.groupTasks" :key="index" class="min-w-96 h-full">
        <!-- Group Task Content -->
        <CardContent class="grid grid-cols-12 gap-4 pt-4 pb-0">
            <div class="project-information flex flex-row items-center gap-10 col-span-8">
                <div v-if="isGroupTaskToggled && toggledGroupTaskData.id == groupTask.id"
                    class="flex items-center gap-3 project-name space-y-1">
                    <Input v-model="toggledGroupTaskData.title"
                        v-if="isGroupTaskToggled && toggledGroupTaskData.id == groupTask.id" class="w-full" />

                </div>

                <div v-else class="flex items-center gap-3 project-name space-y-1">
                    <h1 @click.prevent="toggleGroupTaskEdit(groupTask.id, groupTask.title)"
                        class="text-xl font-bold whitespace-normal break-words"
                        :class="{ 'hidden': isGroupTaskToggled && toggledGroupTaskData.id == groupTask.id }">
                        {{ groupTask.title }}
                    </h1>


                    <p> 4</p>
                </div>
            </div>

            <!-- Control button for editing the title of group task -->
            <div v-if="toggledGroupTaskData.id == groupTask.id" class="col-span-4 flex justify-end  items-center gap-3">
                <div class="add-user ">

                    <TooltipComponent :tooltipText="'Save'">
                        <Button @click.prevent="editGroupTaskTitle(groupTask.id)" class="size-8 bg-muted-foreground">
                            <Check />
                        </Button>
                    </TooltipComponent>
                </div>

                <div class="add-user ">
                    <TooltipComponent :tooltipText="'Cancle'">
                        <Button @click.prevent="toggledGroupTaskData.id = null" class="size-8 bg-muted-foreground">
                            <X />
                        </Button>
                    </TooltipComponent>

                </div>
            </div>


            <!-- Control settings for single group task -->
            <div v-if="toggledGroupTaskData.id != groupTask.id" class="col-span-4 flex justify-end  items-center gap-3">
                <div class="add-user ">
                    <Button @click.prevent="toggleCreateTaskDialog(true, projectCloned.slug, groupTask.id)"
                        class="size-8 bg-muted-foreground">
                        <Plus />
                    </Button>
                </div>

                <div class="add-user ">
                    <CardSetting />
                </div>
            </div>
        </CardContent>
        <!-- Task Content -->
        <CardContent class="p-0  ">
            <div class="tasks p-4 h-full">
                <draggableComponent :id="groupTask.id" v-model="groupTask.tasks" :key="groupTask.tasks.id"
                    v-bind="dragOptions" class="list-group pb-40 h-full" @start="drag = true" @change="changeTaskOrder"
                    @add="addTaskOrder" @remove="removeTaskOrder" @end="endTaskOrder">
                    <template #item="{ element }" :key="element.id">
                        <Card class="bg-muted max-w-96 mb-4 overflow-hidden" :key="element.id">
                            <CompletedBannerComponent v-if="element.isCompleted" :text="'Completed'" />
                            <CardContent class="p-4">
                                <div class="grid grid-cols-12 mb-2 gap-4 ">
                                    <div class="task-basic-info flex items-center gap-2 col-span-9">
                                        <Badge class=" bg-muted-foreground  rounded px-1">
                                            <CalendarClock class="w-4 h-4 me-1" />
                                            <p>
                                                Sep 15
                                            </p>
                                        </Badge>
                                        <Badge variant="outline" class=" rounded px-1"
                                            :class="priorityStyle(element.priority, true)">
                                            <p :class="priorityStyle(element.priority)">
                                                {{ element.priority }}</p>
                                        </Badge>
                                    </div>
                                    <div class="add-user   flex justify-end  items-start col-span-3 ">
                                        <CardSetting />
                                    </div>
                                </div>

                                <div class="project-information  col-span-9 ">
                                    <div @click.prevent="toggleTaskDialog(true, element.id)"
                                        class="project-name space-y-1 mb-2 whitespace-normal break-words cursor-pointer">
                                        <h1 class="text-xl font-bold ">
                                            {{ element.title }}
                                        </h1>

                                        <p class="text-sm text-muted-foreground" v-html="element.description">
                                        </p>
                                    </div>
                                    <div
                                        class="project-details flex justify-between items-center mt-4 whitespace-normal break-words">
                                        <div class="project-members flex justify-center items-center ">
                                            <div class="flex items-center -space-x-2  me">
                                                <a v-for="(taskMembers, index) in element.members" :key="index" href="">
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
                                                <div v-if="element.membersCount > 0"
                                                    class="rounded-full size-8 flex justify-center items-center bg-background">
                                                    <p class="text-sm text-primary">{{
                                                        element.membersCount
                                                    }}
                                                    </p>
                                                    <Plus class="size-3 text-primary" />
                                                </div>
                                            </div>
                                            <div class="assign-task-user">
                                                <Button
                                                    @click.prevent="toggleTaskInviteDialog(true, projectCloned.slug, element.id)"
                                                    variant="outline" class="size-8 rounded-full">
                                                    <UserPlus />
                                                </Button>
                                            </div>
                                        </div>

                                        <div class="task-comments">
                                            <Badge variant="secondary">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <MessageSquare class="size-4" />
                                                    <p><span>2</span> comments</p>
                                                </div>
                                            </Badge>
                                        </div>

                                        <div class="task-attachments">
                                            <Badge variant="secondary">
                                                <div class="flex justify-center items-center space-x-2">
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

    <TaskDetailsDialog v-if="taskDialog" :isOpen="taskDialog" @Close="toggleTaskDialog" />
    <TaskInvitation v-if="taskInviteDialog" :isOpen="taskInviteDialog" @Close="toggleTaskInviteDialog" />
    <CreateTaskDialog v-if="createTaskDialog" :isOpen="createTaskDialog" @Close="toggleCreateTaskDialog" />
</template>


<script setup>
import CardSetting from '@/Components/site/CardSetting.vue';
import Badge from '@/Components/ui/badge/Badge.vue';
import Card from '@/Components/ui/card/Card.vue';
import CardContent from '@/Components/ui/card/CardContent.vue';
import { BetweenHorizonalEnd, CalendarClock, Check, ChevronLeft, Folders, Grid, LayoutGrid, List, MessageSquare, Plus, Table, TableProperties, UserCircle2, UserPlus, X } from 'lucide-vue-next';
import draggableComponent from 'vuedraggable';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import TooltipComponent from '@/Components/TooltipComponent.vue';
import CompletedBannerComponent from '@/Components/site/CompletedBannerComponent.vue';
import TaskDetailsDialog from './TaskDetailsDialog.vue';
import TaskInvitation from './TaskInvitation.vue';
import CreateTaskDialog from './CreateTaskDialog.vue';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import { ref, computed, watch } from 'vue';
import { isNull } from 'lodash';
import { appendPriorityClass } from '@/Composable/taskPriorities';
const taskDialogStore = useTaskDialogStore();
const propsData = defineProps({
    projectCloned: Object
})

const toggledGroupTaskData = ref({
    id: null,
    title: ''
});

const toggleGroupTaskEdit = (id, title) => {
    toggledGroupTaskData.value.id = id
    toggledGroupTaskData.value.title = title
}

const isGroupTaskToggled = computed(() => {
    return !isNull(toggledGroupTaskData.value.id);
})


// ------



// Drag options
const drag = ref(false);
const dragOptions = computed(() => {
    return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
    };
})

// to track the final state of the items that have been traged. and the ability to control from where to what div they have changed to
const endTaskOrder = (event) => {
    if (event.from.id == event.to.id && event.newIndex != event.oldIndex) {
        const groupTask = propsData.projectCloned?.groupTasks.find((group) => {
            return group.id == event.from.id;
        });

        if (groupTask && groupTask.tasks) {
            const taskArray = [];
            groupTask.tasks.map((value, index) => {
                const object = {
                    taskID: value.id,
                    newIndex: index + 1,
                };
                taskArray.push(object);
            });

            axios.put(route('groupTask.update', {
                group: groupTask.id,
                newOrder: taskArray,
            }))

        }
    } else if (event.from.id != event.to.id) {
        const groupTask = propsData.projectCloned?.groupTasks.find((group) => {
            return group.id == event.to.id;
        });
        if (groupTask && groupTask.tasks) {
            const taskArray = [];
            groupTask.tasks.map((value, index) => {
                const object = {
                    taskID: value.id,
                    newIndex: index + 1,
                };
                taskArray.push(object);
            });

            axios.put(route('groupTask.update', {
                group: groupTask.id,
                newGroup: groupTask.id,
                newOrder: taskArray,
            }));
        }
    }
}


const taskDialog = ref(false);
const taskInviteDialog = ref(false);
const createTaskDialog = ref(false);

// Task Details Dialog
const toggleTaskDialog = (eventData = null, taskID) => {
    if (eventData) {
        taskDialog.value = eventData;
        taskDialogStore.getSingleTask(taskID);
    } else {
        taskDialog.value = !taskDialog.value;
    }
}

// Task Invitaion Dialog
const toggleTaskInviteDialog = (eventData = null, projectSlug, taskID) => {
    if (eventData) {
        taskInviteDialog.value = eventData;
        taskDialogStore.getUsersAndPrioritiesIProject(projectSlug, null, taskID);
    } else {
        taskInviteDialog.value = !taskInviteDialog.value;
    }
}

// Creating Task Dialog
const toggleCreateTaskDialog = (eventData = null, projectSlug, groupTaskID) => {
    if (eventData) {
        createTaskDialog.value = eventData;
        taskDialogStore.getUsersAndPrioritiesIProject(projectSlug, groupTaskID, null, true);
    } else {
        createTaskDialog.value = !createTaskDialog.value;
    }
}

const editGroupTaskTitle = (groupTaskID) => {
    axios.put(route('groupTask.update', {
        group: groupTaskID,
        data: toggledGroupTaskData.value
    })).then((response) => {

        const groupTask = propsData.projectCloned?.groupTasks.find((group) => {
            return group.id == response.data.data.id
        });
        if (groupTask) {
            groupTask.title = response.data.data.title;
            toggledGroupTaskData.value.id = null;
        }

    })
}


function priorityStyle(priority, isBadge) {
    return appendPriorityClass(priority, isBadge);
}
</script>