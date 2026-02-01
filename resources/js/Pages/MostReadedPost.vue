<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    posts:{
        type: Array,
        required: true
    }
});
</script>

<template>
    <Head title="Най-посещаван пост" />

    <AuthenticatedLayout>
        <section class="section-most-readed-post">
            <div class="section__inner">
                <h1>Постове по посещаванност</h1>

                <form v-if="posts" class="section__posts-desc">
                    <div v-for="post in posts" class="section__post">
                        <p>Заглавие: {{ post.title }}</p>
                        <p>Слъг: {{ post.slug }}</p>
                        <p>Гледания: {{ post.count_likes }}</p>
                    </div>
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-most-readed-post{
    margin-block: 32px;

    .section__inner{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 24px;
    }

    .section__posts-desc{
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
        padding-inline: 20px;
    }
}
</style>