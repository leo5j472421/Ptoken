<?php

namespace App\Admin\Controllers;

use App\Transaction;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TransactionController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('token申請管理');
            $content->description('資訊');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('token申請管理');
            $content->description('修改');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('token申請管理');
            $content->description('新增');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Transaction::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->user_id('User ID')->sortable();
            $grid->state('State')->sortable();
            $grid->address('Address')->sortable();
            $grid->token('token')->sortable();
            $grid->pcoin('Pcoin')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Transaction::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->number('user_id', 'User ID');
            $form->select('state', 'State')->options(['done' => 'done', 'failed' => 'failed']);
            $form->text('address', 'Address');
            $form->number('token', 'token');
            $form->number('pcoin', 'Pcoin');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
