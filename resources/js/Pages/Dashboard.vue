<script setup>
import NavLink from '@/Components/NavLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    user_name:{
        type: String,
        required: false
    },
    posts:{
        type: Array,
        required: true
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
        <div class="section__posts shell">
            <div v-for="post in posts" class="section__post">
                aa
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section__posts{
    margin-block: 32px;
    
}
</style>