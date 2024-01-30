<script setup lang="ts">
import { computed } from "vue";
import PersonInfo from "../components/PersonInfo.vue";
import { getClients } from "../api/clients";
import { ref } from "vue";
import { Person } from "../types";

const { datas } = await getClients();
const searchQuery = ref<string>("");

const filteredClients = computed(() => {
  // Filtrer les clients en fonction de la recherche
  return datas.filter((client: Person) =>
    client.nom.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

const handleSearch = () => {
  console.log("j'ai pas eu le temps");
};
</script>

<template>
  <div class="container">
    <div class="title__header">
      <h1>Recherche d'une fiche de contact</h1>
    </div>
    <div class="main__search flex flex-col flex-center">
      <div class="main__search--content">
        <div class="main__search--label">
          Renseigner un nom ou une dénomination
        </div>
        <div class="main__search--input">
          <input
            v-model="searchQuery"
            type="text"
            name="search"
            id="search"
            placeholder="Nom ou dénomination.."
          />
        </div>
        <div class="main__search--button flex">
          <button class="btn" @click="handleSearch">Rechercher</button>
        </div>
      </div>
    </div>

    <div class="main__result flex flex-col flex-center">
      <div class="main__result--table">
        <div class="table--header flex">
          <div class="table--header__item">Nom</div>
          <div class="table--header__item">Adresse</div>
          <div class="table--header__item">Ville</div>
          <div class="table--header__item">Téléphone</div>
        </div>
      </div>
    </div>
    <div class="main__result--content flex flex-col">
      <PersonInfo
        v-for="client in filteredClients"
        :person="client"
        :key="client.id"
      />
    </div>
  </div>
</template>
