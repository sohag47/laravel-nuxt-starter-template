<script setup>
import Header from './components/layout/Header.vue'
import Footer from './components/layout/Footer.vue'
</script>

<template>
  <header>
    <Header />
  </header>
  <main>
    <router-view />
  </main>
  <footer>
    <Footer />
  </footer>
</template>

