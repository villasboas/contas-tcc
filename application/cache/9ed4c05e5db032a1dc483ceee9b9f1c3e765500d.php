<div class="row">
    <div class="col p-3">
        <div class="input-group">
            <input  type="text" 
                    class="form-control" 
                    v-model="queryString"
                    placeholder="Encontre suas midias..." 
                    aria-label="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-primary" 
                        v-on:click="search()"
                        type="button">Pesquisar!</button>
            </span>
        </div>
    </div>
</div><!-- formulario de pesquisa -->

<div class="row scroll-content">
    <div class="col-12" v-for="(value, key) in library">

        <div class="row">
            <div class="col-12">
                <div class="title-divider">
                    <span>{{ key }}</span>
                </div>
            </div>
        </div><!-- titulo -->

        <div class="row p-3">
            <div v-for="midia in value" 
                class="midia-content p-0 m-2" 
                v-bind:title="midia.name">
                <a v-bind:href="midia.path" data-lightbox="midias">
                    <img class="position-absolute" v-bind:src="midia.path">
                </a>
                <button v-on:click="addToList( midia )" class="btn btn-info btn-sm position-absolute" title="Usar imagem">
                    <i class="fa fa-check-square-o"></i>
                </button>
            </div>
        </div><!-- midias -->

    </div>

    <div v-if="hasMore" v-on:click="loadMore()" class="col-12 text-center pt-5">
        <button class="btn btn-primary">
            Carregar mais
        </button>
    </div>
</div>