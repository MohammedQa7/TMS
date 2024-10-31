<template>
    <Dialog :open="isOpen">
        <DialogContent :hideCloseButton="true">
            <div ref="target">
                <DialogHeader ref="target">
                    <DialogTitle>Task Inivitaion</DialogTitle>
                    <DialogDescription>
                        Make changes to your profile here. Click save when you're done.
                    </DialogDescription>
                </DialogHeader>

                <DialogFooter>
                    Save changes
                </DialogFooter>

                <DialogClose @click.prevent="CloseDialog"
                    class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground">
                    <X class="w-4 h-4" />
                    <span class="sr-only">Close</span>
                </DialogClose>
            </div>

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
import { X } from 'lucide-vue-next';
import { DialogClose } from 'radix-vue';
import { ref, onMounted } from 'vue';


const target = ref(null)

// onClickOutside(target, event => CloseDialog());

const emit = defineEmits();
const propsData = defineProps({
    isOpen: Boolean,
})

const CloseDialog = () => {
    closeDialog(emit);
}
const closeOnEscape = (e) => {
    if (e.key === 'Escape') {
        closeDialog(emit);
    }
};
onMounted(() => {
    document.addEventListener('keydown', closeOnEscape)
});

</script>