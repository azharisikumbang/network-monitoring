<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { type UserEditForm } from '../../types/index';

const props = defineProps<UserEditForm>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Management',
        href: '/users',
    },
    {
        title: 'Edit user',
        href: '#',
    },
];

const form = useForm({
    name: props.name,
    contact: props.contact,
});

const submit = () => form.put(route('users.update', { id: props.id }));
</script>

<template>
    <Head title="Create new user" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="max-w-xl">
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="email">Email address <small class="text-sm text-gray-400 italic">(email cannot change.)</small></Label>
                            <p class="text-gray-600 italic">{{ props.email }}</p>
                        </div>

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
                            <Input
                                id="contact"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="contact"
                                v-model="form.contact"
                                placeholder="Contact"
                            />
                            <InputError :message="form.errors.contact" />
                        </div>

                        <div>
                            <Button type="submit" tabindex="5" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Update
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
