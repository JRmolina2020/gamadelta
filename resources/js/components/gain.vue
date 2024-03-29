<template>
    <div>
        <div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12 mt-3">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="small-box bg-warning">
                            <div
                                v-for="item in Totcost"
                                :key="item.id"
                                class="inner"
                            >
                                <h3>{{ item.cost }}</h3>
                                <p>Total en inventario <strong>Neto</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fi fi-bar-chart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="small-box bg-info">
                            <div
                                v-for="item in Totcost"
                                :key="item.id"
                                class="inner"
                            >
                                <h3>${{ item.stock | currency }}</h3>
                                <p>
                                    Total en productos <strong>Costo.</strong>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fi fi-bar-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="small-box bg-info">
                            <div
                                v-for="item in gaintotg"
                                :key="item.id"
                                class="inner"
                            >
                                <h3>${{ item.gaintot | currency }}</h3>
                                <p>Total venta <strong>General</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fi fi-bar-chart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="small-box bg-success">
                            <div
                                v-for="item in gaintotfg"
                                :key="item.id"
                                class="inner"
                            >
                                <h3>${{ item.gain | currency }}</h3>
                                <p>Total ganancias <strong>General</strong></p>
                            </div>
                            <div class="icon">
                                <i class="fi fi-bar-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-primary" role="alert">
                    Resultado de ventas, ganancias y total individual
                </div>
                <div class="input-group">
                    <input
                        class="form-control form-control-sm"
                        type="date"
                        v-model="date"
                        placeholder=".form-control-sm"
                    />
                    <input
                        class="form-control form-control-sm"
                        type="date"
                        v-model="datetwo"
                        min=""
                        placeholder=".form-control-sm"
                    />
                    <!-- select categorie -->
                    <select v-model="form.type" v-if="this.datetwo != ''">
                        <option
                            v-for="item in categories"
                            :key="item.id"
                            :value="item.id"
                        >
                            {{ item.name }}
                        </option>
                    </select>

                    <button
                        v-if="this.datetwo != ''"
                        class="btn btn-outline-secondary btn-sm"
                        @click="getDate()"
                        type="button"
                    >
                        Buscar
                    </button>
                </div>

                <div
                    class="alert alert-dark mt-3"
                    v-for="(item, index) in gaintot"
                    :key="'b' + index"
                    role="alert"
                >
                    <p>TOTAL VENTA ${{ item.gaintot | currency }}</p>
                </div>

                <div
                    class="alert alert-dark mt-3"
                    v-for="(item, index) in gaintotf"
                    :key="'b' + index"
                    role="alert"
                >
                    <p v-can="'ver indicador'">
                        TOT GANANCIA ${{ item.gain | currency }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12 mt-3">
                <div class="alert alert-warning" role="alert">
                    Resultado de ventas por vendedor
                </div>
                <div class="input-group">
                    <input
                        class="form-control form-control-sm"
                        type="date"
                        v-model="dateuser"
                        placeholder=".form-control-sm"
                    />
                    <input
                        class="form-control form-control-sm"
                        type="date"
                        v-model="datetwouser"
                        min=""
                        placeholder=".form-control-sm"
                    />

                    <button
                        v-if="this.datetwouser != ''"
                        class="btn btn-outline-secondary btn-sm"
                        @click="getDateUser()"
                        type="button"
                    >
                        Buscar
                    </button>
                </div>

                <table class="table table-dark mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Vendedor</th>
                            <th scope="col">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in usertot" :key="'u' + index">
                            <td>{{ item.name }}</td>
                            <td>{{ item.tot | currency }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-primary mt-3" role="alert">
                    Productos agotados
                </div>
                <table class="table table-dark mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Categoria</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item, index) in productstock"
                            :key="'u' + index"
                        >
                            <td>{{ item.name }}</td>
                            <td>${{ item.cost | currency }}</td>
                            <td>{{ item.type }}</td>
                            <td>
                                <span class="badge bg-danger">Agotado</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-primary mt-3" role="alert">
                    Productos con más <strong>rotación</strong>
                </div>
                pronto..
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
import date_now from "../mixins/date";

export default {
    data() {
        return {
            form: {
                type: 1,
                type_payment: 1,
            },
            totalPages: 1,
            currentPage: 1,
            date: "",
            datetwo: "",
            dateuser: "",
            datetwouser: "",
            filters: {
                name: { value: "", keys: ["name"] },
            },
        };
    },
    computed: {
        ...mapState([
            "gain",
            "gaintot",
            "gaintotg",
            "gaintotf",
            "gaintotfg",
            "Totcost",
            "usertot",
            "categories",
            "productstock",
        ]),
    },
    created() {
        this.getList();
        this.getListUser();
        this.getCategorie();
    },
    methods: {
        getCategorie() {
            this.$store.dispatch("Categorieactions");
        },
        getList() {
            let obj = {
                prop1: date_now,
                prop2: date_now,
                type: this.form.type,
            };
            this.$store.dispatch("Gainactions", obj);
            this.$store.dispatch("Gaintotactions", obj);
            this.$store.dispatch("Gaintotgactions", obj);
            this.$store.dispatch("Gaintotfactions", obj);
            this.$store.dispatch("Gaintotfgactions", obj);
            this.$store.dispatch("Totcostactions", obj);
            this.$store.dispatch("Productstockactions", obj);
        },
        getListUser() {
            let obj = {
                prop1: date_now,
                prop2: date_now,
            };
            this.$store.dispatch("Usertotactions", obj);
        },

        getDate() {
            let obj = {
                prop1: this.date,
                prop2: this.datetwo,
                type: this.form.type,
            };
            this.$store.dispatch("Gainactions", obj);
            this.$store.dispatch("Gaintotactions", obj);
            this.$store.dispatch("Gaintotgactions", obj);
            this.$store.dispatch("Gaintotfactions", obj);
            this.$store.dispatch("Gaintotfgactions", obj);
        },

        getDateUser() {
            let obj = {
                prop1: this.dateuser,
                prop2: this.datetwouser,
            };
            this.$store.dispatch("Useractions", obj);
            this.$store.dispatch("Usertotactions", obj);
        },
    },
};
</script>
