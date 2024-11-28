<template>
    <Toaster :type="toastType" />
    <AlertDialog :open="isOpen">
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                <AlertDialogDescription>
                    This action cannot be undone. This will permanently delete your account
                    and remove your data from our servers.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel @click.prevent="isOpen = !isOpen" :disabled="isLoading">Cancel</AlertDialogCancel>
                <AlertDialogAction @click.prevent="submit" :disabled="isLoading">
                    <p v-if="!isLoading">Continue</p>
                    <Loader2 v-else class="size-9 animate-spin text-center " />
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>


<script setup>
import AlertDialog from '@/Components/ui/alert-dialog/AlertDialog.vue';
import AlertDialogContent from '@/Components/ui/alert-dialog/AlertDialogContent.vue';
import AlertDialogHeader from '@/Components/ui/alert-dialog/AlertDialogHeader.vue';
import AlertDialogTitle from '@/Components/ui/alert-dialog/AlertDialogTitle.vue';
import AlertDialogDescription from '@/Components/ui/alert-dialog/AlertDialogDescription.vue';
import AlertDialogFooter from '@/Components/ui/alert-dialog/AlertDialogFooter.vue';
import AlertDialogCancel from '@/Components/ui/alert-dialog/AlertDialogCancel.vue';
import AlertDialogAction from '@/Components/ui/alert-dialog/AlertDialogAction.vue';
import { Toaster } from '../ui/toast';
import { useToast } from '../ui/toast';
import { ref } from 'vue';
import eventBus from '@/Composable/eventBus';
import { router } from '@inertiajs/vue3';
import { useTaskDialogStore } from '@/store/TaskDialogStore';
import { Loader2 } from 'lucide-vue-next';
const taskDialogStore = useTaskDialogStore();
const toastType = ref('');
const { toast } = useToast();
const isOpen = ref(false);
const isLoading = ref(false);

// Dialog event data
const eventData = ref({});

eventBus.on('open-delete', (deleteRoute) => {
    eventData.value = deleteRoute;
    isOpen.value = !isOpen.value;
});

const submit = () => {
    isLoading.value = !isLoading.value;
    router.delete(eventData.value.route, {
        onSuccess: () => {
            toastType.value = 'success';
            isOpen.value = !isOpen.value;
            isLoading.value = !isLoading.value;
            toast({
                title: eventData.value.successText ?? 'Changes have  done',
            });
        },
        onError: () => {
            toastType.value = 'danger';
            isLoading.value = !isLoading.value;
            toast({
                title: eventData.value.errorText ?? 'Something went wrong',
            });
        }

    })
}
</script>