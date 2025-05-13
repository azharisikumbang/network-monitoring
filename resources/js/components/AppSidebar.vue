<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type Nav, type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { AlertCircle, BookOpen, Download, House, LayoutGrid, MapPinned, Monitor, Router, ShieldCheck, Ticket, Upload, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: Nav = {
    title: 'Activities',
    items: [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutGrid,
            role: 'all',
        },
        {
            title: 'Monitor',
            href: '/monitor',
            icon: Monitor,
            role: 'all',
        },
        {
            title: 'Issues',
            href: '/issues',
            icon: AlertCircle,
            role: 'all',
        },
        {
            title: 'Ticket',
            href: '/tickets',
            icon: Ticket,
            role: 'all',
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
            role: 'all',
        },
        {
            title: 'Sites',
            href: '/sites',
            icon: House,
            role: 'all',
        },
        {
            title: 'Nodes / Devices',
            href: '/nodes',
            icon: Router,
            role: 'all',
        },
        {
            title: 'Users',
            href: '/users',
            icon: Users,
            role: 'administrator',
        },
        {
            title: 'Roles and Permissions',
            href: '/roles',
            icon: ShieldCheck,
            role: 'administrator',
        },
    ],
};

const reportsNavItems: Nav = {
    title: 'Report',
    items: [
        {
            title: 'Export',
            href: '/export',
            icon: Download,
            role: 'all',
        },
        {
            title: 'Import',
            href: '/import',
            icon: Upload,
            role: 'all',
        },
    ],
};

const footerNavItems: NavItem[] = [
    {
        title: 'Documentation',
        href: 'http://localhost/docs/',
        icon: BookOpen,
        role: 'all',
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('home')">
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
