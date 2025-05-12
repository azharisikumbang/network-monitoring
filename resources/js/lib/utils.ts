import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function getListProvinces() {
    return [
        { name: 'SUMATRA_UTARA', as: 'Sumatra Utara' },
        { name: 'SUMATRA_BARAT', as: 'Sumatra Barat' },
        { name: 'ACEH', as: 'Aceh' },
        { name: 'SUMATRA_SELATAN', as: 'Sumatra Selatan' },
        { name: 'JAMBI', as: 'Jambi' },
    ];
}
