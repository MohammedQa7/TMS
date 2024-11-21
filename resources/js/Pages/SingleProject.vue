<template>
    <div class="flex flex-col w-full h-max min-h-screen p-4 space-y-5 overflow-hidden">
        <div v-if="taskDialogStore.isLoading" class="loading-indicator flex justify-center items-center">
            <Loader2 class="size-9 animate-spin text-center" />
        </div>
        <div v-else class="space-y-5">
            <div>
                <Card>
                    <CardContent class="p-4 flex justify-between items-center ">
                        <div class="project-information flex flex-row items-center gap-10 ">
                            <div class="project-name space-y-1">
                                <Link :href="route('projects.index')"
                                    class="text-xs flex items-center gap-2 transition-all hover:underline">
                                <ChevronLeft class="w-4 h-4" />
                                BACK TO PROJECTS
                                </Link>
                                <h1 class="text-2xl font-bold">
                                    {{ projectCloned.name }}
                                </h1>
                            </div>

                            <div class="project-name space-y-1">
                                <p class="text-xs text-muted-foreground">
                                    ESTIMATED FINISH DATE
                                </p>
                                <h1 class="text-2xl font-bold">
                                    {{ fomratDate(projectCloned.endDate) }}
                                </h1>
                            </div>

                            <div class="project-name space-y-1">
                                <p class="text-xs text-muted-foreground">
                                    PEOPLE ON PROJECT
                                </p>
                                <div class="flex -space-x-2 mt-2">
                                    <a v-for="(member, index) in projectCloned.members" :key="index" href="">
                                        <TooltipComponent
                                            :tooltipText="member.id == projectCloned.owner ? member.name + ' ' + '(Owner)' : member.name">
                                            <img v-if="member.profilePhoto" class="size-8 rounded-full object-fill"
                                                :src="member.profilePhoto">
                                            <div
                                                class=" rounded-full size-8 flex justify-center items-center  bg-muted">
                                                <UserCircle2 />
                                            </div>
                                        </TooltipComponent>
                                    </a>
                                    <!-- <div class=" rounded-full size-8 flex justify-center items-center  bg-muted">
                                    <p class="text-xs">+4</p>
                                </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="add-user">
                            <AddPeopleDialog :btn-text="'Add people'" />
                        </div>
                    </CardContent>
                </Card>
            </div>
            <Tabs v-model="currentTab" :default-value="currentTab">
                <TabsList>
                    <TabsTrigger :value="taskViewTypes?.TABLE">
                        <LayoutGrid class="size-5" />
                        Board View
                    </TabsTrigger>
                    <TabsTrigger :value="taskViewTypes?.LIST">
                        <TableProperties class="size-5" />
                        List View
                    </TabsTrigger>
                </TabsList>
                <TabsContent :value="taskViewTypes?.TABLE" class="flex space-x-4 overflow-y-scroll">
                    <DraggbleTasks :projectCloned="projectCloned" />
                </TabsContent>
                <TabsContent :value="taskViewTypes?.LIST">
                    <TaskTableView :tasks="project.data.tasks" :projectSlug="project.data.slug" />
                </TabsContent>
            </Tabs>


        </div>
    </div>


</template>

<script setup>
import AddPeopleDialog from '@/Components/site/AddPeopleDialog.vue';
import Card from '@/Components/ui/card/Card.vue';
import CardContent from '@/Components/ui/card/CardContent.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ChevronLeft, LayoutGrid, Loader2, TableProperties, UserCircle2 } from 'lucide-vue-next';
import { ref, watch } from 'vue';
import { fomratDate } from '@/Composable/formatDate';
import TooltipComponent from '@/Components/TooltipComponent.vue';
import { cloneDeep } from 'lodash';
import Tabs from '@/Components/ui/tabs/Tabs.vue';
import TabsList from '@/Components/ui/tabs/TabsList.vue';
import TabsTrigger from '@/Components/ui/tabs/TabsTrigger.vue';
import TabsContent from '@/Components/ui/tabs/TabsContent.vue';
import TaskTableView from '@/Components/site/TaskTableView.vue';
import DraggbleTasks from '@/Components/site/DraggbleTasks.vue';
import { router } from '@inertiajs/vue3';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
const taskDialogStore = useTaskDialogStore();
const propsData = defineProps({
    project: Object,
    taskViewTypes: Object,
    selectedViewType: String
});

const currentTab = ref(propsData.selectedViewType ?? propsData.taskViewTypes.TABLE);

// This is a clone from projects data so we can fix a Proxy object could not be cloned BUG that causes inertia router to stop working.
const projectCloned = ref(cloneDeep(propsData.project.data));
watch(() => propsData.project.data, (value) => {
    projectCloned.value = cloneDeep(value);
}, { deep: true })


watch(currentTab, (type) => {
    if (type == propsData.taskViewTypes.LIST) {
        taskDialogStore.isLoading = !taskDialogStore.isLoading;
        router.get(route('projects.show', [propsData.project.data.slug, { viewType: type }]), {}, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                taskDialogStore.isLoading = !taskDialogStore.isLoading;
            }
        });

        // axios.get(route('tasks.index', { projectSLUG: propsData.project.data.slug }))
        //     .then((respones) => {
        //         allTasks.value = respones.data.tasks
        //         taskDialogStore.isLoading = !taskDialogStore.isLoading;
        //     })
        //     .catch(() => {
        //     });
    } else {
        taskDialogStore.isLoading = !taskDialogStore.isLoading;
        router.get(route('projects.show', [propsData.project.data.slug]), {}, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                taskDialogStore.isLoading = !taskDialogStore.isLoading;
            },
        });
    }
});


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