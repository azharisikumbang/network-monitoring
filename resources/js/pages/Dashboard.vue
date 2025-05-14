<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { AlertCircle, Building2, Map, Phone, Router, TicketCheck, Wifi } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div class="space-y-1">
                            <p class="text-muted-foreground text-sm font-medium">Managed Branches</p>
                            <div class="flex items-baseline gap-1">
                                <h2 class="text-3xl font-bold">X</h2>
                            </div>
                        </div>
                        <div class="bg-primary/10 rounded-full p-2">
                            <Building2 class="text-primary h-5 w-5" />
                        </div>
                    </div>
                    <div class="text-muted-foreground mt-4 text-xs"><span class="font-medium text-emerald-500">+2</span> new branches this month</div>
                </div>

                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div class="space-y-1">
                            <p class="text-muted-foreground text-sm font-medium">Managed Sites</p>
                            <div class="flex items-baseline gap-1">
                                <h2 class="text-3xl font-bold">X</h2>
                            </div>
                        </div>
                        <div class="bg-primary/10 rounded-full p-2">
                            <Map class="text-primary h-5 w-5" />
                        </div>
                    </div>
                    <div class="text-muted-foreground mt-4 text-xs"><span class="font-medium text-emerald-500">+5</span> new sites this month</div>
                </div>

                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div class="space-y-1">
                            <p class="text-muted-foreground text-sm font-medium">Total Devices</p>
                            <div class="flex items-baseline gap-1">
                                <h2 class="text-3xl font-bold">X</h2>
                            </div>
                        </div>
                        <div class="bg-primary/10 rounded-full p-2">
                            <Router class="text-primary h-5 w-5" />
                        </div>
                    </div>
                    <div class="text-muted-foreground mt-4 text-xs"><span class="font-medium text-emerald-500">+12</span> new devices this month</div>
                </div>

                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div class="space-y-1">
                            <p class="text-muted-foreground text-sm font-medium">Active Tickets</p>
                            <div class="flex items-baseline gap-1">
                                <h2 class="text-3xl font-bold">X</h2>
                            </div>
                        </div>
                        <div class="bg-primary/10 rounded-full p-2">
                            <TicketCheck class="text-primary h-5 w-5" />
                        </div>
                    </div>
                    <div class="text-muted-foreground mt-4 text-xs"><span class="font-medium text-rose-500">+3</span> new tickets today</div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Site Status -->
                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-semibold">Site Status</h3>
                    <div class="flex h-64 items-center justify-center">
                        <div class="relative h-64 w-64">
                            <!-- Simple pie chart representation -->
                            <svg viewBox="0 0 100 100" class="h-full w-full">
                                <!-- Online sites (green) -->
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="40"
                                    fill="transparent"
                                    stroke="#10b981"
                                    stroke-width="20"
                                    stroke-dasharray="188.5 251.3"
                                    transform="rotate(-90 50 50)"
                                />
                                <!-- Offline sites (red) -->
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="40"
                                    fill="transparent"
                                    stroke="#ef4444"
                                    stroke-width="20"
                                    stroke-dasharray="62.8 251.3"
                                    stroke-dashoffset="-188.5"
                                    transform="rotate(-90 50 50)"
                                />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <div class="text-4xl font-bold">X</div>
                                <div class="text-muted-foreground text-sm">Total Sites</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-2">
                            <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                            <div class="text-sm"><span class="font-medium">X</span> Online (X %)</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-3 w-3 rounded-full bg-red-500"></div>
                            <div class="text-sm"><span class="font-medium">Y</span> Offline (Y %)</div>
                        </div>
                    </div>
                </div>

                <!-- Device Status -->
                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-semibold">Device Status</h3>
                    <div class="flex h-64 items-center justify-center">
                        <div class="relative h-64 w-64">
                            <!-- Simple pie chart representation -->
                            <svg viewBox="0 0 100 100" class="h-full w-full">
                                <!-- Online devices (green) -->
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="40"
                                    fill="transparent"
                                    stroke="#10b981"
                                    stroke-width="20"
                                    stroke-dasharray="188.5 251.3"
                                    transform="rotate(-90 50 50)"
                                />
                                <!-- Offline devices (red) -->
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="40"
                                    fill="transparent"
                                    stroke="#ef4444"
                                    stroke-width="20"
                                    stroke-dasharray="62.8 251.3"
                                    stroke-dashoffset="-188.5"
                                    transform="rotate(-90 50 50)"
                                />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <div class="text-4xl font-bold">X</div>
                                <div class="text-muted-foreground text-sm">Total Devices</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-2">
                            <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                            <div class="text-sm"><span class="font-medium">Y</span> Online (x %)</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-3 w-3 rounded-full bg-red-500"></div>
                            <div class="text-sm"><span class="font-medium">Z</span> Offline (y %)</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Sites Updates (Problems)</h3>
                        <button class="text-primary text-sm hover:underline">View All</button>
                    </div>
                    <div class="space-y-4" v-for="n in 5">
                        <div class="flex items-start gap-4 border-b pb-4 last:border-0">
                            <div class="rounded-full bg-red-500 p-2">
                                <AlertCircle class="h-4 w-4 text-white" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="truncate font-medium">Site Name</h4>
                                    <span class="text-muted-foreground text-xs">Solok, Sumatra Barat</span>
                                </div>
                                <p class="text-muted-foreground truncate text-sm">
                                    <ol>
                                        <li>Modem (ip: xxx.xxx.xxx.xx) -> offline</li>
                                        <li>Router (ip: xxx.xxx.xxx.xx) -> offline</li>
                                    </ol>
                                </p>
                                <div class="mt-2 flex items-center gap-2">
                                    <Phone class="text-muted-foreground h-3 w-3" />
                                    <span class="text-xs">Azhari (0812 5263 2738)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Tickets -->
                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Recent Tickets</h3>
                        <button class="text-primary text-sm hover:underline">View All</button>
                    </div>
                    <div class="space-y-4" v-for="n in 5">
                        <div class="flex items-start gap-4 border-b pb-4 last:border-0">
                            <div class="rounded-full bg-red-500 p-2">
                                <AlertCircle class="h-4 w-4 text-white" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="truncate font-medium">Site Down - Inet Down</h4>
                                    <span class="text-muted-foreground text-xs">2 Mei 2025</span>
                                </div>
                                <p class="text-muted-foreground truncate text-sm">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec risus ullamcorper, sodales est a, semper elit.
                                </p>
                                <div class="mt-1 flex items-center gap-2">
                                    <Map class="text-muted-foreground h-3 w-3" />
                                    <span class="text-xs">Site Y</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Device Issues -->
                <div class="bg-card rounded-lg border p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Device Issues</h3>
                        <button class="text-primary text-sm hover:underline">View All</button>
                    </div>
                    <div class="space-y-4" v-for="n in 5">
                        <div class="flex items-start gap-4 border-b pb-4 last:border-0">
                            <div class="rounded-full bg-red-500 p-2">
                                <Wifi class="h-4 w-4 text-white" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="truncate font-medium">Modem ICMP Timeout.</h4>
                                    <span class="text-muted-foreground text-xs">2 Mei 2025</span>
                                </div>
                                <p class="text-muted-foreground truncate text-sm">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nec risus ullamcorper, sodales est a, semper elit.
                                </p>
                                <div class="mt-1 flex items-center gap-2">
                                    <Map class="text-muted-foreground h-3 w-3" />
                                    <span class="text-xs">Site X</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
