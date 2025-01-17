<script setup lang="ts">
import type { DateRange } from 'radix-vue'
import { Button } from '@/components/ui/button'

import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { RangeCalendar } from '@/components/ui/range-calendar'
import { cn } from '@/utils'
import {
  DateFormatter,
  getLocalTimeZone,
} from '@internationalized/date'
import { Calendar as CalendarIcon } from 'lucide-vue-next'
import { type Ref, ref, watch } from 'vue'

const emit = defineEmits();
const df = new DateFormatter('en-US', {
  dateStyle: 'medium',
})

const value = ref({
  start: null,
  end: null,
}) as Ref<DateRange>

watch((value), () => {
  if (value.value.start && value.value.end) {
    const dates = {
      startDate: value.value.start.day + '/' + value.value.start.month + '/' + value.value.start.year,
      endDate: value.value.end.day + '/' + value.value.end.month + '/' + value.value.end.year,
    }
    emit('bindDate', dates);
  }

}, { deep: true })
</script>

<template>
  <Popover>
    <PopoverTrigger as-child>
      <Button variant="outline" :class="cn(
        'flex flex-wrap justify-start text-left h-auto',
        !value && 'text-muted-foreground',
      )">
        <CalendarIcon class="mr-2 h-4 w-4" />
        <template v-if="value.start">
          <template v-if="value.end">
            {{ df.format(value.start.toDate(getLocalTimeZone())) }} - {{
              df.format(value.end.toDate(getLocalTimeZone())) }}
          </template>

          <template v-else>
            {{ df.format(value.start.toDate(getLocalTimeZone())) }}
          </template>
        </template>
        <template v-else>
          Pick a date
        </template>
      </Button>
    </PopoverTrigger>
    <PopoverContent class="w-auto p-0">
      <RangeCalendar v-model="value" initial-focus :number-of-months="2"
        @update:start-value="(startDate) => value.start = startDate" />
    </PopoverContent>
  </Popover>
</template>