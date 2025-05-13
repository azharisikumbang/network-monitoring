<script setup lang="ts">
import ButtonLink from '@/components/ButtonLink.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import TextLink from '@/components/TextLink.vue';
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { SharedData, type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage<SharedData>();
const props = defineProps<{
    site: {
        id: string;
        terminal_id: string;
        name: string;
        province: string;
        city: string;
        address: string;
        latitude: string;
        longitude: string;
        contract_document: string;
        branch_id: string;
        branch: {
            id: string;
            name: string;
            province: string;
        };
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sites Management',
        href: '/sites',
    },
    {
        title: 'Site Details',
        href: '/sites/sites/' + props.site.id,
    },
];
</script>

<template>
    <Head title="branch Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="mb-4" v-if="page.props.flash.success">
                <Alert variant="success">
                    <AlertTitle>Success !</AlertTitle>
                    <AlertDescription>{{ page.props.flash.success }}</AlertDescription>
                </Alert>
            </div>

            <div class="grid w-full grid-cols-3 gap-4">
                <div>
                    <HeadingSmall title="Site Details" description="All displayed data is based on contract document." />
                    <dl class="divide-y divide-gray-100">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Terminal ID</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ site.terminal_id }}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Site Name</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ site.name }}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Address</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ site.address }}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">City and Province</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ site.city }}, {{ site.province }}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Latitude/Longitude</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                                Lat: {{ site.latitude }}, Lng: {{ site.longitude }} (<TextLink href="">View google map</TextLink>)
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">PIC on Location</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">-</dd>
                        </div>

                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Contract Document</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                                <a
                                    class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                                    :href="route('sites.contract_document.download', { site: site.id })"
                                >
                                    Download ({{ site.contract_document }})
                                </a>
                            </dd>
                        </div>
                    </dl>
                </div>
                <div>
                    <HeadingSmall title="Branch Information" description="Edit branch information on branch page." />
                    <dl class="divide-y divide-gray-100">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Branch Name</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ site.branch.name }}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Branch Location</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ site.branch.city }}, {{ site.branch.province }}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">NOC</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">-</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Technician</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">-</dd>
                        </div>
                    </dl>
                </div>
                <div>
                    <HeadingSmall
                        title="Site Activities"
                        description="Shown all administration activies, for site's devices activies you see on monitoring page."
                    />

                    <div class="mt-2">
                        <ol class="relative border-s border-gray-200 dark:border-gray-700">
                            <li class="ms-4 mb-10">
                                <div
                                    class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"
                                ></div>
                                <time class="mb-1 text-sm leading-none font-normal text-gray-400 dark:text-gray-500">9 Mei 2025</time>
                                <h3 class="font-medium text-gray-900 dark:text-white">Site information modified.</h3>
                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Modified from {} to {}</p>
                            </li>
                            <li class="ms-4 mb-10">
                                <div
                                    class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"
                                ></div>
                                <time class="mb-1 text-sm leading-none font-normal text-gray-400 dark:text-gray-500">10 Maret 2025</time>
                                <h3 class="font-medium text-gray-900 dark:text-white">Site Information created.</h3>
                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Created by adminstrator.</p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex gap-2">
                <ButtonLink variant="outline" :href="route('sites.edit', site.id)">Edit Site Information</ButtonLink>
                <ButtonLink variant="outline" href="">Add new device</ButtonLink>
                <Button variant="destructive">Deactivate Site</Button>
            </div>
        </div>
    </AppLayout>
</template>
