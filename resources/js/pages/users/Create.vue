<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import Select from '@/components/ui/input/Select.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps<{
    roles: Array<{
        id: string;
        name: string;
        as: string;
    }>;
    branches: Array<{
        id: string;
        name: string;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Management',
        href: '/users',
    },
    {
        title: 'Create New User',
        href: '/users/create',
    },
];

const form = useForm({
    name: '',
    email: '',
    branch_id: '',
    contact: '',
    role_id: '',
    password: '',
    password_confirmation: '',
});

const submit = () => form.post(route('users.store'));

const getRoleIdFoTechnician = () => {
    const roleTechnician = props.roles.filter((a) => a.name.toLowerCase() == 'technician');

    if (roleTechnician == undefined) return false;

    return roleTechnician[0].id;
};
</script>

<template>
    <Head title="Create new user" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="max-w-xl">
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <HeadingSmall title="User Information" />

                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input
                                id="name"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="name"
                                v-model="form.name"
                                placeholder="Full name"
                            />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="contact">Contact / Phone Number / Whatsapp</Label>
                            <Input autofocus id="contact" type="text" required autocomplete="contact" v-model="form.contact" />
                            <InputError :message="form.errors.contact" />
                        </div>

                        <HeadingSmall
                            title="Account Information"
                            description="The data will be used for authentication and authorization"
                            class="mt-4"
                        />

                        <div class="grid gap-2">
                            <Label for="role_id">Select role for this user</Label>
                            <Select autofocus v-model="form.role_id" required>
                                <option value="" disabled>-- Select role --</option>
                                <template v-for="item in roles">
                                    <option :value="item.id">{{ item.as }}</option>
                                </template>
                            </Select>
                            <InputError :message="form.errors.role_id" />
                        </div>

                        <div class="grid gap-2" v-show="form.role_id == getRoleIdFoTechnician()">
                            <Label for="name" :optional="true">Locate Technician To Branch</Label>
                            <small class="text-gray-500">Only applied for role Technician. </small>
                            <Select autofocus v-model="form.branch_id">
                                <option value="">-- Select branch --</option>
                                <template v-for="item in branches">
                                    <option :value="item.id">{{ item.name }}</option>
                                </template>
                            </Select>
                            <InputError :message="form.errors.branch_id" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                autofocus
                                required
                                autocomplete="email"
                                v-model="form.email"
                                placeholder="email@example.com"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                required
                                autofocus
                                autocomplete="new-password"
                                v-model="form.password"
                                placeholder="Password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                required
                                autofocus
                                autocomplete="new-password"
                                v-model="form.password_confirmation"
                                placeholder="Confirm password"
                            />
                            <InputError :message="form.errors.password_confirmation" />
                        </div>

                        <div>
                            <Button type="submit" class="mt-2" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Create account
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
