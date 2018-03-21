var randomString = require('random-string');

function parseAttrs( el, obj ) {
    for( let o in obj ) {
        obj[o] = el.attr( 'data-'+o ) ? el.attr( 'data-'+o ) : obj[o];
    }
    return obj;
}

/**
 * Componente que chama o modal
 * 
 */
var midiaInput = new Vue({
    el: '.midiaInput',
    data: {
        title: 'Escolher foto',
        attrs: {},
        picked: [],
        id: randomString({ length: 16 }),        
    },
    updated: function () {
        resizeMidiaContent();
    },
    mounted: function(){
        var self = this;
        this.attrs = parseAttrs( $( this.$el ), {
            'min'  : 0,            
            'size' : 1,
            'ratio': '1:1',
        });
        this.attrs['id'] = this.id;
        window.emitter.on( 'pickedMidias', function( obj ) {
            self.picked = obj.picked;
            $( '#midiaModal' ).modal( 'hide' );
        });
    },
    methods: {
        open: function() {
            window.slimConfig.ratio = this.attrs.ratio;
            $( '#newMidiaInput' ).slim( window.slimConfig );
            window.emitter.emit( 'openModalMidia', this.attrs );
        },

        /**
         * Remove um item da lista
         * 
         */
        removeFromList: function (key) {
            this.picked.splice(key, 1);
        },
    }
});

/**
 * Componente do modal
 * 
 */
var midiaModal = new Vue({
    el: '#midiaModal',
    data: {
        title: 'Midia',
        attrs: false,
        picked: [],
        library: {},
        actualPage: 1,
        queryString: '',
        hasMore: true
    },
    updated: function () {
        resizeMidiaContent();
    },
    mounted: function () {
        var self = this;

        // Quando salvar o item
        window.emitter.on( 'slimSavedPicture', function( data ) {
            self.picked.push( data );
        });

        // Quando abrir o modal
        window.emitter.on( 'openModalMidia', function( attrs ) {
            self.attrs = attrs;
            console.log( self.attrs );
            $( '#midiaModal' ).modal({
                backdrop: 'static',
                keyboard: false
            });
            $( '#midiaModal' ).modal( 'show' );
        });

        // Obtem as midias inicias
        $.getJSON(Site.url + 'midia/get', function (data) {            
            try {
                data = data.data;
                self.library = data.data;

                // Seta os dados
                self.actualPage = data.page;

                // Verifica se existem mais paginas
                self.hasMore = ( data.total_pages != self.actualPage );
                               
            } catch (error) {
                swal( 'Erro!', 'Houve um erro ao obter os dados.', 'error' );
                self.libray = {};
            }
        });
    },
    methods: {

        /**
         * Remove um item da lista
         * 
         */
        removeFromList: function (key) {
            this.picked.splice(key, 1);
        },

        /**
         * Adiciona um item na lista
         * 
         */
        addToList: function (midia) {

            // Verifica se pode adicionar mais itens
            if ( this.picked.length < this.attrs.size ) {
                this.picked.push( midia );
            } else {
                swal( 'Erro', 'Você já escolheu o número máximo de imagens', 'error' );
            }
        },

        /**
         * Fecha o modal
         * 
         */
        closeModal: function() {
            $( '#midiaModal' ).modal( 'hide' );
            this.picked = [];
        },

        /**
         * Faz a pesquisa de uma imagem
         * 
         */
        search: function () {
            var self = this;
            var queryString = encodeURI(this.queryString.trim());

            // Obtem as midias inicias
            $.getJSON(Site.url + 'midia/get/1?query=' + queryString, function (data) {
                try {

                    // Seta os dados
                    data = data.data;
                    self.actualPage = data.page;

                    // Adiciona no objeto global
                    self.library = data.data;
                    
                    // Verifica se existem mais paginas
                    self.hasMore = ( data.total_pages != self.actualPage );
                } catch (error) {
                    swal('Erro!', 'Houve um erro ao obter os dados.', 'error');
                    self.libray = {};
                }
            });
        },

        /**
         * Carrega mais dados
         * 
         */
        loadMore: function () {
            var self = this;
            var nextPage = parseInt(self.actualPage) + 1;
            var queryString = encodeURI(this.queryString);

            // Obtem as midias inicias
            $.getJSON(Site.url + 'midia/get/' + nextPage + '?query=' + queryString, function (data) {
                try {

                    // Seta os dados
                    data = data.data;
                    self.actualPage = data.page;

                    // Pega o conteudo
                    var libContent = data.data;

                    // Adiciona no objeto global
                    for (var d in libContent) {
                        for (var ind in libContent[d]) {
                            if (!self.library[d]) self.library[d] = [];
                            self.library[d].push(libContent[d][ind]);
                        }
                    }

                    // Verifica se existem mais paginas
                    self.hasMore = ( data.total_pages != self.actualPage );
                } catch (error) {
                    swal('Erro!', 'Houve um erro ao obter os dados.', 'error');
                    self.libray = {};
                }
            });
        },

        /**
         * Seleciona as midias
         * 
         */
        pickMidias: function() {
            var obj = {
                id     : this.attrs.id,
                picked : this.picked,
            }
            window.emitter.emit( 'pickedMidias', obj );
        }
    }
});

// End of file