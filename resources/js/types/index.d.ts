import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
    role: string;
}

export interface Nav {
    title: string;
    items: NavItem[];
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    flash: {
        success: string | null;
        message: string | null;
        error: string | null;
    };
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    role: {
        id: string;
        name: string;
        as: string;
    };
    role_id: string;
}

export interface PaginationType {
    current_page: number;
    data: any;
    first_page_url: string;
    form: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLinkType[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

export interface PaginationLinkType {
    url: string | null;
    label: string;
    active: boolean;
}

export interface ViewIndexData {
    params: {
        search: string | undefined;
        limit: number;
    };
    data: PaginationType;
    flash: {
        success: any;
    };
}

export interface UserEditForm {
    id: int;
    email: string;
    name: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
