<script setup lang="ts">
import type { DateRange } from 'radix-vue'
import { Button } from '@/components/ui/button'

import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { cn } from '@/utils'
import {
    DateFormatter,
    getLocalTimeZone,
} from '@internationalized/date'
import { CalendarIcon } from 'lucide-vue-next'
import { type Ref, ref, watch } from 'vue'
import Calendar from '../ui/calendar/Calendar.vue'

const emit = defineEmits();
const df = new DateFormatter('en-US', {
    dateStyle: 'medium',
})

const value = ref(null);

watch((value), () => {
    if (value.value) {
        const date = {
            Date: value.value.day + '/' + value.value.month + '/' + value.value.year,
        }
        emit('bindDate', date);
    }

}, { deep: true })

</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <Button variant="outline" :class="cn(
                'flex flex-wrap justify-start text-left h-auto w-full',
                !value && 'text-muted-foreground',
            )">
                <CalendarIcon class="mr-2 h-4 w-4" />
                <template v-if="value">
                    {{ df.format(value.toDate(getLocalTimeZone())) }}
                </template>
                <template v-else>
                    Pick a date
                </template>
            </Button>
        </PopoverTrigger>
        <PopoverContent class="w-auto p-0">
            <Calendar v-model="value" />
            <!-- <RangeCalendar v-model="value" initial-focus :number-of-months="2"
                @update:start-value="(startDate) => value.start = startDate" /> -->
        </PopoverContent>
    </Popover>
</template>