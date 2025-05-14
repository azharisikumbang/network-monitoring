<script setup lang="ts">
import ButtonLink from '@/components/ButtonLink.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import TextLink from '@/components/TextLink.vue';
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import Button from '@/components/ui/button/Button.vue';
import Dialog from '@/components/ui/dialog/Dialog.vue';
import DialogClose from '@/components/ui/dialog/DialogClose.vue';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import DialogFooter from '@/components/ui/dialog/DialogFooter.vue';
import DialogHeader from '@/components/ui/dialog/DialogHeader.vue';
import DialogTitle from '@/components/ui/dialog/DialogTitle.vue';
import DialogTrigger from '@/components/ui/dialog/DialogTrigger.vue';
import Tooltip from '@/components/ui/tooltip/Tooltip.vue';
import TooltipContent from '@/components/ui/tooltip/TooltipContent.vue';
import TooltipProvider from '@/components/ui/tooltip/TooltipProvider.vue';
import TooltipTrigger from '@/components/ui/tooltip/TooltipTrigger.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { SharedData, type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';

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
        technicians: Array<Object>;
        audits: Array<Object>;
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

const formDeactivate = useForm({});

const applyDeactivate = (e: Event, id: string) => {
    e.preventDefault();

    formDeactivate.delete(route('sites.destroy', id), {
        onFinish: () => formDeactivate.clearErrors(),
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    formDeactivate.clearErrors();
    formDeactivate.reset();
};
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
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                                {{ site.branch.manager.name }} / {{ site.branch.manager.contact }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm/6 font-medium text-gray-900">Technician</dt>
                            <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                                <ol>
                                    <li v-for="technician in site.branch.technicians">{{ technician.name }} / {{ technician.contact }}</li>
                                </ol>
                            </dd>
                        </div>
                    </dl>
                </div>
                <div>
                    <HeadingSmall
                        title="Site Activities and Logs"
                        description="Shown all administration activies, for site's devices activies you see on monitoring page."
                    />

                    <div class="mt-2">
                        <ol class="relative border-s border-gray-200 dark:border-gray-700">
                            <li class="ms-4 mb-10" v-if="site.audits.length > 0" v-for="(item, index) in site.audits">
                                <div
                                    class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"
                                ></div>
                                <time class="mb-1 text-sm leading-none font-normal text-gray-400 dark:text-gray-500">{{
                                    new Date(item.created_at).toLocaleString('id-ID')
                                }}</time>
                                <h3 class="font-medium text-gray-900 dark:text-white">
                                    <TooltipProvider>
                                        <Tooltip>
                                            <TooltipTrigger
                                                ><TextLink href="#">
                                                    Resource {{ item.event.charAt(0).toUpperCase() + item.event.slice(1) }}
                                                </TextLink></TooltipTrigger
                                            >
                                            <TooltipContent>
                                                <p>Click to see details</p>
                                            </TooltipContent>
                                        </Tooltip>
                                    </TooltipProvider>
                                </h3>
                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                    Resource was {{ item.event }} by <TextLink href="">{{ item.user.name }}</TextLink> (role:
                                    {{ item.user.role.as.toLowerCase() }}).
                                </p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex gap-2">
                <ButtonLink variant="outline" :href="route('sites.edit', site.id)">Edit Site Information</ButtonLink>
                <ButtonLink variant="outline" href="">Add new device</ButtonLink>
                <Dialog>
                    <DialogTrigger as-child>
                        <Button variant="destructive">
                            <span class="hidden sm:block">Deactivate Site</span>
                        </Button>
                    </DialogTrigger>
                    <DialogContent>
                        <form class="space-y-6" @submit="applyDeactivate($event, site.id)">
                            <DialogHeader class="space-y-3">
                                <DialogTitle>Are you sure you want to deactivate this site?</DialogTitle>
                                <DialogDescription>
                                    Deactivate this site will make its not available for monitoring or reporting. Its just available as an archieves.
                                    You can check it later on menu 'Archives'.
                                </DialogDescription>
                            </DialogHeader>

                            <DialogFooter class="gap-2">
                                <DialogClose as-child>
                                    <Button variant="secondary" @click="closeModal"> Cancel </Button>
                                </DialogClose>

                                <Button variant="destructive">
                                    <button type="submit">Deactivate Now</button>
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            </div>
        </div>
    </AppLayout>
</template>
