const apiproduct = new Vue({
    el: '#apiproduct',
    data: {
        nombre : '',
        slug : '',
        div_slug_disponible : '',
        div_slug_class : '',
        input_slug_class : 'form-control',
        div_slug_aparecer : false,
        btn_terms : false,
        div_slug_div : false,
        activeColor : "",
        fontWeight : "bold"
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
        getProduct() {
            if (this.slug) {
                let url = '/api/product/'+this.slug;
                axios.get(url).then(response => {
                    this.div_slug_disponible = response.data;
                    /* if (this.div_slug_disponible === '¡Slug de este producto ya existe...!') {
                        this.div_slug_class = 'badge badge-pill badge-danger';
                        this.btn_terms = true;
                    } else {
                        this.div_slug_class = 'badge badge-pill badge-success';
                        this.btn_terms = false;
                    } */
                    if (this.div_slug_disponible === '¡Disponible...!') {
                        
                        this.div_slug_class = 'badge badge-pill badge-success';
                        this.input_slug_class = 'form-control is-valid';                       
                        this.activeColor = "green";
                        this.btn_terms = false;
                    } else {
                        
                        this.div_slug_class = 'badge badge-pill badge-danger';
                        this.input_slug_class = 'form-control is-invalid';
                        this.activeColor = "red";
                        this.btn_terms = true;
                    }
                    this.div_slug_aparecer = true;
                    
                })                
            } else {
                this.div_slug_class="badge badge-pill badge-info";
                this.div_slug_disponible="Tienes que ingresar un producto";
                this.btn_terms = true;
                this.div_slug_aparecer = true;
                this.input_slug_class = 'form-control is-warning';
                
            }
        },
        myFocus() {
            this.div_slug_aparecer = false;
            this.input_slug_class = 'form-control';
        }
    },
    mounted() {
        if (document.getElementById('editar').innerHTML) {
            this.nombre = document.getElementById('nombretemp').innerHTML;
            this.btn_terms = true;
        }
    },
});