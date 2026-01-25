<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
defineProps({
    posts:{
        type: Array,
        required: false,
    },
    users:{
        type: Array,
        required: false
    }
});

const comment = useForm({
    'author_user_id': '',
    'post_id': '',
    'body': ''
});
</script>

<template>
    <Head title="Коментар" />

    <AuthenticatedLayout>
        <section class="section-create-comment">
            <div class="section__inner shell">
                <h1>Създаване на коментар</h1>

                <form @submit.prevent="comment.post('/comments')" class="create-form bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="form__input">
                        <label for="body">Съдържание</label>
                        <TextInput id="body" name="body" v-model="comment.body"/>
                        <InputError v-if="comment.errors.body" :message="comment.errors.body"/>
                    </div>

                    <div class="form__input">
                        <label for="body">Потребител</label>
                        <select v-model="comment.author_user_id" id="author_id">
                            <option v-for="(user, id) in users" :value="id + 1">{{ user.email }}</option>
                        </select>
                        <InputError v-if="comment.errors.author_user_id" :message="comment.errors.author_user_id"/>
                    </div>

                    <div class="form__input">
                        <label for="body">Пост</label>
                        <select v-model="comment.post_id" id="author_id">
                            <option v-for="(post, id) in posts" :value="id + 1">{{ post.slug }}</option>
                        </select>
                        <InputError v-if="comment.errors.post_id" :message="comment.errors.post_id"/>
                    </div>

                    <PrimaryButton type="submit" class="add__btn">Добави</PrimaryButton>
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-create-comment{
    margin-block: 32px;

    .section__inner{
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: center;

        .form__input{
            display: flex;
            flex-direction: column;
            width: 400px;

            select{
                border-radius: 5px;
                border: 1px solid rgb(208, 207, 207);
            }
        }

        .add__btn{
            display: flex;
            justify-content: center;
            width: 150px;
        }
    }

    .create-form{
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: 100%;
    }
}
</style>