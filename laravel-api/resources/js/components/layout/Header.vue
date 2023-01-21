<template>
   <nav>
    <div id="nav">
        <router-link :to="{ name: 'home' }">Home</router-link> |
        <router-link :to="{ name: 'category' }">About</router-link>
    </div>
   </nav>
</template>