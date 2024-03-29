import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        users: [],
        roles: [],
        permissions: [],
        products: [],
        productstock: [],
        categories:[],
        clients: [],
        factures: [],
        typeSale: [],
        typeSale_one: [],
        details: [],
        bills: [],
        billstot: [],
        gain: [],
        clientot:[],
        gaintot: [],
        gaintotg: [],
        gaintotf: [],
        gaintotfg: [],
        Totcost:[],
        usertot: [],
        facUnique: [],
        descriptionF: [],
        company: [],
        money: [],
        moneySingle: [],
        income: [],
        incometot: [],
        status: false,
        urlusers: "/api/users",
        urlroles: "/api/roles",
        urlpermissions: "/api/permissions",
        urlproducts: "/api/products",
        urlproductstock: "/api/productstock",
        urlcategories: "/api/categories",
        urlclients: "/api/clients",
        urlfactures: "/api/factures",
        urltype_sale: "/api/type_sale",
        urltype_sale_one: "/api/type_sale_one",
        urldetails: "/api/details",
        urlfactureUnique: "/api/factureUnique",
        urldescriptionF: "/api/descriptionfac",
        urlbills: "/api/bills",
        urlbillstot: "/api/billsTot",
        urlgain: "/api/gain",
        urlclientot: "/api/clientot",
        urlgaintot: "/api/gainTot",
        urlgaintotg: "/api/gainTotg",
        urlgaintotf: "/api/gainTotf",
        urlgaintotfg: "/api/gainTotfg",
        urlTotcost: "/api/Totcost",
        urlusertot: "/api/userTot",
        urlcompany: "/api/company",
        urlcompanies: "/api/companies",
        urlmoney: "/api/money",
        urlmoneySingle: "api/moneySingle",
        urlincome: "api/income",
        urlincometot: "api/incometwo",
    },
    mutations: {
        Usermutations(state, item) {
            state.users = item;
        },
        Rolemutations(state, item) {
            state.roles = item;
        },
        Permissionmutations(state, item) {
            state.permissions = item;
        },
        Productmutations(state, item) {
            state.products = item;
        },
        Productstockmutations(state, item) {
            state.productstock = item;
        },
        Categoriemutations(state, item) {
            state.categories = item;
        },
        Clientmutations(state, item) {
            state.clients = item;
        },
        Facturemutations(state, item) {
            state.factures = item;
        },
        TypeSalemutations(state, item) {
            state.typeSale = item;
        },
        TypeSale_one_mutations(state, item) {
            state.typeSale_one = item;
        },
        FactureDetailmutations(state, item) {
            state.details = item;
        },
        FactureUniquemutations(state, item) {
            state.facUnique = item;
        },
        DescriptitonFmutations(state, item) {
            state.descriptionF = item;
        },
        Billmutations(state, item) {
            state.bills = item;
        },
        Billtotmutations(state, item) {
            state.billstot = item;
        },
        Gainmutations(state, item) {
            state.gain = item;
        },
   
        Clientotmutations(state, item) {
            state.clientot = item;
          console.log(item)
        },
        
        Gaintotmutations(state, item) {
            state.gaintot = item;
        },
        Gaintotgmutations(state, item) {
            state.gaintotg = item;
        },
        Gaintotfmutations(state, item) {
            state.gaintotf = item;
        },
        Gaintotfgmutations(state, item) {
            state.gaintotfg = item;
        },
        Totcostmutations(state, item) {
            state.Totcost = item;
        },
       
        Usertotmutations(state, item) {
            state.usertot = item;
        },
        Companymutations(state, item) {
            state.company = item;
        },
        Moneymutations(state, item) {
            state.money = item;
        },

        MoneySinglemutations(state, item) {
            state.moneySingle = item;
        },
        Incomemutations(state, item) {
            state.income = item;
        },
        IncomeTwomutations(state, item) {
            state.incometot = item;
        },
    },

    actions: {
        async Useractions({ commit, state }) {
            try {
                let response = await axios.get(state.urlusers);
                commit("Usermutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Roleactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlroles);
                commit("Rolemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Permissionactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlpermissions);
                commit("Permissionmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },

        async Productactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlproducts);
                commit("Productmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Productstockactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlproductstock);
                commit("Productstockmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Categorieactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlcategories);
                commit("Categoriemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Clientactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlclients);
                commit("Clientmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Factureactions({ commit, state }, date) {
            try {
                let response = await axios.get(`${state.urlfactures}/${date}`);
                commit("Facturemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async DescriptionFactions({ commit, state }, date) {
            try {
                let response = await axios.get(
                    `${state.urldescriptionF}/${date}`
                );
                commit("DescriptitonFmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async TypeSaleactions({ commit, state }, date) {
            try {
                let response = await axios.get(`${state.urltype_sale}/${date}`);
                commit("TypeSalemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        //type banca
        async TypeSale_one_actions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urltype_sale_one}/${obj.prop1}/${obj.prop2}`
                );
                commit("TypeSale_one_mutations", response.data);

                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async FactureDetailactions({ commit, state }, id) {
            try {
                let response = await axios.get(`${state.urldetails}/${id}`);
                commit("FactureDetailmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async FactureUniquections({ commit, state }, id) {
            try {
                let response = await axios.get(
                    `${state.urlfactureUnique}/${id}`
                );
                commit("FactureUniquemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },

        async Billactions({ commit, state }, date) {
            try {
                let response = await axios.get(`${state.urlbills}/${date}`);
                commit("Billmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Billtotactions({ commit, state }, date) {
            try {
                let response = await axios.get(`${state.urlbillstot}/${date}`);
                commit("Billtotmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Gainactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlgain}/${obj.prop1}/${obj.prop2}/${obj.type}`
                );
                commit("Gainmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Gaintotactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlgaintot}/${obj.prop1}/${obj.prop2}/${obj.type}`
                );
                commit("Gaintotmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Gaintotgactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlgaintotg}/${obj.prop1}/${obj.prop2}`
                );
                commit("Gaintotgmutations", response.data);
             
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async clientTotactions({ commit, state }, id) {
            try {
                let response = await axios.get(
                    `${state.urlclientot}/${id}`
                );
                commit("Clientotmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Gaintotfactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlgaintotf}/${obj.prop1}/${obj.prop2}/${obj.type}`
                );
                commit("Gaintotfmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
      
        async Gaintotfgactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlgaintotfg}/${obj.prop1}/${obj.prop2}`
                );
                commit("Gaintotfgmutations", response.data);
               
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Totcostactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlTotcost}`
                );
                commit("Totcostmutations", response.data);
                console.log(response.data)
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
      
      
        async Usertotactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlusertot}/${obj.prop1}/${obj.prop2}`
                );
                commit("Usertotmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Companyactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlcompany);
                commit("Companymutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Moneyactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlmoney);
                commit("Moneymutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async MoneySigleactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlmoneySingle);
                commit("MoneySinglemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Incomeactions({ commit, state }, date) {
            try {
                let response = await axios.get(`${state.urlincome}/${date}`);
                commit("Incomemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async IncomeTwoactions({ commit, state }, obj) {
            try {
                let response = await axios.get(
                    `${state.urlincometot}/${obj.prop1}/${obj.prop2}`
                );
                commit("IncomeTwomutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
    },
});
