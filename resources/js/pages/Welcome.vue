<script setup lang="ts">
import { SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Activity, ArrowRight, Building2, CheckCircle2, Map, Network, Router, TicketCheck, Users } from 'lucide-vue-next';

const appName = usePage<SharedData>().props.name;
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] text-[#1b1b18] lg:justify-center dark:bg-[#0a0a0a]">
        <header class="container mx-auto mb-6 p-8 text-sm not-has-[nav]:hidden">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-2">
                    <Network class="text-primary h-6 w-6" />
                    <span class="text-xl font-bold">{{ appName }}</span>
                </div>
                <nav class="hidden gap-6 md:flex">
                    <a href="#features" class="hover:text-primary text-sm font-medium"> Features </a>
                    <a href="#how-it-works" class="hover:text-primary text-sm font-medium"> How It Works </a>
                    <a href="#benefits" class="hover:text-primary text-sm font-medium"> Benefits </a>
                    <a href="#contact" class="hover:text-primary text-sm font-medium"> Contact </a>
                </nav>
                <div class="flex items-center gap-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="route('register')"
                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </div>
        </header>

        <main class="w-full flex-1">
            <!-- Hero Section -->
            <section class="from-background to-muted w-full bg-gradient-to-b py-12 md:py-24 lg:py-32">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="grid items-center gap-6 lg:grid-cols-2 lg:gap-12">
                        <div class="flex flex-col justify-center space-y-4">
                            <div class="space-y-2">
                                <h1 class="text-3xl font-bold tracking-tighter sm:text-5xl xl:text-6xl/none">
                                    Complete FTTH Network Monitoring & Ticketing Solution
                                </h1>
                                <p class="text-muted-foreground max-w-[600px] md:text-xl">
                                    Monitor your fiber network infrastructure, manage tickets, and organize your sites and branches all in one
                                    powerful platform.
                                </p>
                            </div>
                            <div class="flex flex-col gap-2 min-[400px]:flex-row">
                                <button
                                    class="ring-offset-background focus-visible:ring-ring bg-primary text-primary-foreground hover:bg-primary/90 inline-flex h-11 items-center justify-center gap-1 rounded-md px-8 text-sm font-medium whitespace-nowrap transition-colors focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50"
                                >
                                    Request Demo <ArrowRight class="h-4 w-4" />
                                </button>
                                <button
                                    class="ring-offset-background focus-visible:ring-ring border-input bg-background hover:bg-accent hover:text-accent-foreground inline-flex h-11 items-center justify-center rounded-md border px-8 text-sm font-medium whitespace-nowrap transition-colors focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50"
                                >
                                    Learn More
                                </button>
                            </div>
                        </div>
                        <div class="bg-background relative h-[300px] overflow-hidden rounded-lg border p-2 lg:h-[400px]">
                            <img
                                src="https://plus.unsplash.com/premium_photo-1661645671364-37449092c617?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Network monitoring dashboard"
                                class="h-full w-full rounded object-cover"
                            />
                        </div>
                    </div>
                </div>
            </section>

            <!-- Core Features Section -->
            <section id="features" class="w-full py-12 md:py-24 lg:py-32">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center">
                        <div class="space-y-2">
                            <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">Core Features</h2>
                            <p class="text-muted-foreground max-w-[700px] md:text-xl">
                                Our platform provides everything you need to manage your FTTH network infrastructure effectively.
                            </p>
                        </div>
                    </div>
                    <div class="mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-6 md:grid-cols-3 lg:gap-12">
                        <div class="flex flex-col items-center space-y-4 rounded-lg border p-6 shadow-sm">
                            <div class="bg-primary/10 rounded-full p-4">
                                <Activity class="text-primary h-8 w-8" />
                            </div>
                            <h3 class="text-xl font-bold">SNMP Monitoring</h3>
                            <p class="text-muted-foreground text-center">
                                Real-time monitoring of all network devices through SNMP. Track performance, detect issues, and receive alerts before
                                they affect your customers.
                            </p>
                        </div>
                        <div class="flex flex-col items-center space-y-4 rounded-lg border p-6 shadow-sm">
                            <div class="bg-primary/10 rounded-full p-4">
                                <TicketCheck class="text-primary h-8 w-8" />
                            </div>
                            <h3 class="text-xl font-bold">Ticketing System</h3>
                            <p class="text-muted-foreground text-center">
                                Streamlined ticket management for network issues. Assign tickets to technicians, track resolution progress, and
                                maintain service quality.
                            </p>
                        </div>
                        <div class="flex flex-col items-center space-y-4 rounded-lg border p-6 shadow-sm">
                            <div class="bg-primary/10 rounded-full p-4">
                                <Map class="text-primary h-8 w-8" />
                            </div>
                            <h3 class="text-xl font-bold">Site & Branch Management</h3>
                            <p class="text-muted-foreground text-center">
                                Organize your network infrastructure by sites and branches. Assign managers and technicians to specific locations for
                                efficient operations.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How It Works Section -->
            <section id="how-it-works" class="bg-muted w-full py-12 md:py-24 lg:py-32">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center">
                        <div class="space-y-2">
                            <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">How It Works</h2>
                            <p class="text-muted-foreground max-w-[700px] md:text-xl">
                                Our hierarchical management system ensures clear responsibilities and efficient operations.
                            </p>
                        </div>
                    </div>
                    <div class="mx-auto mt-12 max-w-5xl">
                        <div class="grid gap-8 md:grid-cols-2 lg:gap-12">
                            <div class="bg-background relative h-[300px] overflow-hidden rounded-lg border p-2">
                                <img
                                    src="https://plus.unsplash.com/premium_photo-1744345196324-94c618a49bc3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Network hierarchy diagram"
                                    class="h-full w-full rounded object-cover"
                                />
                            </div>
                            <div class="flex flex-col justify-center space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary/10 mt-1 rounded-full p-2">
                                        <Building2 class="text-primary h-5 w-5" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold">Branches</h3>
                                        <p class="text-muted-foreground">
                                            Each branch is managed by a dedicated Branch Manager who oversees all sites within their region.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary/10 mt-1 rounded-full p-2">
                                        <Map class="text-primary h-5 w-5" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold">Sites</h3>
                                        <p class="text-muted-foreground">
                                            Sites are attached to branches and are managed by assigned technicians responsible for maintenance.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary/10 mt-1 rounded-full p-2">
                                        <Users class="text-primary h-5 w-5" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold">Technicians</h3>
                                        <p class="text-muted-foreground">
                                            Technicians manage specific sites, handling device monitoring and ticket resolution.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="bg-primary/10 mt-1 rounded-full p-2">
                                        <Router class="text-primary h-5 w-5" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold">Devices/Nodes</h3>
                                        <p class="text-muted-foreground">
                                            Network devices are attached to sites and continuously monitored via SNMP protocols.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Benefits Section -->
            <section id="benefits" class="w-full py-12 md:py-24 lg:py-32">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center">
                        <div class="space-y-2">
                            <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">Why Choose Our Solution</h2>
                            <p class="text-muted-foreground max-w-[700px] md:text-xl">
                                Our platform offers unique advantages for FTTH network operators.
                            </p>
                        </div>
                    </div>
                    <div class="mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-6 md:grid-cols-2 lg:gap-12">
                        <div class="flex items-start space-x-4">
                            <CheckCircle2 class="text-primary mt-1 h-6 w-6" />
                            <div>
                                <h3 class="text-xl font-bold">Improved Network Reliability</h3>
                                <p class="text-muted-foreground">
                                    Proactive monitoring identifies and resolves issues before they affect service quality, reducing downtime by up to
                                    75%.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <CheckCircle2 class="text-primary mt-1 h-6 w-6" />
                            <div>
                                <h3 class="text-xl font-bold">Streamlined Operations</h3>
                                <p class="text-muted-foreground">
                                    Clear hierarchical structure ensures efficient management and accountability at every level of your organization.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <CheckCircle2 class="text-primary mt-1 h-6 w-6" />
                            <div>
                                <h3 class="text-xl font-bold">Faster Issue Resolution</h3>
                                <p class="text-muted-foreground">
                                    Integrated ticketing system reduces average resolution time by 60% through automated assignment and tracking.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <CheckCircle2 class="text-primary mt-1 h-6 w-6" />
                            <div>
                                <h3 class="text-xl font-bold">Comprehensive Reporting</h3>
                                <p class="text-muted-foreground">
                                    Detailed analytics and reports provide insights into network performance, ticket trends, and technician
                                    efficiency.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section id="contact" class="bg-primary text-primary-foreground w-full py-12 md:py-24 lg:py-32">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center">
                        <div class="space-y-2">
                            <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">Ready to Transform Your Network Management?</h2>
                            <p class="max-w-[700px] md:text-xl">
                                Join hundreds of FTTH providers who have improved their network reliability and operational efficiency.
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 min-[400px]:flex-row">
                            <button
                                class="ring-offset-background focus-visible:ring-ring bg-secondary text-secondary-foreground hover:bg-secondary/80 inline-flex h-11 items-center justify-center gap-1 rounded-md px-8 text-sm font-medium whitespace-nowrap transition-colors focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50"
                            >
                                Schedule a Demo <ArrowRight class="h-4 w-4" />
                            </button>
                            <button
                                class="ring-offset-background focus-visible:ring-ring border-primary-foreground hover:bg-primary-foreground hover:text-primary inline-flex h-11 items-center justify-center rounded-md border bg-transparent px-8 text-sm font-medium whitespace-nowrap transition-colors focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none disabled:pointer-events-none disabled:opacity-50"
                            >
                                Contact Sales
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="bg-background w-full border-t py-6 md:py-8">
            <div class="container mx-auto flex flex-col items-center justify-between gap-4 px-4 md:flex-row md:px-6">
                <div class="flex items-center gap-2">
                    <Network class="text-primary h-5 w-5" />
                    <span class="text-lg font-semibold">{{ appName }}</span>
                </div>
                <p class="text-muted-foreground text-center text-sm md:text-left">&copy; {{ appName }}. All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="#" class="text-muted-foreground hover:text-primary text-sm"> Privacy Policy </a>
                    <a href="#" class="text-muted-foreground hover:text-primary text-sm"> Terms of Service </a>
                </div>
            </div>
        </footer>
    </div>
</template>
