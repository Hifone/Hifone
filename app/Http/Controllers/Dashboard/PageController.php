<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers\Dashboard;

use AltThree\Validator\ValidationException;
use Hifone\Http\Controllers\Controller;
use Hifone\Models\Page;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    /**
     * Creates a new page controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu' => 'page',
            'sub_title'    => trans_choice('dashboard.pages.pages', 2),
        ]);
    }

    /**
     * Shows the pages view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.pages.index')
            ->withPageTitle(trans('dashboard.pages.pages').' - '.trans('dashboard.dashboard'))
            ->withPages($pages);
    }

    /**
     * Shows the add page view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('dashboard.pages.create_edit')
            ->withPageTitle(trans('dashboard.pages.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $pageData = Request::get('page');

        try {
            Page::create($pageData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.page.create')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.pages.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.page.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.pages.add.success')));
    }

    /**
     * Shows the edit node view.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return View::make('dashboard.pages.create_edit')
            ->withPageTitle(trans('dashboard.pages.edit.title').' - '.trans('dashboard.dashboard'))
            ->withPage($page);
    }

    /**
     * Edit a page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $page = Page::findOrFail($id);
        $pageData = Request::get('page');

        try {
            $page->update($pageData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.page.edit', ['id' => $page->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.pages.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.page.edit', ['id' => $page->id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.pages.edit.success')));
    }
}
