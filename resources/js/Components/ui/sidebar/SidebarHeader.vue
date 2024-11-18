<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/utils'

const props = defineProps<{
  class?: HTMLAttributes['class']
}>()

import { useSidebar } from './utils'
const {  state } = useSidebar()
</script>

<template>
  <div data-sidebar="header" class="flex flex-col gap-2" :class=" state == 'collapsed' ? 'p-0' : 'p-2'">
    <slot />
  </div>
</template>
