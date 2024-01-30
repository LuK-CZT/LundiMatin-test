<script setup lang="ts">
import { Person } from "../types";
import { useRoute } from "vue-router";
import router from "../router/index";
import { ref } from "vue";
import { getClient } from "../api/clients";

const route = useRoute();
const id = route.params.id as string;

const { datas } = await getClient(id);
const clientRef = ref<Person>(datas);
const redirectToEditMode = () => {
  router.push(`/client/${clientRef.value.id}/edit`);
};
</script>

<template>
  <div class="container">
    <div class="info__header title__header flex flex-between">
      <h1>
        {{ clientRef.nom }}
      </h1>
      <button class="btn" @click="redirectToEditMode">Editer</button>
    </div>
    <div class="info__content">
      <div class="info__content--header">INFORMATIONS</div>
      <div class="info__content--items">
        <div class="info__content--items-left">
          <div class="info__content--item">Prenom & NOM</div>
          <div class="info__content--item">Téléphone</div>
          <div class="info__content--item">Email</div>
          <div class="info__content--item">Adresse</div>
        </div>
        <div class="info__content--items-right">
          <div class="info__content--item">{{ clientRef.nom }}</div>
          <div class="info__content--item">{{ clientRef.tel }}</div>
          <div class="info__content--item">{{ clientRef.email }}</div>
          <div class="info__content--item">{{ clientRef.adresse }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
