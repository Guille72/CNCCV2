<nav class="nav-extended nav1 nav" style="background-color: white" id="navbar">
    <div class="nav-wrapper">
        <a href="{{route('accueil')}}" style="height: 200px; width: 200px">
            <img href="index.php" src="{{asset('img/logo_cnccv6_155x155.png')}}" id="logo" class="brand-logo"
                 style="height: 130px; width: auto;">
        </a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger">
            <i class="material-icons" style="color: #7BBECB">menu</i>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a class="colortext" href="{{route('accueil')}}#AllMaison">Toutes les maisons</a></li>
            <li><a class="colortext" href="{{route('contact')}}">Contact</a></li>
            <li><a href="#"></a></li>
        </ul>
    </div>
    <div class="hide-on-large-only"><br></div>
    <div class="nav-content hide-on-med-and-down displayNScroll" id="cc">
        <ul class="centreETC tabs-transparent align_ul displayNScroll">
            <li class="tab li1 li">
                <a class="active colortext colortext1 waves-green" href="{{route('rousseau')}}">
                    <h6>Chez Rousseau</h6>
                </a>
            </li>
            <li class="tab li">
                <a href="{{route('champion')}}" class="colortext colortext1 waves-green">
                    <h6>Chez Champion</h6>
                </a>
            </li>
            <li class="tab li li3">
                <a href="{{route('painLeve')}}" class="colortext colortext1 waves-green">
                    <h6>Chez Painlevé</h6>
                </a>
            </li>
        </ul>
        <br>
    </div>
    <div class="nav-content displayNScroll" id="cc">
        <ul class="centreETC tabs-transparent hide-on-large-only displayNScroll align_ul">
            <li class="tab li1 li">
                <a class="active colortext colortext1 waves-green" href="{{route('rousseau')}}"
                   style="font-size: 14px !important;">Chez Rousseau</a>
            </li>
            <li class="tab li">
                <a href="{{route('champion')}}" class="colortext colortext1 waves-green"
                   style="font-size: 14px !important;">Chez Champion</a>
            </li>
            <li class="tab li li3">
                <a href="{{route('painLeve')}}" class="colortext colortext1 waves-green"
                   style="font-size: 14px !important;">Chez Painlevé</a>
            </li>
        </ul>
        <br>
    </div>
</nav>

<ul class="sidenav sidenavBig sidenavWidth" id="mobile-demo">
    <div class="bgBleuC" style="padding: 10px !important;">
        <h6 style="margin: 0 !important;" class="white-text align colortext1">Menu</h6>
    </div>

    <li><a class="sideNavText" href="{{route('accueil')}}"><span class="badge new">3</span>Toutes les maisons</a></li>
    <li><a class="sideNavText" href="{{route('contact')}}">Contact</a></li>
    <li><a class="sideNavText" href="{{route('ml')}}">Mentions légales</a></li>
    <li><a class="sideNavText" href="{{route('cu')}}">Conditions d'utilisation</a></li>
    <li><a class="sideNavText" href="#">Qui sommes nous ?</a></li>
</ul>
