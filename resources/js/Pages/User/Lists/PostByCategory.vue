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

function handle_submit(){
    if(category_slug.slug){
        category_slug.post(`/category/${category_slug.slug}/posts`)
    }
}
</script>

<template>
    <Head title="Пост по категория" />

    <AuthenticatedLayout>
        <section class="section-posts-by-category">
            <div class="section__inner shell">
                <h1 class="section__title">Търсене на постове по категория</h1>
                {{ posts }}
                <form @submit.prevent="handle_submit" class="section__search bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="form__input">
                        <label for="slug">Слъг</label>
                        <TextInput v-model="category_slug.slug"/>
                        <InputError :message="category_slug.errors.slug"/>
                    </div>

                    <PrimaryButton class="search__btn">Търси</PrimaryButton>
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-posts-by-category{
    margin-block: 32px;

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