<template>
    <Toaster :type="'success'" />
    <Dialog>
        <DialogTrigger>
            <Button @click.prevent="getUsers" variant="outline" class="rounded-full">
                <UserPlus />
                {{ text }}
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Create Workspace</DialogTitle>
            </DialogHeader>
            <!-- Main Content -->
            <div v-if="isLoading" class="loading-indicator flex justify-center items-center">
                <Loader2 class="size-9 animate-spin text-center" />
            </div>
            <form v-else @submit.prevent="addProject" class="space-y-5">
                <div class="creation-fields space-y-5">
                    <div class="grid gap-2">
                        <Label for="subject">Name</Label>
                        <Input v-model="form.name" id="subject" placeholder="I need help with..." />
                    </div>
                    <div class="grid gap-2">
                        <Label for="description">Description</Label>
                        <Textarea v-model="form.description" id="description"
                            placeholder="Please include all information relevant to your issue." />
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="grid col-span-2 gap-2">
                            <Label for="area">Due date</Label>
                            <RangeDatePicker @bindDate="bindSelectedDates" />
                        </div>
                        <div class="grid col-span-1 gap-2">
                            <Label for="security-level">Estimated budget</Label>
                            <Drawer>
                                <DrawerTrigger>
                                    <Button type="button" variant="outline" :class="cn(
                                        'flex  justify-start text-left h-auto',
                                        !form.budget && 'text-muted-foreground',
                                    )">
                                        <DollarSign class="mr-2 h-4 w-4" />
                                        <template v-if="form.budget > 0">
                                            {{ form.budget }}
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
                                            <DrawerDescription>Set your estimated workspace budget
                                            </DrawerDescription>
                                        </DrawerHeader>
                                        <div class="p-4 pb-0">
                                            <div class="flex items-center justify-center space-x-2">
                                                <Button variant="outline" size="icon"
                                                    class="h-8 w-8 shrink-0 rounded-full" :disabled="form.budget <= 0"
                                                    @click="form.budget -= 10">
                                                    <MinusIcon class="h-4 w-4" />
                                                    <span class="sr-only">Decrease</span>
                                                </Button>
                                                <div class="flex-1 text-center">
                                                    <div class="text-7xl font-bold ">
                                                        <Input v-model="form.budget"
                                                            class=" outline-none border-none text-7xl font-bold   text-center h-auto" />
                                                    </div>
                                                </div>

                                                <Button variant="outline" size="icon"
                                                    class="h-8 w-8 shrink-0 rounded-full" @click="form.budget += 10">
                                                    <PlusIcon class="h-4 w-4" />
                                                    <span class="sr-only">Increase</span>
                                                </Button>
                                            </div>
                                        </div>
                                        <DrawerFooter>
                                            <DrawerClose>
                                                <Button class="w-full">
                                                    Submit
                                                </Button>
                                            </DrawerClose>
                                            <DrawerClose as-child>
                                                <Button @click.prevent="form.budget = null" variant="outline">
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
                        <UserMultiSelect :users="users" @bindSelectedMembers="bindSelectedMembers" />
                        <!-- <Popover v-model:open="open" class="">
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
                                            <CommandItem v-for="user in users" :key="user.name" :value="user.name"
                                                @select="SelectItems(user)" class="flex justify-between
                                            items-center" :class="{ 'bg-muted': selectedMembers.includes(user) }">
                                                <div class="members-details flex items-center gap-2">
                                                    <img class="rounded-full size-8 object-cover"
                                                        src="../../../../public/Assets/images/testimage.png" alt="test">
                                                    <div class="flex flex-col items-start">
                                                        <span>{{ user.name }}</span>
                                                        <span class="text-xs text-muted-foreground">{{ user.email }}
                                                            .
                                                            Junior Laravel
                                                            Developer</span>
                                                    </div>
                                                </div>
                                                <Check v-show="selectedMembers.includes(user)" class="size-4" />
                                            </CommandItem>
                                        </CommandGroup>
                                    </CommandList>
                                </Command>
                            </PopoverContent>
                        </Popover> -->
                    </div>

                </div>

                <DialogFooter>
                    <Button type="submit" :disabled="form.processing"> Save changes </Button>
                </DialogFooter>
            </form>
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
    DialogTrigger,
} from '@/components/ui/dialog'
import Button from '../ui/button/Button.vue';
import { DollarSign, UserPlus, PlusIcon, MinusIcon, Loader2 } from 'lucide-vue-next';
import Label from '../ui/label/Label.vue';
import Textarea from '../ui/textarea/Textarea.vue';
import Input from '../ui/input/Input.vue';
import Drawer from '../ui/drawer/Drawer.vue';
import { DrawerClose, DrawerTrigger } from 'vaul-vue';
import { cn } from '@/utils'
import DrawerContent from '../ui/drawer/DrawerContent.vue';
import DrawerHeader from '../ui/drawer/DrawerHeader.vue';
import DrawerDescription from '../ui/drawer/DrawerDescription.vue';
import DrawerTitle from '../ui/drawer/DrawerTitle.vue';
import DrawerFooter from '../ui/drawer/DrawerFooter.vue';
import { Toaster } from '../ui/toast';
import { useToast } from '../ui/toast';
import { computed, ref, watch } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import RangeDatePicker from './RangeDatePicker.vue';
import axios from 'axios';
import UserMultiSelect from './UserMultiSelect.vue';
const { toast } = useToast();
const isLoading = ref(false);
const budget = ref(0);
const open = ref(false);
const users = ref([null]);
const propsData = defineProps({
    text: null,
});
const form = useForm({
    name: '',
    description: '',
    budget: 0,
    startDate: null,
    endDate: null,
    assignedMembers: [null],
})

const bindSelectedDates = (date) => {
    if (date && date.startDate) {
        form.startDate = date.startDate;
        form.endDate = date.endDate;
    }
}

const bindSelectedMembers = (members) => {
    form.assignedMembers = members;

}


const addProject = () => {
    form.post(route('projects.store'), {
        onSuccess: () => {
            form.reset();
            toast({
                title: 'Project created successfuly',
            });
        },
    })
}


async function getUsers() {
    isLoading.value = !isLoading.value
    await axios.get(route('getUsers')).then((respones) => {
        isLoading.value = !isLoading.value
        users.value = respones.data.members
    }).catch((error) => {

    })
}




watch((budget), (value) => {
    if (value <= 0) {
        budget.value = 0;
    }
})

const selectedMembers = ref([]);
const SelectItems = (selectedMembersFromUser) => {
    if (!selectedMembers.value.includes(selectedMembersFromUser)) {
        selectedMembers.value.push(selectedMembersFromUser);
    } else {
        const clickedIndex = selectedMembers.value.findIndex(item => item === selectedMembersFromUser);
        selectedMembers.value.splice(clickedIndex, 1);
    }
}

const isSelectedAboveTwo = computed(() => {
    return selectedMembers.value.length >= 4;
})

</script>