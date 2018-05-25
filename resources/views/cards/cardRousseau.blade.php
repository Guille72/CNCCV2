<div class="hide-on-large-only" style="margin-top: 200px"></div>
<div class="marginTop"></div>

<div class="container">
    <h2 class="align colortext">Chez Rousseau</h2>

    <div class="col s8 m8 l8 offset-l2 offset-s2 offset-m2">
        <br>
    </div>
    <div class="divBorder1"
         style="border: 3px solid #EA0B4D;padding-bottom: 20px !important; padding-top: 5px !important;">
        <div class="row" style="margin-top: 20px !important;">
            <div class="col s4 m4 l4">
                <a class="" href="#one"><img class="responsive-img materialboxed"
                                             src="{{asset('img/IMG_2739.JPG')}}"></a>
            </div>
            <div class="col s4 m4 l4">
                <a class="" href="#two"><img class="responsive-img materialboxed"
                                             src="{{asset('img/IMG_1769.JPG')}}"></a>
            </div>
            <div class="col s4 m4 l4">
                <a class="" href="#three"><img class="responsive-img materialboxed" src="{{asset('img/IMG_1757.JPG')}}"></a>
            </div>
        </div>

        <div style="margin-top: 20px !important;" class="row">
            <div class="col s6 m6 l6">
                <a class="" href="#four"><img class="responsive-img materialboxed"
                                              src="{{asset('img/IMG_1760_2.jpg.png')}}"></a>
            </div>
            <div class="col s6 m6 l6">
                <a class="" href="#five"><img style="width: 100% !important;" class="materialboxed"
                                              src="{{asset('img/both2.png')}}"></a>
            </div>
        </div>
    </div>

    <div style="height: 600px" class="marginTop2">
        <div class="row">
            <div class="col m9 s12 offset-m3">
                <div class="card displayNone divBorder1" id="animInfo1">
                    <div class="card-content">
                        <span class="card-title">Équipements </span>
                        <i class="material-icons">wifi</i> Wifi <br>
                        <i class="material-icons">tv</i> Télévision <br>
                        <i class="material-icons">computer</i> Espace de travail pour ordinateur portable <br>
                        <i class="material-icons">local_dining</i> Cuisine tout équipée <br>
                        <i class="material-icons">time_to_leave</i> Place de parking dans la rue <br>
                        <i class="material-icons">directions_bike</i> Garage sur place pour vélo et moto
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col m9 s12">
                <div class="card displayNone divBorder1" id="animInfo2">
                    <div class="card-content">
                        <span class="card-title">À quelques pas..</span>
                        <i class="material-icons">location_on</i> Circuit des 24h du Mans / Centre des expositions <br>
                        <i class="material-icons">location_on</i> Bar / tabac <br>
                        <i class="material-icons">location_on</i> Boulangerie <br>
                        <i class="material-icons">location_on</i> Leclerc Drive / ALDI / Carrefour / Centre commerciale
                        <br>
                        <i class="material-icons">location_on</i> Pizzeria / Restaurant Marocain
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2670.9009980940655!2d0.20100161608140754!3d47.97697237921103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e28f1ebc58718b%3A0x7f35452087f12043!2s193+Boulevard+Jean+Jacques+Rousseau%2C+72100+Le+Mans!5e0!3m2!1sfr!2sfr!4v1524660292178"
        width="100% !important;" frameborder="0" style="border:0; height: 250px !important;" allowfullscreen></iframe>

<script>
    window.onscroll = function () {
        serieAnim()
    };


    function serieAnim() {

        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {

            document.getElementById("animInfo1").classList.remove("displayNone");
            document.getElementById("animInfo2").classList.remove("displayNone");
            document.getElementById("animInfo1").classList.add("animInfo1");
            document.getElementById("animInfo2").classList.add("animInfo2");
        }
    }


    M.AutoInit();

    $('.carousel.carousel-slider').carousel({});
</script>








