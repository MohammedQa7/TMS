<template>
    <div class="flex min-h-screen w-full flex-col p-4 space-y-5">
        <div class="header flex justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-bold">
                    Projects
                </h1>
                <h1 class="font-bold">
                    <Badge>
                        <p class="font-bold">7</p>
                    </Badge>
                </h1>
            </div>
            <div class="create-new-workspace">
                <CreateWorkspaceDialog :text="'New Workspace'" />
            </div>
        </div>

        <div class="projects-cards w-full grid grid-cols-12 gap-6">
            <Card v-for="(singleProject, index) in projects.data" :key="index"
                class=" col-span-12 md:col-span-6 lg:col-span-4 ">
                <CardContent class="p-4">
                    <div class="grid grid-cols-12 mb-2 gap-4 ">
                        <div class="task-basic-info flex items-center gap-2 col-span-9">
                            <Badge class=" bg-muted-foreground  rounded px-1">
                                <CalendarClock class="w-4 h-4 me-1" />
                                <p>{{ fomratDate(singleProject.startDate, true) }}</p>
                            </Badge>
                            <p>-</p>
                            <Badge class=" bg-muted-foreground  rounded px-1">
                                <CalendarClock class="w-4 h-4 me-1" />
                                <p>{{ fomratDate(singleProject.endDate, true) }}</p>
                            </Badge>
                        </div>
                        <div class="add-user flex justify-end  items-start col-span-3 ">
                            <CardSetting />
                        </div>
                    </div>

                    <div class="project-information">
                        <div class="project-name mb-2 whitespace-normal break-words ">
                            <Link :href="route('projects.show', singleProject.slug)" class="space-y-1">
                            <h1 class="text-xl font-bold flex justify-between items-center gap-3">
                                {{ singleProject.name }}
                                <HoverCard :open-delay="100">
                                    <HoverCardTrigger>
                                        <Badge class="text-[12px] md:text-[10px] lg:text-xs text-center  leading-4">
                                            View progress
                                        </Badge>
                                    </HoverCardTrigger>
                                    <HoverCardContent class="p-6">
                                        <div class="flex items-center justify-center  overflow-hidden  rounded-full">
                                            <svg class="w-32 h-32 transform translate-x-1 translate-y-1" x-cloak
                                                aria-hidden="true">
                                                <circle class="text-muted" stroke-width="10" stroke="currentColor"
                                                    fill="transparent" r="50" cx="60" cy="60" />
                                                <circle class="text-primary" stroke-width="10"
                                                    :stroke-dasharray="circumference"
                                                    :stroke-dashoffset="circumference - singleProject.completePercentage / 100 * circumference"
                                                    stroke-linecap="round" stroke="currentColor" fill="transparent"
                                                    r="50" cx="60" cy="60" />
                                            </svg>
                                            <span
                                                class="absolute text-2xl text-primary flex justify-center items-center">{{
                                                    singleProject.completePercentage }}
                                                <Percent class="size-6" />
                                            </span>
                                        </div>
                                        <div class="progress-legend flex justify-center items-center">
                                            <Dot class="size-6" />
                                            <p class="text-xs">progress percentage
                                            </p>
                                        </div>
                                    </HoverCardContent>
                                </HoverCard>
                            </h1>

                            <p class="text-sm text-muted-foreground">
                                {{ singleProject.description }}
                            </p>
                            </Link>
                        </div>
                        <div class="project-details  flex-wrap mt-4 whitespace-normal break-words ">
                            <div class="task-comments">
                                <Badge variant="secondary">
                                    <div class="flex justify-center items-center space-x-1">
                                        <DollarSign class="size-5" />
                                        <p><span>{{ singleProject.budget }}</span></p>
                                    </div>
                                </Badge>
                            </div>
                            <div class="task-comments">
                                <Badge variant="secondary">
                                    <div class="flex justify-center items-center space-x-1">
                                        <Users class="size-5" />
                                        <p><span>{{ singleProject.members ?? 0 }}</span> Members</p>
                                    </div>
                                </Badge>
                            </div>

                            <div class="task-attachments">
                                <Badge variant="secondary">
                                    <div class="flex justify-center items-center space-x-1 ">
                                        <ListTodo class="size-5" />
                                        <p class="text-xs"><span>{{ singleProject.tasks ?? 0 }}</span> Tasks</p>
                                    </div>
                                </Badge>
                            </div>

                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>

    </div>

</template>


<script setup>
import DataTable from '@/Components/DataTable.vue';
import CardSetting from '@/Components/site/CardSetting.vue';
import CreateWorkspaceDialog from '@/Components/site/CreateWorkspaceDialog.vue';
import Badge from '@/Components/ui/badge/Badge.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/Components/ui/card/Card.vue';
import CardContent from '@/Components/ui/card/CardContent.vue';
import HoverCard from '@/Components/ui/hover-card/HoverCard.vue';
import HoverCardContent from '@/Components/ui/hover-card/HoverCardContent.vue';
import HoverCardTrigger from '@/Components/ui/hover-card/HoverCardTrigger.vue';
import { fomratDate } from '@/Composable/formatDate';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
import { CalendarClock, DollarSign, Dot, ListTodo, Percent, Users } from 'lucide-vue-next';
import { ref } from 'vue';
const circumference = ref(50 * 2 * Math.PI);

const propsData = defineProps({
    projects: Array,
})
defineOptions({
    layout: MainLayout,
})
</script>