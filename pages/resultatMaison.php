<div id="result" class="collapsible-body">
<table>
    <p style="text-align:center;">Séjour du <?=  date("d/m/Y", strtotime($_SESSION['arrivee'])) ?> au <?=  date("d/m/Y", strtotime($_SESSION['depart']))?> <br>
       pour <?=  $_SESSION['NombrePersonne'] ?> personnes.
    </p>

    <br>

    <tr style="border:none;  border-top:2px solid grey;">
        <td style="text-align: center;">Prix Séjour HT </td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'PrixSejourHT'],2) ?> euros </td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: center;"> + TVA Séjour </td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'TvaSejour'],2) ?> euros</td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: center;"> + Taxe de Séjour </td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'TaxeSejour'],2) ?> euros</td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: center;">Votre séjour comprend <?=  $_SESSION[$_GET['p'].'NombreMenage'] ?> ménage(s)</td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'PrixMenageHT'],2) ?> euros</td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: center;"> + TVA Ménage</td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'TvaMenage'],2) ?> euros</td>
    </tr>
    </div>

    <tr style="border:none; border-top:2px solid grey;">
        <td style="text-align:center;">Prix total TTC:</td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'PrixSejourTotalTTC'],2) ?> euros</td>
    </tr>
</table>

</div>
