<?php

namespace common\modules\admin\controllers;

use Yii;
use common\models\procurement\Division;
use common\models\procurement\Section;
use common\models\procurement\Position;

use common\modules\admin\models\User;

use yii\data\ActiveDataProvider;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\mail\BaseMailer;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\modules\admin\components\Helper;

/**
 * User controller
 */
class GroupController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout' => ['post'],
                    'activate' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sections = Section::find()->orderBy('division_id, section_id');
        $sectionsDataProvider = new ActiveDataProvider([
            'query' => $sections,
            'pagination' => false,
        ]);
        
        return $this->render('index', [
                'sectionsDataProvider' => $sectionsDataProvider,
                //'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionListunit() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Unit::find()->andWhere(['division_id'=>$id])->asArray()->all();
            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $unit) {
                    $out[] = ['id' => $unit['unit_id'], 'name' => $unit['name']];
                    if ($i == 0) {
                        $selected = $unit['unit_id'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected'=>'']);
    }
}
