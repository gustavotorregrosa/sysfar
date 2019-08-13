<template>
    <div v-if="!estaLogado" class="espacado">
        <h4>Sistema de farmácia</h4>
    </div>
</template>

<script>
export default {
  name: "Apresentacao",
  props: ["estaLogado"]
};
</script>

<style scoped>
.espacado {
  margin-top: 7em;
}
</style>