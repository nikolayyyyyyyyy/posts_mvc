<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const tag = useForm({
    'name': '',
    'slug': ''
});
</script>

<template>
    <Head title="Тагове" />

    <AuthenticatedLayout>
        <section class="section-create-tag">
            <div class="section__inner">
                <h1>Създаване на таг</h1>

                <form @submit.prevent="tag.post('/tags')" class="create-form">
                    <div class="form__input">
                        <label for="title">Име</label>
                        <TextInput v-model="tag.name"/>
                        <InputError v-if="tag.errors.name" :message="tag.errors.name"/>
                    </div>

                    <div class="form__input">
                        <label for="slug">Слъг</label>
                        <TextInput v-model="tag.slug"/>
                        <InputError v-if="tag.errors.slug" :message="tag.errors.slug"/>
                    </div>

                    <PrimaryButton type="submit" class="add__btn">Добави</PrimaryButton> 
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-create-tag{
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