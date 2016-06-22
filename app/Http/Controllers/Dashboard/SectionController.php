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
use Hifone\Models\Node;
use Hifone\Models\Section;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class SectionController extends Controller
{
    /**
     * Creates a new section controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu'  => 'sections',
            'sub_title'     => trans_choice('dashboard.sections.sections', 2),
        ]);
    }

    /**
     * Shows the sections view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sections = Section::orderBy('order')->orderBy('created_at')->get();

        return View::make('dashboard.sections.index')
        ->withPageTitle(trans('dashboard.sections.sections').' - '.trans('dashboard.dashboard'))
        ->withSections($sections);
    }

    /**
     * Shows a section in more detail.
     *
     * @param \Hifone\Models\Section $section
     *
     * @return \Illuminate\View\View
     */
    public function show(Section $section)
    {
        $nodes = Node::where('section_id', $section->id)->orderBy('order')->get();

        return View::make('dashboard.nodes.index')
        ->withPageTitle(trans('dashboard.nodes.nodes').' - '.trans('dashboard.dashboard'))
        ->withNodes($nodes);
    }

    /**
     * Shows the add section view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('dashboard.sections.create_edit')
            ->withPageTitle(trans('dashboard.sections.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new section.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $sectionData = Request::get('section');

        try {
            Section::create($sectionData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.section.create')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.sections.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.section.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.sections.add.success')));
    }

    /**
     * Shows the edit section view.
     *
     * @param \Hifone\Models\Section $section
     *
     * @return \Illuminate\View\View
     */
    public function edit(Section $section)
    {
        return View::make('dashboard.sections.create_edit')
            ->withPageTitle(trans('dashboard.sections.edit.title').' - '.trans('dashboard.dashboard'))
            ->withSection($section);
    }

    /**
     * Edit a section.
     *
     * @param \Hifone\Models\Section $section
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Section $section)
    {
        $sectionData = Request::get('section');

        try {
            $section->update($sectionData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.section.edit', ['id' => $section->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.sections.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.section.edit', ['id' => $section->id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.sections.edit.success')));
    }

    /**
     * Deletes a given section.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $section = Node::findOrFail($id);
        $section->remove();

        return Redirect::route('dashboard.section.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.sections.delete.success')));
    }
}
