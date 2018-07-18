
<div id="result">
<table>
    Séjour du <?=  date("d/m/Y", strtotime($_SESSION['arrivee'])) ?> au <?=  date("d/m/Y", strtotime($_SESSION['depart']))?> pour <?=  $_SESSION['NombrePersonne'] ?> personnes.

    <tr style="border:none;">
        <td>Prix total TTC:</td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'PrixSejourTotalTTC'],2) ?> euros</td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: right;">Prix Séjour HT </td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'PrixSejourHT'],2) ?> euros </td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: right;"> + TVA </td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'TvaSejour'],2) ?> euros</td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: right;">Votre séjour comprend <?=  $_SESSION[$_GET['p'].'NombreMenage'] ?> ménage(s)</td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'PrixMenageHT'],2) ?> euros</td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: right;"> + TVA </td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'TvaMenage'],2) ?> euros</td>
    </tr>
    <tr style="border:none;">
        <td style="text-align: right;"> + Taxe de Séjour </td>
        <td style=""><?=  number_format ($_SESSION[$_GET['p'].'TaxeSejour'],2) ?> euros</td>
    </tr>
</table>

</div>
