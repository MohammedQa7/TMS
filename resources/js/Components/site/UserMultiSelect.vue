<template>
    <Popover v-model:open="open" class="">
        <PopoverTrigger as-child>
            <Button variant="outline" size="sm" class=" w-auto justify-between items-center flex">
                <p>+ Assign members </p>
                <div class="flex  justify-center items-center">
                    <Badge v-for="(selectedItems, index) in selectedMembers" :key="index" variant="ghost"
                        v-if="!isSelectedAboveTwo" class="ms-2">
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
                                    <span class="text-xs text-muted-foreground">{{ user.email }}</span>
                                </div>
                            </div>
                            <Check v-show="selectedMembers.includes(user)" class="size-4" />
                        </CommandItem>
                    </CommandGroup>
                </CommandList>
            </Command>
        </PopoverContent>
    </Popover>
</template>

<script setup>
import Button from '../ui/button/Button.vue';
import { Check } from 'lucide-vue-next';
import Popover from '../ui/popover/Popover.vue';
import PopoverTrigger from '../ui/popover/PopoverTrigger.vue';
import Badge from '../ui/badge/Badge.vue';
import PopoverContent from '../ui/popover/PopoverContent.vue';
import CommandList from '../ui/command/CommandList.vue';
import CommandInput from '../ui/command/CommandInput.vue';
import Command from '../ui/command/Command.vue';
import CommandEmpty from '../ui/command/CommandEmpty.vue';
import CommandGroup from '../ui/command/CommandGroup.vue';
import CommandItem from '../ui/command/CommandItem.vue';
import { ref, computed, watch } from 'vue';
const emit = defineEmits();
const open = ref(false);
const propsData = defineProps({
    users: Array,
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

watch((selectedMembers), (members) => {
    emit('bindSelectedMembers', members)

}, { deep: true })
</script>