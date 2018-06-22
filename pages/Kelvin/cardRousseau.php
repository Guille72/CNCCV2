
<div style="height: 500px; border-bottom: 0.5px solid black">

    <div class="carousel col m12 s12 l12">
        <a class="carousel-item" href="#one"><img class="responsive-img materialboxed" src="../lib/img/IMG_2739.JPG"></a>
        <a class="carousel-item" href="#two"><img class="responsive-img materialboxed" src="../lib/img/IMG_1769.JPG"></a>
        <a class="carousel-item" href="#three"><img class="responsive-img materialboxed" src="../lib/img/IMG_1760_2.jpg.png"></a>
        <a class="carousel-item" href="#four"><img class="responsive-img materialboxed" src="../lib/img/IMG_1757.JPG"></a>
        <a class="carousel-item" href="#five"><img class="responsive-img materialboxed" src="../lib/img/both2.png"></a>
    </div>



</div>
<div style="height: 600px" class="marginTop2" >

    <div class="container">

        <div class="row">

            <div class="col m9 s12 offset-m3">
                <div class="card displayNone divBorder1" id="animInfo1">
                    <div class="card-content">

                    </div>
                    <div class="card-action div_action">
                        <a href="#">Info1</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col m9 s12">
                <div class="card displayNone divBorder1" id="animInfo2">
                    <div class="card-content">

                    </div>
                    <div class="card-action div_action">
                        <a href="#">Info2</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>



<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2670.9009980940655!2d0.20100161608140754!3d47.97697237921103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e28f1ebc58718b%3A0x7f35452087f12043!2s193+Boulevard+Jean+Jacques+Rousseau%2C+72100+Le+Mans!5e0!3m2!1sfr!2sfr!4v1524660292178" width="100% !important;" frameborder="0" style="border:0; height: 250px !important;" allowfullscreen></iframe>




<script>
    window.onscroll = function() {serieAnim()};


    function serieAnim() {

        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {

            document.getElementById("animInfo1").classList.remove("displayNone");
            document.getElementById("animInfo2").classList.remove("displayNone");
            document.getElementById("animInfo1").classList.add("animInfo1");
            document.getElementById("animInfo2").classList.add("animInfo2");
        }
    }


    M.AutoInit();

    $('.carousel.carousel-slider').carousel({
        indicators:true,
        interval:500,
        transition:300,
        fullWidth:true
    });


    var instance = M.Carousel.getInstance(elem);

    instance.next(3);
</script>








