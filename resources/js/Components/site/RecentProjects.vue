<template>
    <Card>
        <CardHeader>
            <CardTitle>Recent Sales</CardTitle>
        </CardHeader>
        <CardContent class="grid gap-8">
            <div class="flex items-center gap-4">
                <Avatar class="hidden h-9 w-9 sm:flex">
                    <AvatarImage src="/avatars/01.png" alt="Avatar" />
                    <AvatarFallback>OM</AvatarFallback>
                </Avatar>
                <div class="grid gap-1">
                    <p class="text-sm font-medium leading-none">
                        Olivia Martin
                    </p>
                    <p class="text-sm text-muted-foreground">
                        olivia.martin@email.com
                    </p>
                </div>
                <div class="ml-auto font-medium">
                    +$1,999.00
                </div>
            </div>
            <div class="flex items-center gap-4">
                <Avatar class="hidden h-9 w-9 sm:flex">
                    <AvatarImage src="/avatars/02.png" alt="Avatar" />
                    <AvatarFallback>JL</AvatarFallback>
                </Avatar>
                <div class="grid gap-1">
                    <p class="text-sm font-medium leading-none">
                        Jackson Lee
                    </p>
                    <p class="text-sm text-muted-foreground">
                        jackson.lee@email.com
                    </p>
                </div>
                <div class="ml-auto font-medium">
                    +$39.00
                </div>
            </div>
            <div class="flex items-center gap-4">
                <Avatar class="hidden h-9 w-9 sm:flex">
                    <AvatarImage src="/avatars/03.png" alt="Avatar" />
                    <AvatarFallback>IN</AvatarFallback>
                </Avatar>
                <div class="grid gap-1">
                    <p class="text-sm font-medium leading-none">
                        Isabella Nguyen
                    </p>
                    <p class="text-sm text-muted-foreground">
                        isabella.nguyen@email.com
                    </p>
                </div>
                <div class="ml-auto font-medium">
                    +$299.00
                </div>
            </div>
            <div class="flex items-center gap-4">
                <Avatar class="hidden h-9 w-9 sm:flex">
                    <AvatarImage src="/avatars/04.png" alt="Avatar" />
                    <AvatarFallback>WK</AvatarFallback>
                </Avatar>
                <div class="grid gap-1">
                    <p class="text-sm font-medium leading-none">
                        William Kim
                    </p>
                    <p class="text-sm text-muted-foreground">
                        will@email.com
                    </p>
                </div>
                <div class="ml-auto font-medium">
                    +$99.00
                </div>
            </div>
            <div class="flex items-center gap-4">
                <Avatar class="hidden h-9 w-9 sm:flex">
                    <AvatarImage src="/avatars/05.png" alt="Avatar" />
                    <AvatarFallback>SD</AvatarFallback>
                </Avatar>
                <div class="grid gap-1">
                    <p class="text-sm font-medium leading-none">
                        Sofia Davis
                    </p>
                    <p class="text-sm text-muted-foreground">
                        sofia.davis@email.com
                    </p>
                </div>
                <div class="ml-auto font-medium">
                    +$39.00
                </div>
            </div>
        </CardContent>
    </Card>
</template>

<script setup>
import { Avatar, AvatarFallback, AvatarImage } from '@/Components/ui/avatar'
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'

</script>