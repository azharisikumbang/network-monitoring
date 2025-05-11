<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type Nav, type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { AlertCircle, BookOpen, House, LayoutGrid, MapPinned, Monitor, Router, ShieldCheck, Ticket, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: Nav = {
    title: 'Activities',
    items: [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutGrid,
        },
        {
            title: 'Monitor',
            href: '/monitor',
            icon: Monitor,
        },
        {
            title: 'Issues',
            href: '/issues',
            icon: AlertCircle,
        },
        {
            title: 'Ticket',
            href: '/tickets',
            icon: Ticket,
        },
    ],
};

const masterDataNavItems: Nav = {
    title: 'Master',
    items: [
        {
            title: 'Branches',
            href: '/branches',
            icon: MapPinned,
        },
        {
            title: 'Sites',
            href: '/sites',
            icon: House,
        },
        {
            title: 'Nodes / Devices',
            href: '/nodes',
            icon: Router,
        },
        {
            title: 'users',
            href: '/users',
            icon: Users,
        },
        {
            title: 'roles',
            href: '/roles',
            icon: ShieldCheck,
        },
    ],
};

const reportsNavItems: Nav = {
    title: 'Report',
    items: [
        {
            title: 'Export',
            href: '/export',
            icon: MapPinned,
        },
        {
            title: 'Import',
            href: '/import',
            icon: MapPinned,
        },
    ],
};

const footerNavItems: NavItem[] = [
    {
        title: 'Documentation',
        href: 'http://localhost/docs/',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems.items" :title="mainNavItems.title" />
            <NavMain :items="masterDataNavItems.items" :title="masterDataNavItems.title" />
            <NavMain :items="reportsNavItems.items" :title="reportsNavItems.title" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
