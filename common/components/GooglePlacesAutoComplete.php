<?php

namespace common\components;

use yii\widgets\InputWidget;
use yii\helpers\Html;


class GooglePlacesAutoComplete extends InputWidget {

    const API_URL = '//maps.googleapis.com/maps/api/js?';
    
    public $libraries = 'places';

    public $language = 'en-US';

    public $autocompleteOptions = [];

    /**
     * Renders the widget.
     */
    public function run(){
        $this->registerClientScript();
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript(){
        $elementId = $this->options['id'];
        $scriptOptions = json_encode($this->autocompleteOptions);
        $view = $this->getView();
        $view->registerJsFile(self::API_URL . http_build_query([
            'key'=>\Yii::$app->places->key,
            'libraries' => $this->libraries,
            'language' => $this->language
        ]));
        $view->registerJs(<<<JS
(function(){
    var input = document.getElementById('{$elementId}');
    var options = {$scriptOptions};
    autocomplete=new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', fillInAddress);
})();
JS
        , \yii\web\View::POS_READY);
    }
}
