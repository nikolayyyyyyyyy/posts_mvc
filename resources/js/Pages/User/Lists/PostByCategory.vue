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

const category_slug = useForm({
    slug: ''
});
</script>

<template>
    <Head title="Пост по категория" />

    <AuthenticatedLayout>
        <section class="section-posts-by-category">
            <div class="section__inner shell">
                <h1 class="section__title">Постове по категория</h1>

                <form @submit.prevent="category_slug.post(`/posts-category`)" class="section__search bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="form__input">
                        <label for="slug">Слъг</label>
                        <TextInput v-model="category_slug.slug"/>
                        <InputError :message="category_slug.errors.slug"/>
                    </div>

                    <PrimaryButton class="search__btn">Търси</PrimaryButton>
                </form>

                <div v-if="posts" class="section__posts">
                    <div v-for="post in posts" class="section__post">
                        <p>Гледания: {{ post.count_likes }}</p>
                        <p>Заглавие: {{ post.title }}</p>
                        <p>Слъг: {{ post.slug }}</p>
                        <div class="section__categories">
                            <p>Kатегории:</p>

                            <div class="section__categories__list">
                                <div v-for="category in post.categories" class="section__category">
                                    {{ category.name }}
                                </div>
                            </div>
                        </div>
                        <div class="section__tags">
                            <p>Тагове:</p>

                            <div class="section__tags__list">
                                <div v-for="tag in post.tags" class="section__tag">
                                    {{ tag.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-posts-by-category{
    margin-block: 32px;

    .section__posts{
        display: flex;
        flex-direction: column;
        gap: 10px;

        .section__post{
            padding: 10px;
            border-radius: 10px;
            background-color: aquamarine;
        }
    }

    .section__tags,
    .section__categories{
        display: flex;
        gap: 12px;

        .section__tags__list,
        .section__categories__list{
            display: flex;
            align-items: center;
            gap: 10px;
        }
    }    

    .section__post{
        display: flex;
        flex-direction: column;
    }

    .section__search{
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 400px;
        margin: 0 auto;

        .form__input{
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .search__btn{
            width: 200px;
            align-self: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }

    .section__inner{
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .section__title{
        text-align: center;
    }
}
</style>