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

class NodeController extends Controller
{
    /**
     * Creates a new node controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share([
            'current_menu'  => 'nodes',
            'sub_title'     => trans_choice('dashboard.nodes.nodes', 2),
        ]);
    }

    /**
     * Shows the nodes view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $nodes = Node::orderBy('order')->get();

        return View::make('dashboard.nodes.index')
        ->withPageTitle(trans('dashboard.nodes.nodes').' - '.trans('dashboard.dashboard'))
        ->withNodes($nodes);
    }

    /**
     * Shows the add node view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('dashboard.nodes.create_edit')
            ->withSections(Section::orderBy('order')->get())
            ->withPageTitle(trans('dashboard.nodes.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new node.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $nodeData = Request::get('node');

        try {
            Node::create($nodeData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.node.create')
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.nodes.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.node.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.nodes.add.success')));
    }

    /**
     * Shows the edit node view.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Node $node)
    {
        return View::make('dashboard.nodes.create_edit')
            ->withPageTitle(trans('dashboard.nodes.edit.title').' - '.trans('dashboard.dashboard'))
            ->withSections(Section::orderBy('order')->get())
            ->withNode($node);
    }

    /**
     * Edit a node.
     *
     * @param \Hifone\Models\Node $node
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Node $node)
    {
        $nodeData = Request::get('node');

        try {
            $node->update($nodeData);
        } catch (ValidationException $e) {
            return Redirect::route('dashboard.node.edit', ['id' => $node->id])
                ->withInput(Request::all())
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.nodes.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return Redirect::route('dashboard.node.edit', ['id' => $node->id])
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.nodes.edit.success')));
    }

    /**
     * Deletes a given node.
     *
     * @param \Hifone\Models\Node $node
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Node $node)
    {
        $node->delete();

        return Redirect::route('dashboard.node.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('dashboard.nodes.delete.success')));
    }
}
