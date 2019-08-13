<template>
  <div>
    <div id="modal4" class="modal">
      <div class="modal-content">
        <h4>Deletar medicamento</h4>
        <p>Deseja realmente deletar o medicamento {{medicamento.nome}}?</p>
      </div>
      <div class="modal-footer">
        <a @click.prevent="deletar" class="btn-small waves-effect waves-light right red">Deletar</a>
      </div>
    </div>
  </div>
</template>

<script>
import M from "materialize-css";
import { pJwtFetch } from "../suporte/helpers-jwt";
let elem;
document.addEventListener("DOMContentLoaded", function() {
  elem = document.querySelector("#modal4");
  let instances = M.Modal.init(elem, {});
});
export default {
  name: "ModalDeletar",
  data() {
    return {
      medicamento: {}
    };
  },
  methods: {
    abrir: function(medicTemp) {
      this.medicamento = medicTemp;
      M.Modal.getInstance(elem).open();
    },
    deletar: function() {
      let opcoes = {
        url: this.apiurl + "medicamento-deletar/" + this.medicamento.id,
        method: "delete"
      };

      pJwtFetch(opcoes).then(mensagem => {
        M.toast({ html: mensagem });
        M.Modal.getInstance(elem).close();
        this.$emit("recarregar");
      });
    },
  },
  props: ["apiurl"]
};
</script>

<style>
</style>