<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\PageRepository;
use App\Http\Requests\AdminPanel\CreatePageRequest;
use App\Http\Requests\AdminPanel\UpdatePageRequest;

class PageController extends AppBaseController
{
    /** @var  PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepository = $pageRepo;
    }

    /**
     * Display a listing of the Page.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pages = Page::withCount('paragraph', 'image')->get();

        return view('adminPanel.pages.index')
            ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new Page.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.pages.create');
    }

    /**
     * Store a newly created Page in storage.
     *
     * @param CreatePageRequest $request
     *
     * @return Response
     */
    public function store(CreatePageRequest $request)
    {
        $input = $request->all();

        $page = $this->pageRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/pages.singular')]));

        return redirect(route('adminPanel.pages.index'));
    }

    /**
     * Display the specified Page.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pages.singular')]));

            return redirect(route('adminPanel.pages.index'));
        }

        return view('adminPanel.pages.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified Page.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pages.singular')]));

            return redirect(route('adminPanel.pages.index'));
        }

        return view('adminPanel.pages.edit')->with('page', $page);
    }

    /**
     * Update the specified Page in storage.
     *
     * @param int $id
     * @param UpdatePageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePageRequest $request)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pages.singular')]));

            return redirect(route('adminPanel.pages.index'));
        }

        $page = $this->pageRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/pages.singular')]));

        return redirect(route('adminPanel.pages.index'));
    }

    /**
     * Remove the specified Page from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error(__('messages.not_found', ['model' => __('models/pages.singular')]));

            return redirect(route('adminPanel.pages.index'));
        }

        $this->pageRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/pages.singular')]));

        return redirect(route('adminPanel.pages.index'));
    }
}
