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
                <NavLink href="/posts-category">Постове по слъг<br>- категория -</NavLink>
                <NavLink href="/posts-tag">Постове по слъг<br>- тагове -</NavLink>
                <NavLink href="/posts-author">Постове по<br>- автор -</NavLink>
                <NavLink href="/most-readed-post">Най-посещаван<br>- пост -</NavLink>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section__admin__actions{
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>