<template>
  <div>
    <div v-if="estaLogado" class="espacado">
      <a @click.prevent="abrirForm()" class="modal-trigger btn-floating btn-large waves-effect waves-light red btn-small pulse right">
        <i class="material-icons">add</i>
      </a>
      <table>
        <thead>
          <th>Nome</th>
          <th>Botões</th>
        </thead>
        <tbody>
          <tr v-bind:key="medicamento.id" v-for="(medicamento, index) in medicamentos">
            <td>{{medicamento.nome}}</td>
            <td>
              <a class="waves-effect waves-light btn-small red darken-1" @click.prevent="deletar(index)"><i class="material-icons">delete</i></a>
              &nbsp; &nbsp; &nbsp;
              <a class="waves-effect waves-light btn-small" @click.prevent="abrirForm(index)"><i class="material-icons">edit</i></a> 
            </td>
          </tr>
        </tbody>
      </table>
      <ValorTotal :valortotal="valortotal"/>

    </div>



    <FormSalvaMedicamento @recarregar="listaitens()" :apiurl="apiurl" ref="form"/>
    <ModalDeletar @recarregar="listaitens()" :apiurl="apiurl" ref="deletar"/>
  </div>
</template>

<script>
import { pJwtFetch } from "../suporte/helpers-jwt";
import FormSalvaMedicamento from "./FormSalvaMedicamento.vue";
import ModalDeletar from "./ModalDeletar.vue";
import ValorTotal from "./ValorTotal.vue";
export default {
  name: "ListagemItens",
  data() {
    return {
      medicamentos: []
    };
  },

  computed: {
    valortotal: function(){
      let valor = 0
      this.medicamentos.forEach(element => {
          valor += element.quantidade * parseFloat(element.valor)
      });
      return valor
      
    }
  },

  methods: {
    deletar: function(i){
      let medicamentoTemp = {}
      if(i !== null){
        medicamentoTemp = this.medicamentos[i]
      }
      this.$refs.deletar.abrir(medicamentoTemp)
    },
    abrirForm: function(i = null){
      let medicamentoTemp = {}
      if(i !== null){
        medicamentoTemp = this.medicamentos[i]
      }
      this.$refs.form.abrir(medicamentoTemp)
    },
    listaitens: function() {
      let opcoes = {
        url: this.apiurl + "lista-medicamentos",
        method: "get"
      };

      pJwtFetch(opcoes)
        .then(resultado => {
          this.medicamentos = resultado
        })
        .catch(codigo => {
          if (this.estaLogado) {
            this.$emit("abrirmodallogin");
          }
        });
    }
  },

  mounted: function() {
    this.listaitens();
  },
  props: ["estaLogado", "apiurl"],
  watch: {
    estaLogado: function(newVal, oldVal) {
      this.listaitens();
    }
  },
  components: {
    FormSalvaMedicamento,
    ModalDeletar,
    ValorTotal
  }
};
</script>


<style scoped>
.espacado {
  margin-top: 5em;
}
</style>

