<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
defineProps({
    users:{
        type: Array,
        required: true
    }
});

const user_id = useForm({
    'id': ''
});
</script>

<template>
    <Head title="Постове по автор" />

    <AuthenticatedLayout>
        <section class="posts-by-users">
            <div class="section__inner">
                <h1>Постове по автори</h1>

                <form @submit.prevent="user_id.post(`/user/`)" class="section__search bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="form__input">
                        <label for="slug">Имейл</label>

                        <select v-model="user_id.id">
                            <option v-for="user in users" :value="user.id">{{ user.email }}</option>
                        </select>
                        
                        <InputError :message="user_id.errors.id"/>
                    </div>
                    
                    <PrimaryButton class="submit_btn">Търси</PrimaryButton>
                </form>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.posts-by-users{
    margin-block: 32px;

    .section__inner{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 24px;
    }

    .section__search{
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

    .form__input{
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    select{
        border-radius: 5px;
    }
}
</style>