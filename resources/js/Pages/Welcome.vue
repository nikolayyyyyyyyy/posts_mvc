<script setup lang="ts">
import NavLink from '@/Components/NavLink.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <GuestLayout>
        <Head title="Добре дошли" />

        <p>Добре дошли в TopOffers България.</p>
        
        <div class="section__links">
            <NavLink href="/login">Login</NavLink>
            <NavLink href="/register">Register</NavLink>
        </div>
    </GuestLayout>
</template>

<style scoped lang="scss">
.section__links{
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>