<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace eluhr\shop\controllers\crud\base;

use eluhr\shop\models\OrderItem;
use eluhr\shop\models\search\OrderItem as OrderItemSearch;
use eluhr\shop\controllers\crud\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
* OrderItemController implements the CRUD actions for OrderItem model.
*/
class OrderItemController extends Controller
{


/**
* @var boolean whether to enable CSRF validation for the actions in this controller.
* CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
*/
    public $enableCsrfValidation = false;


    /**
    * Lists all OrderItem models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel  = new OrderItemSearch;
        $dataProvider = $searchModel->search($_GET);

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('index', [
'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
    }

    /**
    * Displays a single OrderItem model.
    * @param string $order_id
         * @param integer $variant_id
    *
    * @return mixed
    */
    public function actionView($order_id, $variant_id)
    {
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('view', [
'model' => $this->findModel($order_id, $variant_id),
]);
    }

    /**
    * Creates a new OrderItem model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new OrderItem;

        try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(['view', 'order_id' => $model->order_id, 'variant_id' => $model->variant_id]);
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
    * Updates an existing OrderItem model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param string $order_id
         * @param integer $variant_id
    * @return mixed
    */
    public function actionUpdate($order_id, $variant_id)
    {
        $model = $this->findModel($order_id, $variant_id);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
'model' => $model,
]);
        }
    }

    /**
    * Deletes an existing OrderItem model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param string $order_id
         * @param integer $variant_id
    * @return mixed
    */
    public function actionDelete($order_id, $variant_id)
    {
        try {
            $this->findModel($order_id, $variant_id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$order_id, $variant_id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
    * Finds the OrderItem model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param string $order_id
         * @param integer $variant_id
    * @return OrderItem the loaded model
    * @throws HttpException if the model cannot be found
    */
    protected function findModel($order_id, $variant_id)
    {
        if (($model = OrderItem::findOne(['order_id' => $order_id, 'variant_id' => $variant_id])) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}
