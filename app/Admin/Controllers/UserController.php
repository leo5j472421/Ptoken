<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
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

            $content->header('用戶管理');
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

            $content->header('用戶管理');
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

            $content->header('用戶管理');
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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('Name')->sortable();
            $grid->email('Email')->sortable();
            $grid->token('Ptoken')->sortable();
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
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '名稱');
            $form->email('email', 'Email');
            $form->number('token', 'Ptoken');
            $form->number('pcoin', 'Pcoin');

            $form->password('password', '密碼')->rules('required|confirmed')
                ->default(function ($form) {
                    return $form->model()->password;
                });
            $form->password('password_confirmation', '密碼確認')->rules('required')
                ->default(function ($form) {
                    return $form->model()->password;
                });
            $form->ignore(['password_confirmation']);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            
            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                }
            });

        });
    }
}
