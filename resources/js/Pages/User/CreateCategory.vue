<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const category = useForm({
    'name': '',
    'slug': ''
});
</script>

<template>
    <Head title="Категория" />

    <AuthenticatedLayout>
        <section class="section-create-category">
            <div class="section__inner">
                <h1 class="section__title">Създаване на нова категория</h1>

                <form @submit.prevent="category.post('/categories')" class="create-form bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="form__input">
                        <label for="title">Име</label>
                        <TextInput v-model="category.name"/>
                        <InputError v-if="category.errors.name" :message="category.errors.name"/>
                    </div>

                    <div class="form__input">
                        <label for="slug">Слъг</label>
                        <TextInput v-model="category.slug"/>
                        <InputError v-if="category.errors.slug" :message="category.errors.slug"/>
                    </div>

                    <PrimaryButton type="submit" class="add__btn">Добави</PrimaryButton> 
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-create-category{
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
            width: 400px;

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