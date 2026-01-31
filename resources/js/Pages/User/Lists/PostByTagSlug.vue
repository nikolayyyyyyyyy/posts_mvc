<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
defineProps({
    posts:{
        type: Array,
        required: false
    }
});
const tag_slug = useForm({
    slug: ''
});
</script>

<template>
    <Head title="Пост по таг слъг" />

    <AuthenticatedLayout>
        <section class="section-tags-by-category">
            <div class="section__inner">
                <h1>Постове по таг.</h1>

                <form @submit.prevent="tag_slug.post(`/tag/${tag_slug.slug}/posts`)" class="section__search bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="form__input">
                        <label for="slug">Слъг</label>
                        <TextInput v-model="tag_slug.slug"/>
                        <InputError :message="tag_slug.errors.slug"/>
                    </div>

                    <PrimaryButton class="submit_btn">Търси</PrimaryButton>
                </form>

                <div v-if="posts" class="section__posts">
                    <div v-for="post in posts" class="section post">
                        <p>Гледания: {{ post.count_likes }}</p>
                        <p>Заглавие: {{ post.title }}</p>
                        <p>Слъг: {{ post.slug }}</p>
                        <p>Категории: {{ post.categories }}</p>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-tags-by-category{
    margin-block: 32px;

    .section__posts{
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
        padding-inline: 20px;
    }

    .section__inner{
        display: flex;
        flex-direction: column;
        gap: 24px;
        align-items: center;
    }

    .submit_btn{
        display: flex;
        align-items: center;
        justify-content: center;
        align-self: center;
        width: 150px;
    }

    .form__input{
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .section__search{
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: 400px;
    }
}
</style>