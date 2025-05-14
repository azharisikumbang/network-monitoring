<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import Dialog from '@/components/ui/dialog/Dialog.vue';
import DialogClose from '@/components/ui/dialog/DialogClose.vue';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import DialogFooter from '@/components/ui/dialog/DialogFooter.vue';
import DialogHeader from '@/components/ui/dialog/DialogHeader.vue';
import DialogTitle from '@/components/ui/dialog/DialogTitle.vue';
import DialogTrigger from '@/components/ui/dialog/DialogTrigger.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Table from '@/components/ui/table/Table.vue';
import TableBody from '@/components/ui/table/TableBody.vue';
import TableCell from '@/components/ui/table/TableCell.vue';
import TableHead from '@/components/ui/table/TableHead.vue';
import TableHeader from '@/components/ui/table/TableHeader.vue';
import TableRow from '@/components/ui/table/TableRow.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    roles: Array<{
        id: string;
        name: string;
        as: string;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role Management',
        href: '/roles',
    },
];

const form = useForm({
    name: '',
    as: '',
    id: '',
});

const submit = () => {
    form.post(route('roles.store'), {
        onSuccess: () => form.reset('name', 'as'),
    });
};

let isEdit = false;

const applyEdit = (id: string, name: string, as: string) => {
    isEdit = true;

    form.id = id;
    form.name = name;
    form.as = as;
};

const applyReset = () => {
    isEdit = false;

    form.reset();
};

const formDelete = useForm({});

const applyDelete = (e: Event, id: string) => {
    e.preventDefault();

    formDelete.delete(route('roles.destroy', id), {
        preserveScroll: true,
        onError: () => closeModal(),
        onFinish: () => closeModal(),
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    formDelete.clearErrors();
    formDelete.reset();
};
</script>

<template>
    <Head title="Role Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="mb-4" v-if="$page.props.flash.success">
                <Alert variant="success">
                    <AlertTitle>Success !</AlertTitle>
                    <AlertDescription>{{ $page.props.flash.success }}</AlertDescription>
                </Alert>
            </div>

            <div class="mb-4" v-if="$page.props.flash.error">
                <Alert variant="destructive" class="border-red-500">
                    <AlertTitle>Something went wrong !</AlertTitle>
                    <AlertDescription>{{ $page.props.flash.error }}</AlertDescription>
                </Alert>
            </div>

            <HeadingSmall
                title="Roles"
                description="All roles available on the website. Add new role on right panel or click edit to update the role information."
            />

            <div class="grid w-full grid-cols-3 gap-4">
                <div class="col-span-2">
                    <Table class="my-4 rounded-lg border p-8">
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[20px] text-center"> No </TableHead>
                                <TableHead>Role Name</TableHead>
                                <TableHead class="text-right">Action</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-if="roles.length > 0" v-for="(item, index) in roles">
                                <TableCell class="text-center">{{ index + 1 }}</TableCell>
                                <TableCell class="font-semibold">{{ item.as }} ({{ item.name }})</TableCell>
                                <TableCell class="text-right">
                                    <div class="flex justify-end gap-2">
                                        <Button variant="outline" @click="applyEdit(item.id, item.name, item.as)">
                                            <span class="hidden sm:block">Edit</span>
                                        </Button>
                                        <Dialog>
                                            <DialogTrigger as-child>
                                                <Button class="hover:bg-red-700 hover:text-white" variant="outline">
                                                    <span class="hidden sm:block">Delete</span>
                                                </Button>
                                            </DialogTrigger>
                                            <DialogContent>
                                                <form class="space-y-6" @submit="applyDelete($event, item.id)">
                                                    <DialogHeader class="space-y-3">
                                                        <DialogTitle>Are you sure you want to delete this resource?</DialogTitle>
                                                        <DialogDescription>
                                                            Its a soft deleted resources. Its mean you can restore it when ever you want.
                                                        </DialogDescription>
                                                    </DialogHeader>

                                                    <DialogFooter class="gap-2">
                                                        <DialogClose as-child>
                                                            <Button variant="secondary"> Cancel </Button>
                                                        </DialogClose>

                                                        <Button variant="destructive">
                                                            <button type="submit">Delete Resource</button>
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
                </div>
                <Card class="bg-card">
                    <CardHeader>
                        <CardTitle> Add or Edit Role </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form @submit.prevent="submit" class="flex flex-col gap-6">
                            <div class="grid gap-6">
                                <Input id="id" type="hidden" autocomplete="id" v-model="form.id" />
                                <div class="grid gap-2">
                                    <Label for="name">Name</Label>
                                    <small class="text-gray-500">Use uppercase and no spaces.</small>
                                    <Input
                                        id="name"
                                        type="text"
                                        required
                                        autofocus
                                        :tabindex="1"
                                        autocomplete="name"
                                        v-model="form.name"
                                        placeholder="ex. BRANCH_MANAGER"
                                    />
                                    <InputError :message="form.errors.name" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="as" :optional="true">Display as</Label>
                                    <Input id="as" type="text" v-model="form.as" placeholder="Role displayed as, ex: Branch Manager" />
                                    <InputError :message="form.errors.as" />
                                </div>

                                <div class="flex gap-2">
                                    <Button type="submit" class="mt-2" tabindex="5" :disabled="form.processing">
                                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                        <span v-if="isEdit">Update Role</span>
                                        <span v-else>Add role</span>
                                    </Button>
                                    <Button v-if="isEdit" type="reset" class="mt-2" variant="destructive" @click.prevent="applyReset">
                                        Cancel
                                    </Button>
                                </div>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
