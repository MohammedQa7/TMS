<template>
    <main class="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-8">
        <div class="grid gap-4 md:grid-cols-2 md:gap-8 lg:grid-cols-4">
            <StatisticsCards />
        </div>

        <div v-for="(test, index) in data" :key="index">
            <h1>{{ test }}</h1>
        </div>

        <div class="grid gap-4 md:gap-8 lg:grid-cols-2 xl:grid-cols-3">

            <Card class="xl:col-span-2">
                <BarCharts />
            </Card>
            <Card class="xl:col-span-2">
                <LineChart />
            </Card>

            <RecentProjects />

            <Card class="xl:col-span-2">
                <CardHeader class="flex flex-row items-center">
                    <div class="grid gap-2">
                        <CardTitle>Transactions</CardTitle>
                        <CardDescription>
                            Recent transactions from your store.
                        </CardDescription>
                    </div>
                    <Button as-child size="sm" class="ml-auto gap-1">
                        <a href="#">
                            View All
                            <ArrowUpRight class="h-4 w-4" />
                        </a>
                    </Button>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Customer</TableHead>
                                <TableHead class="hidden xl:table-column">
                                    Type
                                </TableHead>
                                <TableHead class="hidden xl:table-column">
                                    Status
                                </TableHead>
                                <TableHead class="hidden xl:table-column">
                                    Date
                                </TableHead>
                                <TableHead class="text-right">
                                    Amount
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow>
                                <TableCell>
                                    <div class="font-medium">
                                        Liam Johnson
                                    </div>
                                    <div class="hidden text-sm text-muted-foreground md:inline">
                                        liam@example.com
                                    </div>
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    Sale
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    <Badge class="text-xs" variant="outline">
                                        Approved
                                    </Badge>
                                </TableCell>
                                <TableCell class="hidden md:table-cell lg:hidden xl:table-column">
                                    2023-06-23
                                </TableCell>
                                <TableCell class="text-right">
                                    $250.00
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell>
                                    <div class="font-medium">
                                        Olivia Smith
                                    </div>
                                    <div class="hidden text-sm text-muted-foreground md:inline">
                                        olivia@example.com
                                    </div>
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    Refund
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    <Badge class="text-xs" variant="outline">
                                        Declined
                                    </Badge>
                                </TableCell>
                                <TableCell class="hidden md:table-cell lg:hidden xl:table-column">
                                    2023-06-24
                                </TableCell>
                                <TableCell class="text-right">
                                    $150.00
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell>
                                    <div class="font-medium">
                                        Noah Williams
                                    </div>
                                    <div class="hidden text-sm text-muted-foreground md:inline">
                                        noah@example.com
                                    </div>
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    Subscription
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    <Badge class="text-xs" variant="outline">
                                        Approved
                                    </Badge>
                                </TableCell>
                                <TableCell class="hidden md:table-cell lg:hidden xl:table-column">
                                    2023-06-25
                                </TableCell>
                                <TableCell class="text-right">
                                    $350.00
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell>
                                    <div class="font-medium">
                                        Emma Brown
                                    </div>
                                    <div class="hidden text-sm text-muted-foreground md:inline">
                                        emma@example.com
                                    </div>
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    Sale
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    <Badge class="text-xs" variant="outline">
                                        Approved
                                    </Badge>
                                </TableCell>
                                <TableCell class="hidden md:table-cell lg:hidden xl:table-column">
                                    2023-06-26
                                </TableCell>
                                <TableCell class="text-right">
                                    $450.00
                                </TableCell>
                            </TableRow>
                            <TableRow>
                                <TableCell>
                                    <div class="font-medium">
                                        Liam Johnson
                                    </div>
                                    <div class="hidden text-sm text-muted-foreground md:inline">
                                        liam@example.com
                                    </div>
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    Sale
                                </TableCell>
                                <TableCell class="hidden xl:table-column">
                                    <Badge class="text-xs" variant="outline">
                                        Approved
                                    </Badge>
                                </TableCell>
                                <TableCell class="hidden md:table-cell lg:hidden xl:table-column">
                                    2023-06-27
                                </TableCell>
                                <TableCell class="text-right">
                                    $550.00
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </main>



    <div class="px-8">
        <draggableComponent v-model="lists2" v-bind="dragOptions" class="list-group mb-40" @start="drag = true"
            @end="test22">
            <template #item="{ element }">
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">
                            {{ element.name }}

                            <div v-if="element.users">
                                <p v-for="(user, index) in element?.users" :key="index">
                                    {{ user.name }}
                                </p>
                            </div>
                        </CardTitle>
                        <DollarSign class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>

                </Card>
            </template>
        </draggableComponent>

        <div v-for="(items, index) in lists2" :key="index">
            <h1>{{ items.name }}</h1>
            <div v-if="items.users">
                <draggableComponent v-model="items.users" v-bind="dragOptions" class="list-group mb-40"
                    @start="drag = true" @end="test22">
                    <template #item="{ element }">
                        <Card>
                            <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                                <CardTitle class="text-sm font-medium">
                                    {{ element.name }}

                                    <div v-if="element.users">
                                        <p v-for="(user, index) in element?.users" :key="index">
                                            {{ user.name }}
                                        </p>
                                    </div>
                                </CardTitle>
                                <DollarSign class="h-4 w-4 text-muted-foreground" />
                            </CardHeader>

                        </Card>
                    </template>
                </draggableComponent>


            </div>
        </div>
    </div>
    <Mentionable :keys="['@']" :items="users" offset="1">
        <textarea v-model="text" />

        <template #no-result>
            <div class="dim">
                No result
            </div>
        </template>

        <template #item-@="{ item }">
            <div class="user ">
                {{ item.value }}
                <span class="dim">
                    ({{ item.firstName }})
                </span>
            </div>
        </template>
    </Mentionable>
</template>
<script setup>
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { ArrowUpRight, DollarSign } from 'lucide-vue-next'
import StatisticsCards from './StatisticsCards.vue'
import RecentProjects from './RecentProjects.vue'
import BarCharts from './BarCharts.vue'
import { computed, nextTick, onMounted, reactive, ref } from 'vue'
import draggableComponent from 'vuedraggable'
import { Mentionable } from 'vue-mention'
import LineChart from './LineChart.vue'

const text = ref('');
const users = [
    {
        value: 'akryum',
        firstName: 'Guillaume',
    },
    {
        value: 'posva',
        firstName: 'Eduardo',
    },
    {
        value: 'atinux',
        firstName: 'Sébastien',
    },
]


const lists = reactive([
    { id: 1, name: 'Vue' },
    { id: 2, name: 'Inertia' },
    { id: 3, name: 'Livewire' },
]);
const lists2 = ref([
    { id: 1, name: 'Laravel' },
    { id: 2, name: 'Node' },
    {
        id: 3,
        name: 'React',
        users: [
            { id: 1, name: 'mohammed' },
            { id: 1, name: 'ali' },
        ],
    },
]);


const drag = ref(false);
const dragOptions = computed(() => {
    return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
    };
})

const test22 = (event) => {
    console.log(event);
}

</script>

<style>
.button {
    margin-top: 35px;
}

.flip-list-move {
    transition: transform 0.5s;
}

.no-move {
    transition: transform 0s;
}

.ghost {
    opacity: 0.5;
    background: hsl(217.2 32.6% 17.5%);
    cursor: grab
}

.list-group {
    min-height: 20px;
}
</style>