<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({
    categories:{
        required: true
    }
})
const post = useForm({
    'title': '',
    'slug': '',
    'content': '',
    'post_image': '',
    'categories': []
});

function handle_click(id) {
    if(post.categories.find(i => i == id) != null){
        post.categories = post.categories.filter(i => i != id);
    } else {
        post.categories.push(id);
    }
}
</script>

<template>
    <Head title="Пост" />

    <AuthenticatedLayout>
        <section class="section-create-post">
            <div class="section__inner">
                <h1 class="section__title">Създаване на нов пост</h1>

                <form @submit.prevent="post.post('/posts')" class="create-form">
                    <div class="form__input">
                        <label for="title">Качи снимка</label>
                        <input type="file" @input="post.post_image = $event.target.files[0]" name="title"/>
                        <InputError v-if="post.errors.post_image" :message="post.errors.post_image"/>
                    </div>

                    <div class="form__input">
                        <label for="title">Заглавие</label>
                        <TextInput v-model="post.title" id="title" name="title"/>
                        <InputError v-if="post.errors.title" :message="post.errors.title"/>
                    </div>

                    <div class="form__input">
                        <label for="slug">Слъг</label>
                        <TextInput id="slug" name="slug" v-model="post.slug"/>
                        <InputError v-if="post.errors.slug" :message="post.errors.slug"/>
                    </div>

                    <div class="form__input">
                        <label for="content">Съдържание</label>
                        <TextInput id="content" name="content" v-model="post.content"/>
                        <InputError v-if="post.errors.content" :message="post.errors.content"/>
                    </div>

                    <div class="section__categories">
                        <div v-for="category in categories" class="section__category">
                            <Checkbox :checked="false" @click="handle_click(category.id)" :value="category.id" />
                            {{ category.name }}
                        </div>
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

    .section__categories{
        display: flex;
        flex-direction: column;
        gap: 2px;
        width: 100%;

        .section__category{
            display: flex;
            align-items: center;
            gap: 4px;
        }
    }
}
</style>