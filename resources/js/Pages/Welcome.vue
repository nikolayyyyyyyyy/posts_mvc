<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <p>Hello to our app</p>
    
    <div class="section__links">
        <Link href="/login">Login</Link>
        <Link href="/register">Register</Link>
    </div>
</template>

<style scoped>
.section__links{
    display: flex;
    flex-direction: column;
    gap: 10px;
}
</style>