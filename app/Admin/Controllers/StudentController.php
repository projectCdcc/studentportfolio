<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Student;

class StudentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Student';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('username', __('Username'));
        $grid->column('email', __('Email'));
        $grid->column('graduate_date', __('Graduate date'));
        $grid->column('about_me', __('About me'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Student::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('username', __('Username'));
        $show->field('email', __('Email'));
        $show->field('graduate_date', __('Graduate date'));
        $show->field('about_me', __('About me'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Student());

        $form->number('user_id', __('User id'));
        $form->text('username', __('Username'));
        $form->email('email', __('Email'));
        $form->datetime('graduate_date', __('Graduate date'))->default(date('Y-m-d H:i:s'));
        $form->textarea('about_me', __('About me'));

        return $form;
    }
}
