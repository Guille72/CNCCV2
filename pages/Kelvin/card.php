<div class="container marginTop">


    <div class="row">

        <div class="col s12 m5">
            <div class="card" id="cardImg">
                <div class="card-image">
                    <img src="../lib/img/logo_cnccv6_other.png">
                    <span class="card-title">Image</span>
                </div>
                <div class="card-content">
                    <p>card image logo animation move top Old logo</p>
                </div>
                <div class="card-action">
                    <a href="#">Voir plus</a>
                </div>
            </div>
        </div>



        <div class="col s12 m7">
            <div class="card animCardL" id="imgCarrou">
                <span class="card-title"></span>
                <div class="card-content">
                    <p></p>
                </div>
                <div class="card-action">
                    <a href="#">Selectionner une image</a>
                </div>
            </div>
        </div>



        <div class="col s12 m7">
            <div class="card animCardL2" id="imgCarrou">
                <span class="card-title"></span>
                <div class="card-content">
                    <p></p>
                </div>
                <div class="card-action">
                    <a href="#">Selectionner une image</a>
                </div>
            </div>
        </div>

    </div>

</div>

    <div style="height: 600px" onmouseover="serieAnim()" onfocus="serieAnim()">

<div class="container">

    <div class="row">

    <div class="col m9 s12 offset-m3">
        <div class="card displayNone" id="animInfo1">
            <div class="card-content">

            </div>
            <div class="card-action">
                <a href="#">Info1</a>
            </div>
        </div>
    </div>

    </div>

    <div class="row">

    <div class="col m9 s12">
        <div class="card displayNone" id="animInfo2">
            <div class="card-content">

            </div>
            <div class="card-action">
                <a href="#">Info2</a>
            </div>
        </div>
    </div>

    </div>

    </div>

</div>



    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2670.9009980940655!2d0.20100161608140754!3d47.97697237921103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e28f1ebc58718b%3A0x7f35452087f12043!2s193+Boulevard+Jean+Jacques+Rousseau%2C+72100+Le+Mans!5e0!3m2!1sfr!2sfr!4v1524660292178" width="100%" !important;" frameborder="0" style="border:0; height: 250px !important;" allowfullscreen></iframe>




<script>

    function serieAnim() {
        document.getElementById("animInfo1").classList.remove("displayNone");
        document.getElementById("animInfo1").classList.add("animInfo1");
        document.getElementById("animInfo2").classList.remove("displayNone");
        document.getElementById("animInfo2").classList.add("animInfo2");
    }

</script>








