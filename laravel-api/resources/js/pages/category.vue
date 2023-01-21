<script setup>
import List from '../components/category/List.vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import { ref } from 'vue';

const displayBasic = ref(false);

const openBasic = () => {
    displayBasic.value = true;
};
const closeBasic = () => {
    displayBasic.value = false;
};


</script>

<template>
    <h1>Category</h1>
    <List />
    <Button label="Primary" class="p-button-raised" />
    <Button label="Show" icon="pi pi-external-link" @click="openBasic" />
        <Dialog header="Header" v-model:visible="displayBasic" :breakpoints="{'960px': '75vw', '640px': '90vw'}" :style="{width: '50vw'}">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <template #footer>
                <Button label="No" icon="pi pi-times" @click="closeBasic" class="p-button-text"/>
                <Button label="Yes" icon="pi pi-check" @click="closeBasic" autofocus />
            </template>
        </Dialog>
</template>