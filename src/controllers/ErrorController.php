<?php

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * Error controller.
 */
class ErrorController extends Controller
{
    /**
     * @var Exception
     */
    protected $exception;

    /**
     * @return string
     */
    public function actionIndex()
    {
        $this->exception = $this->findException();
        Yii::$app->getResponse()->setStatusCodeByException($this->exception);
        if (Yii::$app->getRequest()->getIsAjax()) {
            return $this->renderAjaxResponse();
        }
        return $this->renderHtmlResponse();
    }

    /**
     * Builds string that represents the exception.
     * Normally used to generate a response to AJAX request.
     * @return string
     * @since 2.0.11
     */
    protected function renderAjaxResponse()
    {
        $this->layout = '@app/views/layouts/blank';
        return $this->render('index', [
            'name' => $this->getExceptionName(),
            'message' => $this->getExceptionMessage(),
            'exception' => $this->exception,
        ]);
    }

    /**
     * Renders a view that represents the exception.
     * @return string
     * @since 2.0.11
     */
    protected function renderHtmlResponse()
    {
        $this->layout = '@app/views/layouts/minimal';
        Yii::$app->view->params = [
            'html-class' => 'bg-dark background-image',
            'html-style' => 'background-image: url(//source.unsplash.com/daily?lost,error,tech)',
            'skin' => 'bg-dark',
            'hide-footer' => true,
        ];
        return $this->render('index', [
            'name' => $this->getExceptionName(),
            'message' => $this->getExceptionMessage(),
            'exception' => $this->exception,
        ]);
    }

    /**
     * Gets exception from the [[yii\web\ErrorHandler|ErrorHandler]] component.
     * In case there is no exception in the component, treat as the action has been invoked
     * not from error handler, but by direct route, so '404 Not Found' error will be displayed.
     * @return \Exception
     * @since 2.0.11
     */
    protected function findException()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        return $exception;
    }

    /**
     * Gets the code from the [[exception]].
     * @return mixed
     * @since 2.0.11
     */
    protected function getExceptionCode()
    {
        if ($this->exception instanceof HttpException) {
            return $this->exception->statusCode;
        }
        return $this->exception->getCode();
    }

    /**
     * Returns the exception name, followed by the code (if present).
     *
     * @return string
     * @since 2.0.11
     */
    protected function getExceptionName()
    {
        if ($this->exception instanceof Exception) {
            $name = $this->exception->getName();
        } else {
            $name = Yii::t('app', 'Error');
        }
        if ($code = $this->getExceptionCode()) {
            $name .= " (#$code)";
        }
        return $name;
    }

    /**
     * Returns the [[exception]] message for [[yii\base\UserException]] only.
     * For other cases [[defaultMessage]] will be returned.
     * @return string
     * @since 2.0.11
     */
    protected function getExceptionMessage()
    {
        if ($this->exception instanceof UserException) {
            return $this->exception->getMessage();
        }
        return Yii::t('app', 'An internal server error occurred.');
    }
}
