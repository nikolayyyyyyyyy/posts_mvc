<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    users:{
        type: Array,
        required: true
    }
});
</script>

<template>
    <Head title="Брой постове за потребители" />

    <AuthenticatedLayout>
        <section class="section-users">
            <div class="section__inner">
                <h1>Потребители и брой постове</h1>

                <div v-if="users" class="section__users">
                    <div v-for="user in users" class="section__user">
                        <p>Имейл на потребител: {{ user.email }}</p>
                        <p>Брой постове: {{ user.post_count }}</p>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
.section-users{
    margin-block: 32px;

    .section__inner{
        margin-inline: 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .section__users{
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .section__user{
        display: flex;
        align-items: center;
        gap: 4px;
    }
}
</style>