<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">
                                        <p class="mb-1 pt-2 text-bold">Built by developers</p>
                                        <h5 class="font-weight-bolder">Soft UI Dashboard</h5>
                                        <p class="mb-5">From colors, cards, typography to complex elements, you will
                                            find
                                            the full documentation.</p>
                                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                            href="javascript:;">
                                            Read More
                                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                                    <div class="bg-gradient-primary border-radius-lg h-100">
                                        <img src="@/assets/img/shapes/waves-white.svg"
                                            class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                        <div
                                            class="position-relative d-flex align-items-center justify-content-center h-100">
                                            <img class="w-100 position-relative z-index-2 pt-4"
                                                src="@/assets/img/illustrations/rocket-white.png" alt="rocket">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim do SVG do cartão de credito-->
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Pedidos Pendentes
                                            </p>
                                            <h5 class="font-weight-bolder mb-0">
                                                5
                                                <!--<span class="text-success text-sm font-weight-bolder">+55%</span>-->
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Envios Pendentes
                                            </p>
                                            <h5 class="font-weight-bolder mb-0">
                                                2
                                                <!--<span class="text-success text-sm font-weight-bolder">+55%</span>-->
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Pedidos Pendentes
                                            </p>
                                            <h5 class="font-weight-bolder mb-0">
                                                5
                                                <!--<span class="text-success text-sm font-weight-bolder">+55%</span>-->
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="col-md-10">
                            <h6 class="mb-0">Recentes</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <Tabela />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mt-4">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-10">
                                <h6 class="mb-0">Contactos</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <Tabela :vcards="vcards" />
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-4 mt-4">
                <div class="card h-100 mb-4">
                    <div class="card-header">
                        <h3 id="formAddContactTitle" class="font-weight-bolder text-info text-gradient addContactTitle">
                            Adicionar Contacto</h3>
                    </div>
                    <div class="card-body">
                        <form role="form">
                            <label>Name</label>
                            <div class="mb-3">
                                <input type="name" class="form-control" placeholder="Name" aria-label="Name"
                                    aria-describedby="email-addon">
                            </div>
                            <label>Telephone Number</label>
                            <div class="mb-3">
                                <input type="tlm" class="form-control" placeholder="Telephone Number"
                                    aria-label="Telephone Number">
                            </div>
                            <div class="text-center">
                                <button id="formAddContactButton" type="button"
                                    class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { ref, onMounted } from "vue"
import Tabela from "@/components/tables/table.vue"
import axios from 'axios'

const vcards = ref([])

const fetchVcards = async () => {
    axios.get('vcards').then((response) => {
        vcards.value = response.data
    }).catch((error) => {
        console.log(error)
    })
}

const refresh = () => {
    fetchVcards()
}

onMounted(refresh)

</script>
