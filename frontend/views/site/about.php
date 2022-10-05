<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use dosamigos\google\places\Search;
use common\components\GooglePlacesAutoComplete;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
//$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyBkbMSbpiE90ee_Jvcrgbb12VRXZ9tlzIc&libraries=places');
//var_dump(Yii::$app->placesSearch->text('manila'));
//var_dump(Yii::$app->places->details('ChIJZ6zAEwY_UDIRmVfUVO3NGnA'));
$js=<<<JS
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
   function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }
        //console.log(place.address_components);
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
           var addressType = place.address_components[i].types[0];
           if (componentForm[addressType]) {
             var val = place.address_components[i][componentForm[addressType]];
             document.getElementById(addressType).value = val;
           }
        }
    }     
JS;
$this->registerJs($js);
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <?php
            echo GooglePlacesAutoComplete::widget([
                'name' => 'place',
                'value' => 'Zamboanga',
                'options'=>['class'=>'form-control']
            ]);
            ?>
        </div>
    </div>
        <div class="row">
            <div class="col-md-6">
            <table id="address" style="color: black">
                <tr>
                    <td class="label">Street address</td>
                    <td class="slimField"><input class="field" id="street_number"
                                                 disabled="true"></input></td>
                    <td class="wideField" colspan="2"><input class="field" id="route"
                                                             disabled="true"></input></td>
                </tr>
                <tr>
                    <td class="label">City</td>
                    <!-- Note: Selection of address components in this example is typical.
                         You may need to adjust it for the locations relevant to your app. See
                         https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
                    -->
                    <td class="wideField" colspan="3"><input class="field" id="locality"
                                                             disabled="true"></input></td>
                </tr>
                <tr>
                    <td class="label">State</td>
                    <td class="slimField"><input class="field"
                                                 id="administrative_area_level_1" disabled="true"></input></td>
                    <td class="label">Zip code</td>
                    <td class="wideField"><input class="field" id="postal_code"
                                                 disabled="true"></input></td>
                </tr>
                <tr>
                    <td class="label">Country</td>
                    <td class="wideField" colspan="3"><input class="field"
                                                             id="country" disabled="true"></input></td>
                </tr>
            </table>
        </div>
        </div>
    </div>
</div>
