<template>
    <div>
        <Modal-Resource
            v-on:clear="clear"
            sone="modal-dialog modal-xs"
            title="Registro de productos"
        >
            <section slot="titlebutton">Registrar productos</section>
            <section v-if="!form.id" slot="title">
                Registro de productos
            </section>
            <section v-else slot="title">Editar producto</section>
            <section slot="closebtn">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </section>
            <section slot="body">
                <form
                    method="POST"
                    @submit.enter.prevent="add(form.id, actions, urlproducts)"
                    autocomplete="off"
                    onKeyPress="if(event.keyCode == 13) event.returnValue = false;"
                >
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for>Nombre</label>
                                <input
                                    type="text"
                                    ref="name"
                                    v-validate="'required|max:30|min:3'"
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('nombre'),
                                    }"
                                    placeholder="Nombre"
                                    v-model="form.name"
                                    name="nombre"
                                />
                                <div
                                    v-if="submitted && errors.has('nombre')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("nombre") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for>Costo</label>
                                <currency-input
                                    v-validate="{
                                        required: true,
                                    }"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en',
                                    }"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('costo'),
                                    }"
                                    v-model.number="form.cost"
                                    name="costo"
                                />
                                <div
                                    v-if="submitted && errors.has('costo')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("costo") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for>Precio mayorista</label>
                                <currency-input
                                    v-validate="'|required|min_value:0'"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en',
                                    }"
                                    :class="{
                                        'is-invalid':
                                            submitted &&
                                            errors.has('precio mayorista'),
                                    }"
                                    v-model.number="form.price"
                                    name="precio de compra"
                                />
                                <div
                                    v-if="
                                        submitted &&
                                        errors.has('precio mayorista')
                                    "
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("precio mayorista") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for>Precio de venta</label>
                                <currency-input
                                    v-validate="{
                                        min_value: 0,
                                    }"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en',
                                    }"
                                    :class="{
                                        'is-invalid':
                                            submitted &&
                                            errors.has('precio de venta'),
                                    }"
                                    v-model.number="form.price_two"
                                    name="precio de venta"
                                />
                                <div
                                    v-if="
                                        submitted &&
                                        errors.has('precio de venta')
                                    "
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("precio de venta") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Categoria</label>
                                <v-select
                                    :options="categories"
                                    v-model="form.categorie_id"
                                    :reduce="(categories) => categories.id"
                                    label="name"
                                >
                                    <template #search="{ attributes, events }">
                                        <input
                                            class="vs__search"
                                            :required="!form.categorie_id"
                                            v-bind="attributes"
                                            v-on="events"
                                        />
                                    </template>
                                </v-select>
                            </div>
                        </div>
                    </div>

                    <button
                        v-if="!send"
                        class="btn btn-primary"
                        type="button"
                        disabled
                    >
                        <span
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"
                        ></span>
                        Loading...
                    </button>
                    <button
                        v-if="send"
                        :hidden="errors.any()"
                        type="submit"
                        v-bind:class="{
                            'btn btn-outline-primary ': !this.form.id,
                            'btn btn-outline-danger ': this.form.id,
                        }"
                    >
                        <i
                            v-bind:class="{
                                'fi fi-wink': !this.form.id,
                                'fi fi-like': this.form.id,
                            }"
                            aria-hidden="true"
                        ></i>
                    </button>
                </form>
                <br />
                <input v-model="barcodeValue" />
                <input v-model.number="numbtot" /><br />
                <div class="row">
                    <div v-for="item in numbtot" :key="item.id">
                        <div class="col-4">
                            <barcode v-bind:value="barcodeValue"> </barcode>
                        </div>
                    </div>
                </div>
            </section>
        </Modal-Resource>
    </div>
</template>
<script>
import { mapState } from "vuex";
import ModalResource from "../utilities/modal.vue";
import add from "../../mixins/add";
import VueBarcode from "vue-barcode";

export default {
    $_veeValidate: {
        validator: "new",
    },
    name: "add",
    components: {
        ModalResource,
        barcode: VueBarcode,
    },
    computed: {
        ...mapState(["urlproducts", "categories"]),
    },
    data() {
        return {
            barcodeValue: "",
            numbtot: 0,
            actions: "Productactions",
            submitted: true,
            send: 1,
            price_default: 1000,
            form: {
                id: null,
                name: "",
                price: 0,
                price_two: 0,
                cost: 0,
                categorie_id: null,
            },
        };
    },

    mixins: [add],
    created() {
        this.getCategorie();
    },
    methods: {
        getCategorie() {
            this.$store.dispatch("Categorieactions");
        },
        show(row) {
            this.barcodeValue = row.name;
            this.form.id = row.id;
            this.form.name = row.name;
            this.form.price = parseFloat(row.price);
            this.form.price_two = parseFloat(row.price_two);
            this.form.cost = parseFloat(row.cost);
            this.form.categorie_id = row.idc;
            $("#model").modal("show");
            this.send = true;
        },
        clear() {
            this.form.id = null;
            this.form.name = null;
            this.form.price = 0;
            this.form.price_two = 0;
            this.form.cost = 0;
            this.form.categorie_id = null;
            this.$validator.reset();
            this.send = true;
        },
    },
};
</script>
