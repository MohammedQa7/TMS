<template>
    <Drawer>
        <DrawerTrigger as-child>
            <Button variant="ghost" size="icon" class="md:hidden">
                <Settings class="size-4" />
                <span class="sr-only">Settings</span>
            </Button>
        </DrawerTrigger>
        <DrawerContent class="max-h-[90vh]">
            <DrawerHeader>
                <DrawerTitle>Configuration</DrawerTitle>
                <DrawerDescription>
                    Configure the settings for the model and messages.
                </DrawerDescription>
            </DrawerHeader>
            <form class="grid w-full items-start gap-6 overflow-auto p-4 pt-0">
                <fieldset class="grid gap-6 rounded-lg border p-4">
                    <legend class="-ml-1 px-1 text-sm font-medium">
                        Settings
                    </legend>
                    <div class="grid gap-3">
                        <Label for="model">Model</Label>
                        <Select>
                            <SelectTrigger id="model" class="items-start [&_[data-description]]:hidden">
                                <SelectValue placeholder="Select a model" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="genesis">
                                    <div class="flex items-start gap-3 text-muted-foreground">
                                        <Rabbit class="size-5" />
                                        <div class="grid gap-0.5">
                                            <p>
                                                Neural
                                                <span class="font-medium text-foreground">
                                                    Genesis
                                                </span>
                                            </p>
                                            <p class="text-xs" data-description>
                                                Our fastest model for general use cases.
                                            </p>
                                        </div>
                                    </div>
                                </SelectItem>
                                <SelectItem value="explorer">
                                    <div class="flex items-start gap-3 text-muted-foreground">
                                        <Bird class="size-5" />
                                        <div class="grid gap-0.5">
                                            <p>
                                                Neural
                                                <span class="font-medium text-foreground">
                                                    Explorer
                                                </span>
                                            </p>
                                            <p class="text-xs" data-description>
                                                Performance and speed for efficiency.
                                            </p>
                                        </div>
                                    </div>
                                </SelectItem>
                                <SelectItem value="quantum">
                                    <div class="flex items-start gap-3 text-muted-foreground">
                                        <Turtle class="size-5" />
                                        <div class="grid gap-0.5">
                                            <p>
                                                Neural
                                                <span class="font-medium text-foreground">
                                                    Quantum
                                                </span>
                                            </p>
                                            <p class="text-xs" data-description>
                                                The most powerful model for complex
                                                computations.
                                            </p>
                                        </div>
                                    </div>
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="grid gap-3">
                        <Label for="temperature">Temperature</Label>
                        <Input id="temperature" type="number" placeholder="0.4" />
                    </div>
                    <div class="grid gap-3">
                        <Label for="top-p">Top P</Label>
                        <Input id="top-p" type="number" placeholder="0.7" />
                    </div>
                    <div class="grid gap-3">
                        <Label for="top-k">Top K</Label>
                        <Input id="top-k" type="number" placeholder="0.0" />
                    </div>
                </fieldset>
                <fieldset class="grid gap-6 rounded-lg border p-4">
                    <legend class="-ml-1 px-1 text-sm font-medium">
                        Messages
                    </legend>
                    <div class="grid gap-3">
                        <Label for="role">Role</Label>
                        <Select default-value="system">
                            <SelectTrigger>
                                <SelectValue placeholder="Select a role" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="system">
                                    System
                                </SelectItem>
                                <SelectItem value="user">
                                    User
                                </SelectItem>
                                <SelectItem value="assistant">
                                    Assistant
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="grid gap-3">
                        <Label for="content">Content</Label>
                        <Textarea id="content" placeholder="You are a..." />
                    </div>
                </fieldset>
            </form>
        </DrawerContent>
    </Drawer>
</template>


<script setup lang="ts">
import { Badge } from '@/Components/ui/badge'
import { Button } from '@/Components/ui/button'
import { Drawer, DrawerContent, DrawerDescription, DrawerHeader, DrawerTitle, DrawerTrigger } from '@/Components/ui/drawer'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select'
import { Textarea } from '@/Components/ui/textarea'
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/Components/ui/tooltip'
import { Bird, Book, Bot, Code2, CornerDownLeft, LifeBuoy, Link, Mic, Paperclip, Rabbit, Settings, Settings2, Share, SquareTerminal, SquareUser, Triangle, Turtle } from 'lucide-vue-next'
</script>