<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <p>Добре дошли в TopOffers България.</p>
    
    <div class="section__links">
        <Link href="/login">Login</Link>
        <Link href="/register">Register</Link>
    </div>
</template>

<style scoped lang="scss">
.section__links{
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>