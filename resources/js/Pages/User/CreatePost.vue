<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({
    categories:{
        type: Array,
        required: true
    },
    tags:{
        type: Array,
        required:true
    }
})
const post = useForm({
    'title': '',
    'slug': '',
    'content': '',
    'post_image': '',
    'categories': [],
    'tags': []
});

function handle_category(id) {
    if(post.categories.find(c => c == id) != null){
        post.categories = post.categories.filter(c => c != id);
    } else {
        post.categories.push(id);
    }
}

function handle_tag(id){
    if(post.tags.find(t => t == id) != null){
        post.tags = post.tags.filter(t => t != id);
    } else {
        post.tags.push(id);
    }
}
</script>

<template>
    <Head title="Пост" />

    <AuthenticatedLayout>
        <section class="section-create-post">
            <div class="section__inner shell">
                <h1 class="section__title">Създаване на нов пост</h1>

                <form @submit.prevent="post.post('/posts')" class="create-form bg-white p-4 shadow sm:rounded-lg sm:p-8">
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
                
                    <PrimaryButton type="submit" class="add__btn">Добави</PrimaryButton>

                    <div class="section__categories">
                        <p>Категории:</p>
                        <div v-for="category in categories" class="section__category">
                            <Checkbox :checked="false" @click="handle_category(category.id)" :value="category.id" />
                            {{ category.name }}
                        </div>
                        <InputError v-if="post.errors.categories" :message="post.errors.categories"/>
                    </div>

                    <div class="section__categories">
                        <p>Тагове:</p>
                        <div v-for="tag in tags" class="section__category">
                            <Checkbox :checked="false" @click="handle_tag(tag.id)" :value="tag.id" />
                            {{ tag.name }}
                        </div>
                        <InputError v-if="post.errors.tags" :message="post.errors.tags"/>
                    </div>
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
            gap: 20px;
            justify-content: center;
            width: 100%;


            .form__input{
                display: flex;
                flex-direction: column;
                width: 400px;
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
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;

        .section__category{
            display: flex;
            align-items: center;
            gap: 4px;
        }
    }
}
</style>