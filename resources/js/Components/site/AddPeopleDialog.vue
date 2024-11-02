<template>
    <Dialog>
        <DialogTrigger>
            <Button class="rounded-full">
                <UserPlus class="w-4 h-4" />
                <p v-show="btnText">{{ btnText }}</p>
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Edit profile</DialogTitle>
                <DialogDescription>
                    Make changes to your profile here. Click save when you're done.
                </DialogDescription>
            </DialogHeader>

            <DialogFooter>
                Save changes
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
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
import { UserPlus } from 'lucide-vue-next';

const propsData = defineProps({
    btnText: null
});
</script>