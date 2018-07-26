
<div style="height: 500px; background-color: #0f9d58;"></div>
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



<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2671.6616382310385!2d0.2009032157141962!3d47.96226677920992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e28f00b93b7167%3A0xc2f5ee8df8a89244!2s12+Square+Paul+Painlev%C3%A9%2C+72100+Le+Mans!5e0!3m2!1sfr!2sfr!4v1525332134546" width="100%" height="250px" frameborder="0" style="border:0" allowfullscreen></iframe>



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
</script>






