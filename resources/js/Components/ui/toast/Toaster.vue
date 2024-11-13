<script setup>
import { isVNode } from 'vue';
import {
  Toast,
  ToastClose,
  ToastDescription,
  ToastProvider,
  ToastTitle,
  ToastViewport,
} from '.';
import { useToast } from './use-toast';
import { Check, CheckCircle2, Info, XCircle } from 'lucide-vue-next';

const propsData = defineProps({
  type: String
})
const { toasts } = useToast();
</script>

<template>
  <ToastProvider>
    <Toast v-for="toast in toasts" :key="toast.id" v-bind="toast">

      <div class="flex  items-center gap-3">
        <CheckCircle2 v-if="type == 'success'" class=" text-green-400" />
        <XCircle v-else-if="type == 'danger'" class=" text-red-400" />
        <Info v-else-if="type == 'info'" class=" text-blue-400" />
        <Info v-else />
        <div>
          <ToastTitle v-if="toast.title">
            {{ toast.title }}
          </ToastTitle>
          <template v-if="toast.description">
            <ToastDescription v-if="isVNode(toast.description)">
              <component :is="toast.description" />
            </ToastDescription>
            <ToastDescription v-else>
              {{ toast.description }}
            </ToastDescription>
          </template>
        </div>
        <ToastClose />
      </div>
      <component :is="toast.action" />
    </Toast>
    <ToastViewport />
  </ToastProvider>
</template>
