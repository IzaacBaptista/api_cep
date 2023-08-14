<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Bem vindo</div>

                    <!-- botão cadastrar endereço -->
                    <div class="card-body">
                        <button
                            class="btn btn-success"
                            @click="showCadastro = true"
                            v-if="!showEdicao"
                        >
                            Novo Endereco
                        </button>
                    </div>

                    <!-- campos para cadastro e edição de endereço -->
                    <div class="card-body" v-if="showCadastro || showEdicao">
                        <label for="">CEP</label>
                        <input
                            type="text"
                            name="cep"
                            class="form-control"
                            v-model="cep"
                            placeholder="Digite o CEP"
                        />
                        <label for="">Logradouro</label>
                        <input
                            type="text"
                            name="logradouro"
                            class="form-control"
                            v-model="logradouro"
                            placeholder="Digite o Logradouro"
                        />
                        <label for="">Bairro</label>
                        <input
                            type="text"
                            name="bairro"
                            class="form-control"
                            v-model="bairro"
                            placeholder="Digite o Bairro"
                        />
                        <label for="">Cidade</label>
                        <input
                            type="text"
                            name="cidade"
                            class="form-control"
                            v-model="cidade"
                            placeholder="Digite a Cidade"
                        />
                        <label for="">UF</label>
                        <input
                            type="text"
                            name="uf"
                            class="form-control"
                            v-model="uf"
                            placeholder="Digite a UF"
                        />
                        <button
                            class="btn btn-primary"
                            @click="
                                showCadastro
                                    ? createEndereco()
                                    : updateEndereco()
                            "
                        >
                            {{ showEdicao ? 'Atualizar' : 'Salvar' }}
                        </button>
                        
                        <button
                            class="btn btn-danger"
                            @click="
                                showCadastro
                                    ? (showCadastro = false)
                                    : (showEdicao = false)
                            "
                        >
                            Cancelar
                        </button>
                    </div>

                    <!-- Botão de Busca por CEP ou Logradouro -->
                    <div class="card-body">
                        <label for="">Buscar Endereço por CEP ou Logradouro</label>
                        <input
                            type="string"
                            class="form-control"
                            v-model="enderecoCepBusca"
                            placeholder="Digite o CEP do Endereço"
                        />
                        <button class="btn btn-primary" @click="buscarEnderecoPorCep">Buscar</button>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div
                                class="col-md-6"
                                v-for="endereco in enderecos"
                                :key="endereco.id"
                            >
                                <div class="card">
                                    <div class="card-header">Endereco</div>
                                    <div class="card-body">
                                        <p>CEP: {{ endereco.cep }}</p>
                                        <p>
                                            Logradouro:
                                            {{ endereco.logradouro }}
                                        </p>
                                        <p>Bairro: {{ endereco.bairro }}</p>
                                        <p>Cidade: {{ endereco.cidade }}</p>
                                        <p>UF: {{ endereco.uf }}</p>
                                        <div v-if="!showEdicao">
                                            <button
                                                class="btn btn-sm btn-danger"
                                                @click="
                                                    deleteEndereco(endereco.id)
                                                "
                                            >
                                                Deletar
                                            </button>
                                            <button
                                                class="btn btn-sm btn-secondary"
                                                @click="
                                                    editarEndereco(endereco)
                                                "
                                            >
                                                Editar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            enderecos: [],
            showCadastro: false,
            showEdicao: false,
            cep: "",
            logradouro: "",
            bairro: "",
            cidade: "",
            uf: "",
            enderecoId: null,
            enderecoIdToDelete: null
        };
    },
    mounted() {
        this.getEnderecos();
    },
    methods: {
        createEndereco() {
            //convertendo o cep para integer
            this.cep = parseInt(this.cep);
            axios
                .post("/api/endereco", {
                    cep: this.cep,
                    logradouro: this.logradouro,
                    bairro: this.bairro,
                    cidade: this.cidade,
                    uf: this.uf,
                })
                .then((response) => {
                    const novoEndereco = response.data;
                    if (novoEndereco) {
                        this.enderecos.push(novoEndereco);
                    }
                    this.clearFields();
                    this.showCadastro = false;
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    for (let key in error.response.data.errors) {
                        alert(error.response.data.errors[key][0]);
                    }
                });
        },
        updateEndereco() {
            axios
                .patch(`/api/endereco/${this.enderecoId}`, {
                    cep: this.cep,
                    logradouro: this.logradouro,
                    bairro: this.bairro,
                    cidade: this.cidade,
                    uf: this.uf,
                })
                .then((response) => {
                    const enderecoAtualizado = response.data;
                    if (enderecoAtualizado) {
                        const index = this.enderecos.findIndex(
                            (endereco) => endereco.id === enderecoAtualizado.id
                        );
                        if (index !== -1) {
                            this.enderecos[index] = enderecoAtualizado;
                        }
                    }
                    this.clearFields();
                    this.showEdicao = false;
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    for (let key in error.response.data.errors) {
                        alert(error.response.data.errors[key][0]);
                    }
                });
        },
        getEnderecos() {
            axios
                .get("/api/endereco")
                .then((response) => {
                    this.enderecos = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        buscarEnderecoPorCep() {
            axios
            .get("/api/endereco")
            .then((response) => {
                const matchedCeps = response.data.filter((endereco) => {
                    return endereco.cep == this.enderecoCepBusca;
                });

                const matchLogradouros = response.data.filter((endereco) => {
                    return endereco.logradouro == this.enderecoCepBusca;
                });
                
                if (matchedCeps.length > 0) {
                    // If a match is found in your local data, update the enderecos array
                    this.enderecos = matchedCeps;
                } else if (matchLogradouros.length > 0) {
                    this.enderecos = matchLogradouros;
                } else {
                 // If no match is found in your local data, try fetching from ViaCEP API
                 axios
                .get(`https://cdn.apicep.com/file/apicep/{this.enderecoCepBusca}.json`)
                .then((apiResponse) => {
                    console.log(typeof this.enderecoCepBusca);
                    // Handle the response from the ViaCEP API
                    const apiAddress = apiResponse.data;
                    if (!apiAddress.erro) {
                        // Address details fetched successfully from ViaCEP
                        // You can update your enderecos array or display the result differently
                        this.enderecos = [apiAddress];
                    } else {
                        // Address not found in local data and ViaCEP API
                        console.log("Endereço não encontrado");
                    }
                })
                .catch((error) => {
                    console.log("Erro ao buscar endereço:", error);
                });
            }
        })
        .catch((error) => {
            console.log("Erro ao buscar endereços:", error);
        });

        },
        editarEndereco(endereco) {
            this.enderecoId = endereco.id;
            this.showEdicao = true;
            this.cep = endereco.cep;
            this.logradouro = endereco.logradouro;
            this.bairro = endereco.bairro;
            this.cidade = endereco.cidade;
            this.uf = endereco.uf;
        },
        confirmDeleteEndereco() {
            if (this.enderecoIdToDelete) {
                axios
                    .delete(`/api/endereco/${this.enderecoIdToDelete}`)
                    .then((response) => {
                        this.enderecos = response.data;
                        $('#confirmDeleteModal').modal('hide');
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        deleteEndereco(id) {
            const confirmDelete = window.confirm(
                "Tem certeza que deseja deletar este endereço?"
            );
            if (confirmDelete) {
                axios
                    .delete(`/api/endereco/${id}`)
                    .then((response) => {
                        this.enderecos = response.data;
                        this.getEnderecos();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        clearFields() {
            this.cep = "";
            this.logradouro = "";
            this.bairro = "";
            this.cidade = "";
            this.uf = "";
        },
    },
};
</script>
