<script setup lang="ts">
import ButtonLink from '@/components/ButtonLink.vue';
import InputError from '@/components/InputError.vue';
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import { Button } from '@/components/ui/button';
import ButtonEdit from '@/components/ui/button/ButtonEdit.vue';
import Dialog from '@/components/ui/dialog/Dialog.vue';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import DialogFooter from '@/components/ui/dialog/DialogFooter.vue';
import DialogHeader from '@/components/ui/dialog/DialogHeader.vue';
import DialogTitle from '@/components/ui/dialog/DialogTitle.vue';
import DialogTrigger from '@/components/ui/dialog/DialogTrigger.vue';
import { Input } from '@/components/ui/input';
import Table from '@/components/ui/table/Table.vue';
import TableBody from '@/components/ui/table/TableBody.vue';
import TableCell from '@/components/ui/table/TableCell.vue';
import TableHead from '@/components/ui/table/TableHead.vue';
import TableHeader from '@/components/ui/table/TableHeader.vue';
import TableRow from '@/components/ui/table/TableRow.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { ViewIndexData, type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { ChevronLeftIcon, ChevronRightIcon, LoaderCircle } from 'lucide-vue-next';
import { DialogClose } from 'reka-ui';

const props = defineProps<ViewIndexData>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Branches Management',
        href: '/branches',
    },
];

const form = useForm({
    search: props.params.search,
});

const formLimit = useForm({
    limit: props.params.limit,
});

const submit = () => form.get(route('branches.index'));
const changePageLimit = () => formLimit.get(route('branches.index'));

const formDelete = useForm({});

const deleteSubmit = (e: Event, id: string) => {
    e.preventDefault();

    formDelete.delete(route('branches.destroy', id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => formDelete.reset(),
    });
};

const closeModal = () => {
    formDelete.clearErrors();
    formDelete.reset();
};

const orderTable = (elem: string) => {
    props.data.data = [...props.data.data].sort((a, b) => {
        if ( a[elem] < b[elem] ){
            return -1;
        }
        if ( a[elem] > b[elem] ){
            return 1;
        }
        return 0;
    });
}
</script>

<template>
    <Head title="branch Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="mb-4" v-if="flash.success">
                <Alert variant="success">
                    <AlertTitle>Success !</AlertTitle>
                    <AlertDescription>{{ flash.success }}</AlertDescription>
                </Alert>
            </div>

            <div class="flex justify-between">
                <form @submit.prevent="submit">
                    <div class="flex gap-1">
                        <Input type="text" required autofocus :tabindex="1" v-model="form.search" placeholder="Type and enter to search.." />
                        <InputError :message="form.errors.search" />
                        <Button type="submit" :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Search
                        </Button>
                        <Button v-if="props.params.search" as="a" :href="route('branches.index')" variant="destructive">Batal</Button>
                    </div>
                </form>

                <ButtonLink :href="route('branches.create')">Create New Branch</ButtonLink>
            </div>
            <Table class="my-4 rounded-lg border p-8">
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[20px] text-center"> No </TableHead>
                        <TableHead class="cursor-pointer" @click="orderTable('name')">Branch Name</TableHead>
                        <TableHead class="cursor-pointer" @click="orderTable('city')">Location</TableHead>
                        <TableHead >Manager</TableHead>
                        <TableHead class="text-right">Action</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-if="data.data.length > 0" v-for="(item, index) in data.data">
                        <TableCell class="text-center">{{ index + 1 }}</TableCell>
                        <TableCell class="font-semibold">{{ item.name }}</TableCell>
                        <TableCell>{{ item.city }}, {{ item.province }}</TableCell>
                        <TableCell>{{ item.manager.name }} / {{ item.manager.contact }}</TableCell>
                        <TableCell class="text-right">
                            <div class="flex justify-end gap-2">
                                <Button variant="outline" as="a" :href="route('branches.edit', { id: item.id })">
                                    <span class="hidden sm:block">Add Technician</span>
                                </Button as="a">
                                <ButtonEdit :href="route('branches.edit', { id: item.id })">
                                    <span class="hidden sm:block">Edit</span>
                                </ButtonEdit>
                                <Dialog>
                                    <DialogTrigger as-child>
                                        <Button class="hover:bg-red-700 hover:text-white" variant="outline">
                                            <span class="hidden sm:block">Delete</span>
                                        </Button>
                                    </DialogTrigger>
                                    <DialogContent>
                                        <form class="space-y-6" @submit="deleteSubmit($event, item.id)">
                                            <DialogHeader class="space-y-3">
                                                <DialogTitle>Are you sure you want to delete this resource?</DialogTitle>
                                                <DialogDescription>
                                                    Once resource is deleted, all of its resources and data will also be permanently deleted.
                                                </DialogDescription>
                                            </DialogHeader>

                                            <DialogFooter class="gap-2">
                                                <DialogClose as-child>
                                                    <Button variant="secondary" @click="closeModal"> Cancel </Button>
                                                </DialogClose>

                                                <Button variant="destructive" class="cursor-pointer" :disabled="form.processing">
                                                    <button type="submit">Delete account</button>
                                                </Button>
                                            </DialogFooter>
                                        </form>
                                    </DialogContent>
                                </Dialog>
                            </div>
                        </TableCell>
                    </TableRow>
                    <TableRow v-else>
                        <TableCell class="text-center" colspan="5">There are no data available.</TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <div class="mt-2 flex items-center justify-between">
                <div class="flex items-center gap-2 text-sm">
                    Shown
                    <select v-model="formLimit.limit" @change="changePageLimit" class="cursor-pointer">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="100">100</option>
                    </select>
                    of {{ data.total }} items.
                </div>
                <div class="flex items-center gap-2">
                    <ButtonLink v-if="data.prev_page_url" :href="data.prev_page_url" :disabled="data.prev_page_url">
                        <ChevronLeftIcon />
                        <span class="hidden sm:block">Previous</span>
                    </ButtonLink>
                    <ButtonLink v-if="data.next_page_url" :href="data.next_page_url">
                        <span class="hidden sm:block">Next</span>
                        <ChevronRightIcon />
                    </ButtonLink>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
