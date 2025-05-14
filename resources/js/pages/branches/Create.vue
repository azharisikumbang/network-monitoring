<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import Select from '@/components/ui/input/Select.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { getListProvinces } from '@/lib/utils';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    managers: Array<{
        id: string;
        name: string;
        contact: string;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Branch Management',
        href: '/branches',
    },
    {
        title: 'Create New Branch',
        href: '/branches/create',
    },
];

const form = useForm({
    name: '',
    province: '',
    city: '',
    manager_id: '',
});

const submit = () => form.post(route('branches.store'));
</script>

<template>
    <Head title="Create new Branch" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="max-w-xl">
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
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
                                placeholder="Branch name"
                            />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="name">Province</Label>
                            <Select v-model="form.province" required>
                                <option value="" disabled selected>-- Branch Location --</option>
                                <template v-for="(prov, index) in getListProvinces()">
                                    <option :value="prov.as">{{ prov.as }}</option>
                                </template>
                            </Select>
                            <InputError :message="form.errors.province" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="city">City Name</Label>
                            <Input
                                id="city"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="city"
                                v-model="form.city"
                                placeholder="City Name"
                            />
                            <InputError :message="form.errors.city" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="name">Branch Manager</Label>
                            <small class="text-gray-500">All sites and devices that attached to this branch will managed by this users.</small>
                            <Select v-model="form.manager_id" required>
                                <option value="" disabled selected>-- Select Branch Manager --</option>
                                <template v-for="(item, index) in managers">
                                    <option :value="item.id">{{ item.name }} - {{ item.contact }}</option>
                                </template>
                            </Select>
                            <InputError :message="form.errors.manager_id" />
                        </div>

                        <div>
                            <Button type="submit" class="mt-2" tabindex="5" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Add Branch
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
