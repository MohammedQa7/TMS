import { defineStore } from 'pinia'
import axios from "axios";
export const useTaskDialogStore = defineStore('taskDialogData', {
    state: () => {
        return {
            taskID: null,
            projectSlug: null,
            groupTaskID: null,
            taskPriorites: null,
            members: null,
            currentMembers: null,
            singleTask: null,
            isLoading: false,
            innerLoading: false,
            can: null,
        }
    },

    actions: {
        getSingleTask(taskID) {
            this.innerLoading = !this.innerLoading;
            if (taskID) {
                axios.get(route('tasks.show', { task: taskID })).then((response) => {
                    this.innerLoading = !this.innerLoading;
                    this.singleTask = response.data.task;
                    this.can = response.data.can;
                }).catch((error) => {

                });
            }
        },
        getUsersAndPrioritiesIProject(projectSlug, groupTaskID = null, taskID = null, withPriority = false) {
            this.innerLoading = !this.innerLoading
            axios.post(route('getProjectUsers', { projectSlug: projectSlug, withPriority: withPriority, taskID: taskID }))
                .then((response) => {
                    this.innerLoading = !this.innerLoading;
                    this.taskPriorites = response.data.priorities;
                    this.members = response.data.members;
                    this.taskID = taskID ?? null
                    this.projectSlug = projectSlug;
                    this.groupTaskID = groupTaskID ?? null;
                })
                .catch((error) => {

                });
        },
        getTaskUsers() {
            this.innerLoading = !this.innerLoading;
            if (this.taskID) {
                axios.get(route('getTaskUsers', {
                    task: this.taskID
                }))
                    .then((response) => {
                        this.innerLoading = !this.innerLoading;
                        this.currentMembers = response.data.currentMembers;
                    })
                    .catch((error) => {

                    });
            }
        },
    }
})

