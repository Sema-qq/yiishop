<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\ImageUpload;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    //метод, который делает запрос в базу по id и вытаскивает нужный нам товар
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //страница загрузки карткинки
    public function actionSetImage($id)
    {
        //создаем экземпляр модели по загрузке картинок
        $model = new ImageUpload();

        //если поступил запрос на загрузку картинки при нажатии кнопки, то
        if (Yii::$app->request->isPost)
        {
            //вытаскиваем из базы товар
            $product = $this->findModel($id);

            //получаем файл и передаем его в модель
            $file = UploadedFile::getInstance($model,'image');
            //получаем название картинки и передаем его в метод saveImage
            if ($product->saveImage($model->uploadFile($file, $product->image)))
            {
                //при сохранении перенаправляем обратно в текущий товар
                return $this->redirect(['view','id'=>$product->id]);
            }
        }
        return $this->render('image',['model'=>$model]);
    }

    //страница загрузки категории
    public function actionSetCategory ($id)
    {
        //вытаскиваем товар из базы по id
        $product = $this->findModel($id);
        //передаем текущую категорию виду
        $selectedCategory = $product->category->id;
        //передаем список категорий виду
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        //ловим нажатие кнопки
        if (Yii::$app->request->isPost)
        {
            //передаем значение категории
            $category = Yii::$app->request->post('category');
            //передаем методу saveCategory
            if ($product->saveCategory($category)) //если сохранилась, то
            {
                //отправляемся на страницу просмотра товара
                return $this->redirect(['view','id'=>$product->id]);
            }
        }
        return $this->render('category', [
            'product'=>$product,
            'selectedCategory'=>$selectedCategory,
            'categories'=>$categories
        ]);
    }
}
