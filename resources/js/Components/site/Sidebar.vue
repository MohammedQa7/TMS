<template>
    <aside class="inset-y fixed  left-0 z-20 flex h-full flex-col border-r transition-all bg-background"
        :class="{ 'w-52   transition-all': isCollabsed }">
        <div class="border-b p-2">
            <Link :href="route('dashboard')">
            <Button variant="outline" size="icon" aria-label="Home">
                <Triangle class="size-5 fill-foreground" />
            </Button>
            </Link>

        </div>
        <nav class="grid gap-1 p-2">
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Link :href="route('projects.index')">
                        <Button variant="ghost" size="icon" class="rounded-lg" aria-label="Playground"
                            :class="{ 'bg-muted': page.component == 'Projects' }">
                            <Workflow class="size-5" />
                        </Button>
                        </Link>
                    </TooltipTrigger>
                    <TooltipContent side="right" :side-offset="5">
                        Workspace
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button variant="ghost" size="icon" class="rounded-lg" aria-label="Models">
                            <Bot class="size-5" />
                        </Button>
                    </TooltipTrigger>
                    <TooltipContent side="right" :side-offset="5">
                        Models
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button variant="ghost" size="icon" class="rounded-lg" aria-label="API">
                            <Code2 class="size-5" />
                        </Button>
                    </TooltipTrigger>
                    <TooltipContent side="right" :side-offset="5">
                        API
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button variant="ghost" size="icon" class="rounded-lg" aria-label="Documentation">
                            <Book class="size-5" />
                        </Button>
                    </TooltipTrigger>
                    <TooltipContent side="right" :side-offset="5">
                        Documentation
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button variant="ghost" size="icon" class="rounded-lg" aria-label="Settings">
                            <Settings2 class="size-5" />
                        </Button>
                    </TooltipTrigger>
                    <TooltipContent side="right" :side-offset="5">
                        Settings
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        </nav>
        <nav class="mt-auto grid gap-1 p-2">
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button variant="ghost" size="icon" class="mt-auto rounded-lg" aria-label="Help">
                            <LifeBuoy class="size-5" />
                        </Button>
                    </TooltipTrigger>
                    <TooltipContent side="right" :side-offset="5">
                        Help
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Button variant="ghost" size="icon" class="mt-auto rounded-lg" aria-label="Account">
                            <SquareUser class="size-5" />
                        </Button>
                    </TooltipTrigger>
                    <TooltipContent side="right" :side-offset="5">
                        Account
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        </nav>
    </aside>
</template>

<script setup lang="ts">
import { Button } from '@/Components/ui/button'
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/Components/ui/tooltip'
import { Book, Bot, Code2, FolderArchive, LifeBuoy, Projector, Settings2, SquareTerminal, SquareUser, Triangle, Workflow } from 'lucide-vue-next'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const isCollabsed = ref(false);
const ToggleNav = () => {
    isCollabsed.value = !isCollabsed.value;
}

</script>
