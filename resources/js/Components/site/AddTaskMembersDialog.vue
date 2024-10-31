<template>
    <Dialog>
        <DialogTrigger>
            <Button variant="outline" class="size-8 rounded-full">
                <UserPlus />
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
import { Share, UserPlus } from 'lucide-vue-next';

const propsData = defineProps({
    btnText: null
});
</script>