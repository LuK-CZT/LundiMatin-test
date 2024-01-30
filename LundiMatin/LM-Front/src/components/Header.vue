<script setup lang="ts">
import { useRouter } from "vue-router";

const router = useRouter();

const redirectToHome = () => {
  router.push("/");
};
</script>

<template>
  <header>
    <div class="header">
      <div class="header__text" @click="redirectToHome">
        Rechercher un contact
      </div>
    </div>
  </header>
</template>
