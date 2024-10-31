<template>
        <Card>
            <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                <CardTitle class="text-sm font-medium">
                    Total Revenue
                </CardTitle>
                <DollarSign class="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">
                    $45,231.89
                </div>
                <p class="text-xs text-muted-foreground">
                    +20.1% from last month
                </p>
            </CardContent>
        </Card>
        <Card>
            <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                <CardTitle class="text-sm font-medium">
                    Subscriptions
                </CardTitle>
                <Users class="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">
                    +2350
                </div>
                <p class="text-xs text-muted-foreground">
                    +180.1% from last month
                </p>
            </CardContent>
        </Card>
        <Card>
            <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                <CardTitle class="text-sm font-medium">
                    Sales
                </CardTitle>
                <CreditCard class="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">
                    +12,234
                </div>
                <p class="text-xs text-muted-foreground">
                    +19% from last month
                </p>
            </CardContent>
        </Card>
        <Card>
            <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                <CardTitle class="text-sm font-medium">
                    Active Now
                </CardTitle>
                <Activity class="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">
                    +573
                </div>
                <p class="text-xs text-muted-foreground">
                    +201 since last hour
                </p>
            </CardContent>
        </Card>

</template>

<script setup>
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Activity, CreditCard, DollarSign, Users } from 'lucide-vue-next'

</script>