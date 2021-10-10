<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use App\Models\Page;
use App\Models\Paragraph;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\ParagraphRepository;
use App\Http\Requests\AdminPanel\CreateParagraphRequest;
use App\Http\Requests\AdminPanel\UpdateParagraphRequest;

class ParagraphController extends AppBaseController
{
    /** @var  ParagraphRepository */
    private $paragraphRepository;

    public function __construct(ParagraphRepository $paragraphRepo)
    {
        $this->paragraphRepository = $paragraphRepo;
    }

    /**
     * Display a listing of the Paragraph.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Page $page)
    {
        $paragraphs = Paragraph::where('page_id', $page->id)->get();

        return view('adminPanel.paragraphs.index',compact('page', 'paragraphs'));
    }

    /**
     * Show the form for creating a new Paragraph.
     *
     * @return Response
     */
    public function create(Page $page)
    {
        return view('adminPanel.paragraphs.create', compact('page'));
    }

    /**
     * Store a newly created Paragraph in storage.
     *
     * @param CreateParagraphRequest $request
     *
     * @return Response
     */
    public function store(CreateParagraphRequest $request, Page $page)
    {
        $input = $request->all();
        $input['page_id'] = $page->id;

        $paragraph = $this->paragraphRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/paragraphs.singular')]));

        return redirect(route('adminPanel.pages.paragraphs.index', $page->id));
    }

    /**
     * Display the specified Paragraph.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paragraph = $this->paragraphRepository->find($id);

        if (empty($paragraph)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paragraphs.singular')]));

            return back();
        }

        return view('adminPanel.paragraphs.show', compact('paragraph'));
    }

    /**
     * Show the form for editing the specified Paragraph.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Page $page)
    {
        $paragraph = $this->paragraphRepository->find($id);

        if (empty($paragraph)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paragraphs.singular')]));

            return back();
        }

        return view('adminPanel.paragraphs.edit', compact('paragraph', 'page'));
    }

    /**
     * Update the specified Paragraph in storage.
     *
     * @param int $id
     * @param UpdateParagraphRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParagraphRequest $request)
    {
        $paragraph = $this->paragraphRepository->find($id);

        if (empty($paragraph)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paragraphs.singular')]));

            return back();
        }

        $paragraph = $this->paragraphRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/paragraphs.singular')]));

        return redirect(route('adminPanel.pages.paragraphs.index', $paragraph->page_id));
    }

    /**
     * Remove the specified Paragraph from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $paragraph = $this->paragraphRepository->find($id);

        if (empty($paragraph)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paragraphs.singular')]));

            return back();
        }

        $this->paragraphRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/paragraphs.singular')]));

        return redirect(route('adminPanel.pages.paragraphs.index', $paragraph->page_id));
    }
}
