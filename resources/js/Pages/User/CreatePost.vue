<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const post = useForm({
    'title': '',
    'slug': '',
    'content': ''
});

const sendPost = async () => {
    post.post('/posts');
}
</script>

<template>
    <Head title="Пост" />

    <AuthenticatedLayout>
        <section class="section-create-post">
            <div class="section__inner">
                <h1 class="section__title">Създаване на нов пост</h1>

                <form @submit.prevent="sendPost" class="create-form">
                    <div class="form__input">
                        <label for="title">Заглавие</label>
                        <TextInput v-model="post.title" id="title" name="title"/>
                    </div>

                    <div class="form__input">
                        <label for="slug">Слъг</label>
                        <TextInput id="slug" name="slug" v-model="post.slug"/>
                    </div>

                    <div class="form__input">
                        <label for="content">Съдържание</label>
                        <TextInput id="content" name="content" v-model="post.content"/>
                    </div>

                    <PrimaryButton type="submit" class="add__btn">Добави</PrimaryButton> 
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-create-post{
    margin-block: 32px;

    .section__inner{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;

        .section__title{
            font-size: 18px;
            font-weight: 600;
        }

        .create-form{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            border: 1px solid rgb(205, 205, 205);
            border-radius: 10px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            padding: 12px;
            width: 350px;

            .form__input{
                display: flex;
                flex-direction: column;
                gap: 2px;
                width: 100%;
            }

            .add__btn{
                display: flex;
                justify-content: center;
                width: 150px;
            }
        }
    }
}
</style>