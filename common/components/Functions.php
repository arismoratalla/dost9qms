<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;
use common\models\procurement\Supplier;
use yii\base\Component;
use yii2mod\alert\Alert;
use kartik\select2\Select2;
use yii\web\JsExpression;
use Yii;
use kartik\grid\GridView;
/**
 * Description of Functions
 *
 * @author OneLab
 */
class Functions extends Component
{
    /**
     *
     * @param string $Proc
     * @param array $Params
     * @param CDBConnection $Connection
     * @return array
     */
    function ExecuteStoredProcedureRows($Proc, array $Params, $Connection)
    {
        if (!isset($Connection)) {
            $Connection = Yii::$app->db;
        }
        $Command = $Connection->createCommand("CALL $Proc");
        //Iterate through arrays of parameters
        foreach ($Params as $Key => $Value) {
            $Command->bindValue($Key, $Value);
        }
        $Rows = $Command->queryAll();
        return $Rows;
    }

    /**
     * @param description Executes the SQL statement. This method should only be used for executing non-query SQL statement, such as `INSERT`, `DELETE`, `UPDATE` SQLs. No result set will be returned.
     * @param type $Proc
     * @param array $Params the Parameter for Stored Procedure
     * @param type $Connection the Active Connection
     * @return Integer
     */
    function ExecuteStoredProcedure($Proc, array $Params, $Connection)
    {
        if (!isset($Connection)) {
            $Connection = Yii::$app->db;
        }
        $Command = $Connection->createCommand("CALL $Proc");
        //Iterate through arrays of parameters
        foreach ($Params as $Key => $Value) {
            $Command->bindValue($Key, $Value);
        }
        $ret = $Command->execute();
        return $ret;
    }

    /**
     * @param $id The ID Header for the Modal
     * @param $title The Title Of the Modal Page
     * @return string
     */
    function GenerateHeaderModal($id, $title,$widthsize=80,$top)
    {
        $generateheader = "";
        $generateheader = '<div id="' . $id . '" class="modal fade" role="dialog">';
        $generateheader = $generateheader . '<div class="modal-dialog" style="width:'.$widthsize.'%;margin-top:'.$top.'%">';
        $generateheader = $generateheader . '<div class="modal-content">';
        $generateheader = $generateheader . '<div class="modal-header">';
        $generateheader = $generateheader . '<button type="button" class="close" data-dismiss="modal">&times;</button>';
        $generateheader = $generateheader . '<h4 class="modal-title">' . $title . '</h4>';
        $generateheader = $generateheader . '</div><div class="modal-body">';
        $generateheader = $generateheader . '<div class="container-fluid">';
        return $generateheader;
    }

    /**
     * @param string Close Title Description
     * @param string Proceed Title Description
     * @param int Set True if there will be a proceed button
     * @return string
     */
    function GenerateFooterModal($closetitle = "close",$proceedtitle="",$proceedbutton = 0) {

        $generatefooter = "";
        $generatefooter = $generatefooter.'</div></div>';
        $generatefooter = $generatefooter.'<div class="modal-footer">';
        if ($proceedbutton) {
        $generatefooter = $generatefooter.'<button type="button" class="btn btn-warning" data-dismiss="modal">'.$proceedtitle.'</button>';
        }
        $generatefooter = $generatefooter.'<button type="button" class="btn btn-default" data-dismiss="modal">'.$closetitle.'</button>';
        $generatefooter = $generatefooter.'</div></div></div></div>';
        return $generatefooter;
    }

    /***
     * @param Controller Name of the AngularJS
     * @param $linktarget
     * @param $linktitle
     * @return string
     */

    function GridHeaderAngularJS($controllername,$linktarget="",$linktitle="") {

        $gridheader = '<div ng-controller="'.$controllername.'">';
        $gridheader = $gridheader.'<div class="wrapper wrapper-white">';
        $gridheader = $gridheader.'<div class="space-20"></div>';
        $gridheader = $gridheader.'<div class="container-fluid">';
        $gridheader = $gridheader.'<div class="row">';
        $gridheader = $gridheader.'<div class="col-md-2">Page Size :';
        $gridheader = $gridheader.'<select ng-model="entryLimit" class="form-control">';
        $gridheader = $gridheader.' <option>5</option><option>10</option><option>20</option> <option>50</option><option>100</option>';
        $gridheader = $gridheader.'</select></div>';
        $gridheader = $gridheader.'<div class="col-md-4">&nbsp;';
        $gridheader = $gridheader.'<input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control"/></div>';
        $gridheader = $gridheader.'<div class="col-md-2">';
        $gridheader = $gridheader.'<div class="space-20"></div>';
        if($linktitle=="") {
            //nothing
        }else{
            $gridheader = $gridheader.'<h5 style=\'display: inline-block;margin:0px;\' data-step=\'1\' data-intro=\'Click here to Create\'><span><button data-toggle="modal" data-target="#'.$linktarget.'" href="#'.$linktarget.'" class="'.$linktarget.' btn btn-success btn-block">'.$linktitle.' <i class="fa fa-plus"></i></button></h5</span>';
        }
        $gridheader = $gridheader.'</div></div>';
        $gridheader = $gridheader.'<div class="space-20"></div>';
        $gridheader = $gridheader.'</div>';
        $gridheader = $gridheader.'<div class="row">';
        $gridheader = $gridheader.'<div class="col-md-12" ng-show="filteredItems > 0">';
        $gridheader = $gridheader.'<div class="table-responsive"><table class="table kartik-sheet-style">';
        $gridheader = $gridheader.'<thead>';

        return $gridheader;

    }

    /***
     * @return string
     */

    function GridHeaderAngularJSClose() {

        $gridclose = " </thead>";
        return $gridclose;

    }

    /***
     * @param $HeaderTitle
     * @param $Sortfields
     * @return string
     */

    function GridHeader($HeaderTitle,$Sortfields) {
        if ($Sortfields=="") {
            $gridheader='<th style="text-align: right!important;" class="kartik-sheet-style">'.$HeaderTitle.'</th>';
        }
        else if ($Sortfields=="default") {
            $gridheader='<th class="kartik-sheet-style">'.$HeaderTitle.'</th>';
        }
        else{
        $gridheader='<th class="kartik-sheet-style">'.$HeaderTitle.'<a ng-click="sort_by('.$Sortfields.');"><i class="glyphicon glyphicon-sort"></i></a></th>';
        }
        return $gridheader;

    }

    /***
     * @return string
     */

    function GridHeaderDetails() {
        $griddetails ='<tbody>';
        $griddetails = $griddetails.'<tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">';
        return $griddetails;
    }

    /***
     * @param string $datavalue
     * @return string
     */

    function GridDetails($datavalue="") {
        $grd='<td width="18%">{{data.'.$datavalue.'}}</td>';
        return $grd;
    }

    /***
     * @return string
     */

    function GridGroupStart($classname="") {
          $groupstart = "<td class='".$classname."' style='float:right;'>";
          return $groupstart;
    }

    /***
     * @return string
     */

    function GridGroupEnd() {
        $groupend = "</td>";
        return $groupend;
    }

    /***
     * @param string $datavalue
     * @param $buttontitle
     * @param $buttonid
     * @param string $buttontype
     * @param string $buttonblock
     * @return string
     */

    function GridButton($datavalue="",$buttontitle,$buttonid,$buttontype="success",$buttonblock="",$css="",$fa="",$btncase="myView",$ModuleURL="") {
        $BaseURL = $GLOBALS['frontend_base_uri'];
        $tooltips = $buttontitle;
        $buttontitle="";
        switch ($btncase) {
            case "myView":
                $grdbtn = '<h5 style=\'display: inline-block;margin:0px;\' data-step=\'2\' data-intro=\'Click here to View\'><a type="button" title="'.$tooltips.'" data-target="#'.$btncase.'" data-toggle="modal" data-id="{{data.'.$datavalue.'}}"  class="'.$ModuleURL.' btn btn-'.$buttontype.' '.$buttonblock.' '.$css.'">'.$buttontitle.' <i class="'.$fa.'"></i></a></h5>';
                break;
            case "Update":
                $grdbtn = '<h5 style=\'display: inline-block;margin:0px;\' data-step=\'3\' data-intro=\'Click here to Update\'><a type="button" title="'.$tooltips.'" data-target="#'.$btncase.'" data-toggle="modal" data-id="{{data.'.$datavalue.'}}" class="'.$ModuleURL.' btn btn-'.$buttontype.' '.$buttonblock.' '.$css.'">'.$buttontitle.' <i class="'.$fa.'"></i></a></h5>';
                break;
            case "Delete":
                $grdbtn = '<h5 style=\'display: inline-block;margin:0px;\' data-step=\'4\' data-intro=\'Click here to Delete\'><a data-method="post" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" href="'.$BaseURL.$ModuleURL.'delete?id={{data.'.$datavalue.'}}" data-id="{{data.'.$datavalue.'}}" data-ok="Yes" data-cancel="No" data-title="Delete" id="'.$buttonid.'" class="btn btn-'.$buttontype.' '.$buttonblock.' '.$css.'">'.$buttontitle.' <i class="'.$fa.'"></i></a></h5>';
                break;
            case "myTagging":
                $grdbtn = '<h5 ng-if="data.status == 0 || data.status == 3" style=\'display: inline-block;margin:0px;\' data-step=\'3\' data-intro=\'Click here to Tag\'><a type="button" title="'.$tooltips.'" data-target="#'.$btncase.'" data-toggle="modal" data-id="{{data.'.$datavalue.'}}" class="'.$ModuleURL.' btn btn-'.$buttontype.' '.$buttonblock.' '.$css.'">'.$buttontitle.' <i class="'.$fa.'"></i></a></h5>';
                break;
            default:
                $grdbtn = '<h5 style=\'display: inline-block;margin:0px;\' data-step=\'2\' data-intro=\'Click here to View\'><a type="button" title="'.$tooltips.'" data-target="#'.$btncase.'" data-toggle="modal" data-id="{{data.'.$datavalue.'}}"  class="'.$ModuleURL.' btn btn-'.$buttontype.' '.$buttonblock.' '.$css.'">'.$buttontitle.' <i class="'.$fa.'"></i></a></h5>';
                break;
        }
        return $grdbtn;
    }

    /***
     * @param string $NotFoundData
     * @return string
     */

    function GridHeaderClose($NotFoundData="No Data") {

        $gridclose = '</tr></tbody></table></div></div>';
        $gridclose = $gridclose.'<div class="col-md-12" ng-show="filteredItems == 0">';
        $gridclose = $gridclose.'<div class="col-md-12"><h4>'.$NotFoundData.'</h4></div></div>';
        $gridclose = $gridclose.'<div class="col-md-12" ng-show="filteredItems > 0">';
        $gridclose = $gridclose.'<ul uib-pagination total-items="totalItems" max-size=10 ng-model="currentPage" ng-change="pageChanged()"></ul>';
        $gridclose = $gridclose.'</div></div></div></div></div>';

        return $gridclose;

    }


    function CrudAlert($title="Saved Successfully",$type=Alert::TYPE_WARNING,$showclose=false,$showcancel=false) {
        return  Alert::widget([
            'options' => [
                'showCloseButton' => $showclose,
                'showCancelButton' => $showcancel,
                'title' => $title,
                'type' => $type ,
                'timer' => 1000
            ],
            'callback' => new \yii\web\JsExpression("
                        function () {
                        $('.sweet-overlay').css('display','none');
                        $('.sweet-alert').removeClass( \"showSweetAlert \" );
                        $('.sweet-alert').removeClass( \"visible \" );
                        $('.sweet-alert').addClass( \"hideSweetAlert \" );
                        $('.sweet-alert').css('display','none');
                        $('.skin-green').removeClass(\"stop-scrolling\");
                        }"),
        ]);
    }
    function CrudAlert2($title="Saved Successfully",$type=Alert::TYPE_WARNING,$showclose=false,$showcancel=false) {
        return  Alert::widget([
            'options' => [
                'showCloseButton' => $showclose,
                'showCancelButton' => $showcancel,
                'title' => $title,
                'type' => $type ,
                'timer' => 1000
            ],
        ]);
    }


    function GetSupplier($form,$model,$disabled=false,$Label=false,$pid=39){
        $dataExp = <<< SCRIPT
        function (params, page) {
            return {
                q: params.term
            };
        }
SCRIPT;
        $dataResults = <<< SCRIPT
    function (data, page) {
        return {
          results: data.results
        };
    }
SCRIPT;
        $url = \yii\helpers\Url::to(['/ajax/supplierlist','pid'=>$pid]);
        // Get the initial city description
        $cust_name = 'fafaf';//Supplier::findOne($model->supplier_id)->supplier_name;
        if ($form=="") {
              return  Select2::widget([
                  'initValueText' => $cust_name, // set the initial display
                  'id' => 'cbosupplyofficer',
                  'name' => 'cbosupplyofficer',
                  'language' => 'en',
                  'options' => ['placeholder' => 'Search for a Supplier ...','disabled'=>$disabled,'class'=>'.input-group.input-group-sm'],

                  'pluginEvents' => [
                      "change" => "function() {
                                             var supplierid = $(this).val();
                                             var pID = $(\"#pID\").val();
                                             jQuery.ajax( {
                                                type: \"POST\",
                                                data: {
                                                    supplierid: supplierid,
                                                    pID: pID,
                                                },
                                                url: \"/procurement/bids/checksupplier\",
                                                dataType: \"text\",
                                                success: function ( response ) {
                                                   $('#btnCreatePO').prop('disabled',false);
                                                   $('.kv-editable-value').prop('disabled',false);
                                                   $('.kv-editable-value').removeClass('kv-disable-link');
                                                   $('.kv-editable-value').addClass('kv-editable-link');
                                                   $('.btn-group').show();
                                                   if(response.trim()>0) {
                                                   $('.kv-editable-value').prop('disabled',true);
                                                   $('.kv-editable-value').removeClass('kv-editable-link');
                                                   $('.kv-editable-value').addClass('kv-disable-link');
                                                   $('.btn-group').hide();
                                                   $('#btnCreatePO').prop('disabled',true); 
                                                        $('#disable-container').each(function () {
                                                        if ($(\"#disable-container .mypopup\").hasClass('selected')) {
                                                            $(\"#disable-container .mypopup\").removeClass('selected');
                                                        }else{
                                                            $(\"#disable-container .mypopup\").addClass('selected');}
                                                        });
                                                       }
                                                },
                                                error: function ( xhr, ajaxOptions, thrownError ) {
                                                    alert( thrownError );
                                                }
                                            });
                                         }",
                  ],


                  'pluginOptions' => [
                      'allowClear' => true,
                      'minimumInputLength' => 1,
                      'language' => [
                          'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                      ],
                      'ajax' => [
                          'url' => $url,
                          'dataType' => 'json',
                          'data' => new JsExpression($dataExp),
                          'results' => new JsExpression($dataResults)
                     ]
                  ] ,
              ]);
        }

    }
    
    /**
     * 
     * @return type
     */
    public function exportConfig($title,$filename,$Header){
        $pdfHeader = [
            'L' => [
                'content' => "",
                'font-size' => 0,
                'color' => '#333333',
            ],
            'C' => [
                'content' => $Header,
                'font-size' => 20,
                'margin-top'=>60,
                'color' => '#333333',
            ],
            'R' => [
                'content' =>'',
                'font-size' => 0,
                'color' => '#333333',
            ],
            'line'=>false
        ];
        $pdfFooter = [
            'L' => [
                'content' => '',
                'font-size' => 0,
                'font-style' => 'B',
                'color' => '#999999',
            ],
            'C' => [
                'content' => '{PAGENO}',
                'font-size' => 10,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color' => '#333333',
            ],
            'R' => [
                'content' => '',
                'font-size' => 0,
                'font-style' => 'B',
                'font-family' => 'serif',
                'color' => '#333333',
            ],
            'line' => false,
        ];
        return [GridView::PDF => [
                'filename' => $filename,
                'alertMsg'        => 'The PDF export file will be generated for download.',
                'config' => [
                    'methods' => [
                        //'SetHeader' => [$pdfHeader,'line'=>0],
                        //'SetFooter' => [$pdfFooter]
                        'SetHeader' => [
                            ['odd' => $pdfHeader, 'even' => $pdfHeader],
                        ],
                        'SetFooter' => [
                            ['odd' => $pdfFooter, 'even' => $pdfFooter],
                        ],
                    ],
                    'options' => [
                        'title' => $title,
                        'subject' => 'SOA',
                        'keywords' => 'pdf, preceptors, export, other, keywords, here',
                        'destination'=>'I'
                    ],
                ]
            ],
            GridView::EXCEL => [
                'label'           => 'Excel',
                //'icon'            => 'file-excel-o',
                'methods' => [
                    'SetHeader' => [$pdfHeader],
                    'SetFooter' => [$pdfFooter]
                ],
                'iconOptions'     => ['class' => 'text-success'],
                'showHeader'      => TRUE,
                'showPageSummary' => TRUE,
                'showFooter'      => TRUE,
                'showCaption'     => TRUE,
                'filename'        => $filename,
                'alertMsg'        => 'The EXCEL export file will be generated for download.',
                'options'         => ['title' => $title],
                'mime'            => 'application/vnd.ms-excel',
                'config'          => [
                    'worksheet' =>$title,
                    'cssFile'   => ''
                ]
            ],
        ];
    }

}
