<script setup lang="ts">
import { defineProps } from "vue";
import type { Person } from "../types";
import { useRouter } from "vue-router";
import loupe from "../assets/loupe.svg";

const props = defineProps<{
  person: Person;
}>();

const router = useRouter();

const redirectToPersonDetails = () => {
  const personId = props.person.id;
  router.push(`/client/${personId}`);
};
</script>

<template>
  <div class="person flex">
    <div class="person__name flex">
      <div class="person__icon">JD</div>
      {{ person.nom }}
    </div>
    <div class="person__info">{{ person.adresse }}</div>
    <div class="person__info">{{ person.ville }}</div>
    <div class="person__info">{{ person.tel }}</div>
    <div class="person__cta" @click="redirectToPersonDetails">
      <img :src="loupe" alt="loupe" /> Voir
    </div>
  </div>
</template>
