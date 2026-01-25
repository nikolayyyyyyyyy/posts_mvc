<script setup>
import NavLink from '@/Components/NavLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Начало" />

    <AuthenticatedLayout>
        <template #header>
            <div class="section__admin__actions">
                <NavLink href="/posts-category-list">Статии по слъг</NavLink>
            </div>
        </template>
    </AuthenticatedLayout>
</template>