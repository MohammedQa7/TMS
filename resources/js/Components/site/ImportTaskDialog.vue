<script setup>
import vueFilePond from 'vue-filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';
import FilePondPluginImageEdit from 'filepond-plugin-image-edit/dist/filepond-plugin-image-edit.esm.js';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import 'filepond-plugin-image-edit/dist/filepond-plugin-image-edit.min.css';
import 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.min.css';

import {
    Dialog,
    DialogContent,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import Card from '../ui/card/Card.vue';
import DialogDescription from '../ui/dialog/DialogDescription.vue';
import DialogTrigger from '../ui/dialog/DialogTrigger.vue';
import Button from '../ui/button/Button.vue';
const FilePond = vueFilePond(FilePondPluginImagePreview, FilePondPluginImageEdit);
const filepond = ref();
const myFiles = ref([]);
const emit = defineEmits();

const propsData = defineProps({
    isOpen: Boolean,
})
const attachments = ref(null);


//  filepond init function
function handleFilePondInit() {
    // example of instance method call on pond reference
    filepond.value.getFiles();
};
// Handling multi Image load/store Filepone
function handleMultipleFilePondLoad(response) {
    response = JSON.parse(response);

    attachments.value = response;
    return response;
}

// Handling multi Image Revert Filepone
function handleMultipleFilePondRevert(attachment, load, error) {
    router.put(route('import-CSV'), {
        attachments_path: attachments.value
    });
}


const submit = () => {
    router.post(route('import-CSV'), {
        attachments_path: attachments.value
    });
}




</script>
<template>
    <Dialog>
        <DialogTrigger>
            Edit Profile
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Edit profile</DialogTitle>
                <DialogDescription>
                    Make changes to your profile here. Click save when you're done.
                </DialogDescription>
            </DialogHeader>

            <Card>

                <file-pond class="h-full" name="attachments" ref="filepond" class-name="my-pond" allow-multiple="true"
                    :allow-image-edit="true" label-idle="Drag & Drop Or Click to Upload" v-bind:files="myFiles"
                    v-on:init="handleFilePondInit" :server="{
                        url: '',
                        process: {
                            url: '/attachment/upload',
                            method: 'post',
                            onload: handleMultipleFilePondLoad,
                        },
                        revert: handleMultipleFilePondRevert,
                        headers: {
                            'X-CSRF-TOKEN': $page.props.csrf
                        }
                    }" />
            </Card>

            <DialogFooter>
                <Button @click.prevent="submit">Save changes</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>