<script setup lang="ts">
import { Person } from "../types";
import { useRoute } from "vue-router";
import { ref } from "vue";
import router from "../router/index";
import { getClient, editClient } from "../api/clients";

const route = useRoute();
const id = route.params.id as string;

const { datas } = await getClient(id);
const clientRef = ref<Person>(datas);

const handleEdit = async (e: Event) => {
  e.preventDefault();
  const body = {
    nom: clientRef.value.nom,
    tel: clientRef.value.tel,
    email: clientRef.value.email,
    adresse: clientRef.value.adresse,
    code_postal: clientRef.value.code_postal,
    ville: clientRef.value.ville,
  };
  try {
    await editClient(id, body);
  } catch (error) {
    console.log(error);
  }

  router.push(`/client/${datas.id}`);
};

const cancelEdit = () => {
  router.push(`/client/${clientRef.value.id}`);
};
</script>

<template>
  <div class="container">
    <div class="info__header title__header flex flex-between">
      <h1>
        {{ datas.nom }}
      </h1>
      <button class="btn" @click="handleEdit">Editer</button>
    </div>
    <div class="info__content">
      <div class="info__content--header">INFORMATIONS</div>
      <div class="info__content--items">
        <div class="info__content--items-left">
          <div class="info__content--item edit">Prenom & NOM</div>
          <div class="info__content--item edit">Téléphone</div>
          <div class="info__content--item edit">Email</div>
          <div class="info__content--item edit">Adresse</div>
          <div class="info__content--item edit">Code postal</div>
          <div class="info__content--item edit">Ville</div>
        </div>
        <div class="info__content--items-right flex flex-col">
          <input v-model="datas.nom" class="info__content--edit" type="text" />
          <input v-model="datas.tel" class="info__content--edit" type="text" />
          <input
            v-model="datas.email"
            class="info__content--edit"
            type="text"
          />
          <input
            v-model="datas.adresse"
            class="info__content--edit"
            type="text"
          />
          <input
            v-model="datas.code_postal"
            class="info__content--edit"
            type="text"
          />
          <input
            v-model="datas.ville"
            class="info__content--edit"
            type="text"
          />
        </div>
      </div>
      <div class="info__cta flex">
        <div class="btn cancel" @click="cancelEdit">Annuler</div>
        <div class="btn save" @click="(e) => handleEdit(e)">Enregistrer</div>
      </div>
    </div>
  </div>
</template>
