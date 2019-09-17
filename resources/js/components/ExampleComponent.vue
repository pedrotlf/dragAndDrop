<template>
    <draggable class="list-group min-height" :list="tarefaNew" v-bind="{animation:400}" handle=".my-handle" tag="ul" @change="update($event)">

            <li class="list-group-item" v-for="(auxtarefa, index) in tarefaNew" :key="auxtarefa.ordem_apresentacao" :data-id="auxtarefa.ordem_apresentacao">
                <div v-if="auxtarefa.custo < 1000" >
                    <td class="d-flex justify-content-between">
                        <h4 class="col-5">{{ auxtarefa.nome_tarefa }}</h4>
						<p>Data limite: {{ auxtarefa.data_limite }}</p>
                        <small>R${{ auxtarefa.custo }}</small>
                    </td>
                    <td class="d-flex ">
                        <div class="btn-group ml-auto" role="group" aria-label="First group">
                            <a :href="'tarefa/' + auxtarefa.id + '/edit'"  ><button  class="btn btn-success btn-sm">Editar</button></a>
                            <a :href="'tarefa/' + auxtarefa.id + '/delete'" onClick="return confirm('Tem certeza que deseja deletar essa tarefa?')"><button  class="btn btn-danger btn-secondary btn-sm">Deletar</button></a>
							<i class="btn disabled btn-outline-info my-handle btn-sm">Arraste aqui!</i>
                        </div>
                    </td>
                </div>

                <div v-else>
                    <td class="d-flex justify-content-between">
                        <h4 class="col-5 text-danger">{{ auxtarefa.nome_tarefa }}</h4>
						<p class="text-danger">Data limite: {{ auxtarefa.data_limite }}</p>
                        <small class="text-danger">R${{ auxtarefa.custo }}</small>
                    </td>
                    <td class="d-flex">
                        <div class="btn-group mr-2 ml-auto" role="group" aria-label="First group">
                            <a :href="'tarefa/' + auxtarefa.id + '/edit'"  ><button  class="btn btn-success btn-sm">Editar</button></a>
                            <a :href="'tarefa/' + auxtarefa.id + '/delete'" onClick="return confirm('Tem certeza que deseja deletar essa tarefa?')"><button  class="btn btn-danger btn-secondary btn-sm">Deletar</button></a>
							<i class="btn disabled btn-outline-info my-handle btn-sm">Arraste aqui!</i>
                        </div>
                    </td>
                </div>

            </li>

    </draggable>
</template>

<script >
    import draggable from 'vuedraggable'

    export default {
        components:{
            draggable
        },

        props: ['tarefa'],

        data(){
            return{
                tarefaNew: this.tarefa,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content
            }
        },

        methods:{
            update(event){
				console.log(event.moved);

                axios.put('tarefa/trocaOrdem', {
                    antigo: event.moved.oldIndex,
					novo: event.moved.newIndex,
                })
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
