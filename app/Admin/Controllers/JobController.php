<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Job;

class JobController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Job';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Job());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('city', __('City'));
        $grid->column('country', __('Country'));
        $grid->column('job_type', __('Job type'));
        $grid->column('category', __('Category'));
        $grid->column('requirement', __('Requirement'));
        $grid->column('how_to', __('How to'));
        $grid->column('description', __('Description'));
        $grid->column('company', __('Company'));
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
        $show = new Show(Job::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('city', __('City'));
        $show->field('country', __('Country'));
        $show->field('job_type', __('Job type'));
        $show->field('category', __('Category'));
        $show->field('requirement', __('Requirement'));
        $show->field('how_to', __('How to'));
        $show->field('description', __('Description'));
        $show->field('company', __('Company'));
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
        $form = new Form(new Job());

        $form->text('title', __('Title'));
        $form->text('city', __('City'));
        $form->text('country', __('Country'));
        $form->text('job_type', __('Job type'));
        $form->text('category', __('Category'));
        $form->textarea('requirement', __('Requirement'));
        $form->textarea('how_to', __('How to'));
        $form->textarea('description', __('Description'));
        $form->text('company', __('Company'));

        return $form;
    }
}
