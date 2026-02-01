<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
defineProps({
    posts:{
        type: Array,
        required: false
    },
    comments:{
        type: Array,
        required: false
    }
});

const post_id = useForm({
    id: ''
});
</script>

<template>
    <Head title="Последни коментари за страница" />

    <AuthenticatedLayout>
        <section class="section-last-comments-for-page">
            <div class="section__inner">
                <h1>Последни коментари за пост</h1>

                <form v-if="posts" @submit.prevent="post_id.post('/last-comments-for-page')" class="section__select-form bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <p>Избери пост</p>
                    <select v-model="post_id.id" class="section__select">
                        <option v-for="post in posts" :value="post.id">{{ post.title }}</option>
                    </select>
                    <InputError :message="post_id.errors.id"/>

                    <PrimaryButton type="submit" class="submit_btn">Търси</PrimaryButton>
                </form>

                <div v-if="comments" class="section__comments">
                    <div v-for="comment in comments" class="section__comment">
                        <p>Съдържание: {{ comment.body }}</p>
                        <p>Имейл на автор: {{ comment.user_email }}</p>
                        <p>Качен на: {{ comment.created_at }}</p>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-last-comments-for-page{
    margin-block: 32px;

    .section__comments{
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;

        .section__comment{
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
    }

    .section__select-form{
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 400px;
    }

    .submit_btn{
        display: flex;
        align-items: center;
        justify-content: center;
        align-self: center;
        width: 150px;
    }

    .section__select{
        width: 100%; 
        border-radius: 5px;
        border: 1px solid rgb(208, 207, 207);
    }

    .section__inner{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 24px;
    }
}
</style>