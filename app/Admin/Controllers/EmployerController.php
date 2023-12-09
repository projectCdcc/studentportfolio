<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Employer;

class EmployerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Employer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Employer());

        $grid->column('id', __('Id'));
        $grid->column('organization_name', __('Organization name'));
        $grid->column('email', __('Email'));
        $grid->column('org_type', __('Org type'));
        $grid->column('street', __('Street'));
        $grid->column('city', __('City'));
        $grid->column('country', __('Country'));
        $grid->column('establish_year', __('Establish year'));
        $grid->column('phone', __('Phone'));
        $grid->column('website', __('Website'));
        $grid->column('about', __('About'));
        $grid->column('user_id', __('User id'));
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
        $show = new Show(Employer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('organization_name', __('Organization name'));
        $show->field('email', __('Email'));
        $show->field('org_type', __('Org type'));
        $show->field('street', __('Street'));
        $show->field('city', __('City'));
        $show->field('country', __('Country'));
        $show->field('establish_year', __('Establish year'));
        $show->field('phone', __('Phone'));
        $show->field('website', __('Website'));
        $show->field('about', __('About'));
        $show->field('user_id', __('User id'));
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
        $form = new Form(new Employer());

        $form->text('organization_name', __('Organization name'));
        $form->email('email', __('Email'));
        $form->text('org_type', __('Org type'));
        $form->text('street', __('Street'));
        $form->text('city', __('City'));
        $form->text('country', __('Country'));
        $form->text('establish_year', __('Establish year'));
        $form->phonenumber('phone', __('Phone'));
        $form->text('website', __('Website'));
        $form->textarea('about', __('About'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
