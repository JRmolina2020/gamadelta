<template>
    <div>
        <div class="alert alert-primary" role="alert">
            Conoce como fue vendido cada producto
        </div>
        <div class="table-responsive">
            <div class="input-group mt-3">
                <input
                    class="form-control form-control-sm"
                    type="date"
                    v-model="date"
                />
                <button
                    v-if="this.date != ''"
                    class="btn btn-outline-secondary btn-sm"
                    @click="getListDate()"
                    type="button"
                >
                    Buscar
                </button>
            </div>
            <VTable
                :data="descriptionF"
                :page-size="20"
                :currentPage.sync="currentPage"
                @totalPagesChanged="totalPages = $event"
                class="table table-borderless mt-3"
            >
                <template #head>
                    <tr>
                        <VTh sortKey="id">Fac</VTh>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Fecha</th>
                    </tr>
                </template>
                <template #body="{ rows }">
                    <tr v-for="(row, index) in rows" :key="index">
                        <td>{{ row.id }}</td>
                        <td>{{ row.product }}</td>
                        <td>{{ row.quantity }}</td>
                        <td class="table-primary">
                            ${{ row.price | currency }}
                        </td>
                        <td>${{ row.tot | currency }}</td>
                        <td>{{ row.created_at }}</td>
                    </tr>
                </template>
            </VTable>
        </div>
        <div class="text-xs-center">
            <VTPagination
                :currentPage.sync="currentPage"
                :total-pages="totalPages"
                :boundary-links="true"
            />
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
import date_now from "../mixins/date";
export default {
    data() {
        return {
            totalPages: 1,
            currentPage: 1,
            date: "",
        };
    },

    computed: {
        ...mapState(["descriptionF"]),
    },
    created() {
        this.getList();
    },

    methods: {
        getList() {
            this.$store.dispatch("DescriptionFactions", date_now);
        },
        getListDate() {
            this.$store.dispatch("DescriptionFactions", this.date);
        },
    },
};
</script>
