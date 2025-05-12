<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { Nav, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<Nav>();

const page = usePage<SharedData>();

const checkMenuRole = (role: string) => {
    if (page.props.auth.user == null || page.props.auth.user == undefined) return false;
    if (role == 'all') return true;

    return page.props.auth.user.role == role;
};
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>{{ title }}</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
                <SidebarMenuButton as-child :is-active="item.href === page.url" :tooltip="item.title" v-if="checkMenuRole(item.role)">
                    <Link :href="item.href">
                        <component :is="item.icon" />
                        <span>{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
