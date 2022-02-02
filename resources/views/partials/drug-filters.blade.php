<div class="shop-topbar-wrapper">
    <div class="totall-product"></div>
    <div class="shop-filter">
        <a class="shop-filter-active" href="#">
            <span class="fal fa-filter"></span>
            Filterët
            <i class="far fa-angle-down angle-down"></i>
            <i class="far fa-angle-up angle-up"></i>
        </a>
    </div>
</div>
<div class="product-filter-wrapper">
    <div class="row">
        <div class="col-width-16-2 custom-common-column">
            <div class="sidebar-widget sidebar-widget-height mb-20">
                <h4 class="sidebar-widget-title widget-title-font-dec">Kategoritë</h4>
                <div class="sidebar-categories-list">
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="/?category={{$category->id}}">{{$category->name}} <span>({{$category->drugs->count()}})</span></a></li>
                        @endforeach
                    </ul>
                </div>
                <br>
                <h4 class="sidebar-widget-title widget-title-font-dec">Filtrimet</h4>
                <div class="containerClass" >
                    <div class="containerClassOne">

                <h4 class="sidebar-widget-title widget-title-font-dec">Data e postimit</h4>
                <li><a href="/?searchQuery=Today">Filtro sipas ditës së sotshme</a></li>
                <li><a href="/?searchQuery=LastWeek">Filtro sipas javë së fundit</a> </li>
                <li><a href="/?searchQuery=lastSixHours">Filtro sipas ditës gjashtë orëve të fundit</a></li>
                <li><a href="/?searchQuery=lastYear">Filtro sipas vitit të fundit</a></li>
                    </div>
                <div class="containerClassTwo">
                    <h4 class="sidebar-widget-title widget-title-font-dec">Filtro sipas</h4>
                    <li><a href="/?searchQuery=DESC">Filtro sipas cmimit më të ulët</a></li>
                    <li><a href="/?searchQuery=ASC">Filtro sipas cmimit më të lartë</a></li>
                    <li><a href="/?searchQuery=byVisits">Filtro sipas shikueshmeris</a></li>

                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
