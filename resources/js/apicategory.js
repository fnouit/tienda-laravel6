const apicategory = new Vue({
    el: '#apicategory',
    data: {
        nombre : '',
        slug : '',
        div_slug_disponible : '',
        div_slug_class : 'badge badge-danger',
        div_slug_aparecer : false,
        btn_terms : false
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
            let url = 'api/category/'+this.slug;
            axios.get(url).then(response => {
                this.div_slug_disponible = response.data;
                if (this.div_slug_disponible === '¡Este slug ya existe...!') {
                    this.div_slug_class = 'badge badge-danger';
                    this.btn_terms = true;
                } else {
                    this.div_slug_class = 'badge badge-success';
                    this.btn_terms = false;
                }
                this.div_slug_aparecer = true;
                // console.log(this.div_slug_disponible);
            })
        }
    },
});