<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import Select from '@/components/ui/input/Select.vue';
import TextArea from '@/components/ui/input/TextArea.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    branches: Array<{
        id: string;
        name: string;
        province: string;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sites Management',
        href: '/sites',
    },
    {
        title: 'Create New Site',
        href: '/sites/create',
    },
];

const form = useForm({
    terminal_id: '',
    name: '',
    province: '',
    city: '',
    address: '',
    latitude: '',
    longitude: '',
    contract_document: '',
    branch_id: '',
});

const submit = () => form.post(route('sites.store'));
</script>

<template>
    <Head title="Create New Site" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="max-w-xl">
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="name">Branch</Label>
                            <small class="text-gray-600">Selected branch will attach to NOC and Technician.</small>
                            <Select v-model="form.branch_id" required>
                                <option value="" disabled>-- Selec branch location --</option>
                                <template v-for="(branch, index) in branches">
                                    <option :value="branch.id">{{ branch.name }} ({{ branch.province }})</option>
                                </template>
                            </Select>
                            <InputError :message="form.errors.branch_id" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="terminal_id">Terminal Id</Label>
                            <Input
                                id="terminal_id"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="terminal_id"
                                v-model="form.terminal_id"
                                placeholder="Fill based on contract"
                            />
                            <InputError :message="form.errors.terminal_id" />
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
                                placeholder="Branch contract name"
                            />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-2">
                                <Label for="province">Province</Label>
                                <Input id="province" type="text" required autofocus :tabindex="1" autocomplete="province" v-model="form.province" />
                                <InputError :message="form.errors.province" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="city">City</Label>
                                <Input id="city" type="text" required autofocus :tabindex="1" autocomplete="city" v-model="form.city" />
                                <InputError :message="form.errors.city" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <Label for="address">Address</Label>
                            <TextArea
                                id="address"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="address"
                                v-model="form.address"
                                placeholder="Branch complete address"
                                :rows="4"
                                :cols="5"
                            ></TextArea>
                            <InputError :message="form.errors.address" />
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-2">
                                <Label for="latitude">Latitude</Label>
                                <Input id="latitude" type="text" required autofocus :tabindex="1" autocomplete="latitude" v-model="form.latitude" />
                                <InputError :message="form.errors.latitude" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="longitude">Longitude</Label>
                                <Input
                                    id="longitude"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="longitude"
                                    v-model="form.longitude"
                                />
                                <InputError :message="form.errors.longitude" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <Label for="contract_document">Contract/Legal Document (.pdf)</Label>
                            <Input
                                id="contract_document"
                                type="file"
                                @input="form.contract_document = $event.target.files[0]"
                                placeholder="contract_document Name"
                            />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                uploading {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.contract_document" />
                        </div>

                        <div>
                            <Button type="submit" class="mt-2" tabindex="5" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Submit
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
