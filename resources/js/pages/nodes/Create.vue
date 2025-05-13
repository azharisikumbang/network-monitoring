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
    sites: Object;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Nodes Management',
        href: '/nodes',
    },
    {
        title: 'Add new node',
        href: '/nodes/create',
    },
];

const form = useForm({
    name: '',
    ip_address: '',
    network_address: '',
    type: '',
    description: '',
    config_snmp_port: '',
    config_snmp_key: '',
    config_ssh_port: '',
    config_ssh_public_key: '',
    site_id: '',
});

const deviceTypes = ['MODEM', 'ROUTER', 'ACCESS_POINT', 'OLT', 'ONT', 'SERVER'];

const submit = () => form.post(route('nodes.store'));
</script>

<template>
    <Head title="Create New Site" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="max-w-xl">
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="name">Attach node to site</Label>
                            <small class="text-gray-600">This devices will attach to the site.</small>
                            <Select v-model="form.site_id" required>
                                <option value="" disabled>-- Select site --</option>
                                <template v-for="(site, index) in sites">
                                    <option :value="index">{{ site }}</option>
                                </template>
                            </Select>
                            <InputError :message="form.errors.site_id" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="name">Device Type</Label>
                            <Select v-model="form.type" required>
                                <option value="" disabled>-- Select device type --</option>
                                <template v-for="(device, index) in deviceTypes">
                                    <option :value="device">{{ device }}</option>
                                </template>
                            </Select>
                            <InputError :message="form.errors.type" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="name" :optional="true">Device Name</Label>
                            <small class="text-gray-600">Leave it blank if you want auto generated with format {SITE_NAME-DEVICE_TYPE-number}</small>
                            <Input id="name" type="text" v-model="form.name" />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-2">
                                <Label for="ip_address">IPv4 Address</Label>
                                <Input
                                    id="ip_address"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="ip_address"
                                    v-model="form.ip_address"
                                    placeholder="xxx.xxx.xxx.xxx"
                                />
                                <InputError :message="form.errors.ip_address" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="name">Network Prefix</Label>
                                <Select v-model="form.network_address" required>
                                    <option value="" disabled>-- Select network prefix --</option>
                                    <template v-for="n in 13">
                                        <option :value="n + 19">/{{ n + 19 }}</option>
                                    </template>
                                </Select>
                                <InputError :message="form.errors.network_address" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-2">
                                <Label for="config_snmp_port" :optional="true">SNMP Port</Label>
                                <Input
                                    id="config_snmp_port"
                                    type="number"
                                    v-model="form.config_snmp_port"
                                    placeholder="Leave blank to use default."
                                />
                                <InputError :message="form.errors.config_snmp_port" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="config_snmp_key" :optional="true">SNMP Key (or Community String)</Label>
                                <Input id="config_snmp_key" type="text" v-model="form.config_snmp_key" placeholder="Case-sensitive." />
                                <InputError :message="form.errors.config_snmp_key" />
                            </div>
                        </div>

                        <div class="grid w-full grid-cols-2 place-items-start gap-2">
                            <div class="grid w-full gap-2 place-self-auto">
                                <Label for="config_ssh_port" :optional="true">SSH Port</Label>
                                <Input
                                    id="config_ssh_port"
                                    class="w-full"
                                    type="number"
                                    v-model="form.config_ssh_port"
                                    placeholder="Leave blank to use default."
                                />
                                <InputError :message="form.errors.config_ssh_port" />
                            </div>
                            <div class="grid gap-2 place-self-stretch">
                                <Label for="config_ssh_public_key" :optional="true">SSH Public Key</Label>
                                <TextArea :rows="5" :cols="30" v-model="form.config_ssh_public_key" placeholder="Paste your ssh key here."></TextArea>
                                <InputError :message="form.errors.config_ssh_public_key" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <Label for="description" :optional="true">Devices additional notes or description</Label>
                            <TextArea
                                :rows="5"
                                :cols="30"
                                v-model="form.description"
                                placeholder="Add some notes to easily identify the device"
                            ></TextArea>
                            <InputError :message="form.errors.description" />
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
