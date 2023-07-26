<?php

namespace frontend\modules\docman\controllers;
use common\models\docman\Doc;
use common\models\docman\Document;
use common\models\docman\Doccategory;
use common\models\docman\Section;
use common\models\docman\Subcategory;

use yii\web\Controller;

/**
 * Default controller for the `Budget` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDashboard()
    {
        $qm = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>1])->count();
        $op = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>2])->count();
        $wi = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>3])->count();
        $methods = Document::find()->where('qms_type_id =:qms_type_id AND category_id =:category_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id'], ':category_id'=>5])->count();
        // $noAttachments = Document::find()->where('qms_type_id =:qms_type_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id']])->count();
        $zeroRevisions = Document::find()->where('qms_type_id =:qms_type_id AND revision_number=0 AND active =1',[':qms_type_id'=>$_GET['qms_type_id']])->count();
        $duplicates = Document::find()->select(['document_code'])->where('qms_type_id =:qms_type_id AND active =1',[':qms_type_id'=>$_GET['qms_type_id']])->distinct();

        return $this->render('dashboard', [
            'qm'=>$qm,
            'op'=>$op,
            'wi'=>$wi,
            'methods'=>$methods,
            'noAttachments'=>Document::noAttachments(),
            'zeroRevisions'=>$zeroRevisions,
            'duplicates'=>$duplicates,
        ]);
    }

    public function actionDirectory()
    {
        $qm = Section::find()
            ->with('doccategory')
            ->joinWith('docs')
            ->where(['tbl_section.doccategory_id' => 1])
            ->count();

        $pm = Section::find()
            ->with('doccategory')
            ->joinWith('docs')
            ->where(['tbl_section.doccategory_id' => 2])
            ->count();
        $wi = Section::find()
            ->with('doccategory')
            ->joinWith('docs')
            ->where(['tbl_section.doccategory_id' => 3])
            ->count();
        $fm = Section::find()
            ->with('doccategory')
            ->joinWith('docs')
            ->where(['tbl_section.doccategory_id' => 4])
            ->count();

        return $this->render('directory', [
            'qm'=>$qm,
            'pm'=>$pm,
            'wi'=>$wi,
            'fm'=>$fm,
            'noAttachments'=>5,
            'zeroRevisions'=>6,
            'duplicates'=>7,
        ]);
    }

    public function actionSubdirectory()
    {
        $catId = $_GET['cat_id'];
        $cat = Doccategory::findOne($catId);
        $subdirs = $cat->subcategories;
            
        return $this->render('subdirectory', [
            'cat'=>$cat,
            'subdirs'=>$subdirs,
        ]);
    }

    public function actionSection()
    {
        $catId = $_GET['cat_id'];
        $cat = Doccategory::findOne($catId);
        $sections = $cat->sections;
            
        return $this->render('section', [
            'cat'=>$cat,
            'sections'=>$sections,
        ]);
    }
}
