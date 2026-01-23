<script setup>
import NavLink from '@/Components/NavLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    user_name:{
        type: String,
        required: false
    }
})
</script>

<template>
    <Head title="Начало" />

    <AuthenticatedLayout>
        <template #header>
            <div class="section__user__actions">
                <NavLink href="/posts-create">
                    Създай нов пост
                </NavLink>
            </div>
        </template>
    </AuthenticatedLayout>
</template>