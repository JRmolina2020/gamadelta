<template>
    <div>
        <section class="section">
            <store-facture></store-facture>
            <list-facture class="mt-3"></list-facture>
        </section>
    </div>
</template>
<script>
import ListFacture from "./ListFacture.vue";
import StoreFacture from "./StoreFacture.vue";

export default {
    components: {
        ListFacture,
        StoreFacture,
    },
};
</script>
