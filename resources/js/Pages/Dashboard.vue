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
                <NavLink class="link" href="/posts-category">Постове по слъг<br>- категория -</NavLink>
                <NavLink class="link" href="/posts-tag">Постове по слъг<br>- тагове -</NavLink>
                <NavLink class="link" href="/posts-author">Постове по<br>- автор -</NavLink>
                <NavLink class="link" href="/most-readed-post">Най-посещаван<br>- пост -</NavLink>
                <NavLink class="link" href="/last-comments-for-page">Последни коментари<br>- за пост -</NavLink>
                <NavLink class="link" href="/count-posts-user">Брой постове <br>- за потребител -</NavLink>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section__admin__actions{
    display: flex;
    align-items: center;
    gap: 10px;

    .link{
        text-align: center;
    }
}
</style>