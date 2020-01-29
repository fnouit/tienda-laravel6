const apicategory = new Vue({
    el: '#apicategory',
    data: {
        nombre : '',
        slug : '',
        div_slug_disponible : '',
        div_slug_class : 'badge badge-pill badge-danger',
        div_slug_aparecer : false,
        btn_terms : false,
        div_slug_div : false
    },
    computed: {
        generarSlug : function () {
            var char= {
            "á":"a","é":"e","í":"i","ó":"o","ú":"u",
            "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
            "ñ":"n","Ñ":"N"," ":"-","_":"-"
            }
            var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;

            this.slug = this.nombre.trim().replace(expr, function(e){
                return char[e]
            }).toLowerCase()

            return this.slug;

            // return this.nombre.trim().replace(/ /g,'-').toLowerCase();
        }
    },
    methods: {
        getCategory() {
            if (this.slug) {
                let url = '/api/category/'+this.slug;
                axios.get(url).then(response => {
                    this.div_slug_disponible = response.data;
                    if (this.div_slug_disponible === '¡Esta categoría ya existe...!') {
                        this.div_slug_class = 'badge badge-pill badge-danger';
                        this.btn_terms = true;
                    } else {
                        this.div_slug_class = 'badge badge-pill badge-success';
                        this.btn_terms = false;
                    }
                    this.div_slug_aparecer = true;
                    // console.log(this.div_slug_disponible);
                })                
            } else {
                this.div_slug_class="badge badge-pill badge-info";
                this.div_slug_disponible="Tienes que ingresar una categoría";
                this.btn_terms = true;
                this.div_slug_aparecer = true;
            }
        }
    },
    mounted() {
        if (document.getElementById('editar').innerHTML) {
            this.nombre = document.getElementById('nombretemp').innerHTML;
            this.btn_terms = true;
        }
    },
});