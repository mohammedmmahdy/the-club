<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateNewsRequest;
use App\Http\Requests\AdminPanel\UpdateNewsRequest;
use App\Repositories\AdminPanel\NewsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class NewsController extends AppBaseController
{
    /** @var  NewsRepository */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
    }

    /**
     * Display a listing of the News.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $news = $this->newsRepository->all();

        return view('adminPanel.news.index')
            ->with('news', $news);
    }

    /**
     * Show the form for creating a new News.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.news.create');
    }

    /**
     * Store a newly created News in storage.
     *
     * @param CreateNewsRequest $request
     *
     * @return Response
     */
    public function store(CreateNewsRequest $request)
    {
        $input = $request->all();

        $news = $this->newsRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/news.singular')]));

        return redirect(route('adminPanel.news.index'));
    }

    /**
     * Display the specified News.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error(__('messages.not_found', ['model' => __('models/news.singular')]));

            return redirect(route('adminPanel.news.index'));
        }

        return view('adminPanel.news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified News.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error(__('messages.not_found', ['model' => __('models/news.singular')]));

            return redirect(route('adminPanel.news.index'));
        }

        return view('adminPanel.news.edit')->with('news', $news);
    }

    /**
     * Update the specified News in storage.
     *
     * @param int $id
     * @param UpdateNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewsRequest $request)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error(__('messages.not_found', ['model' => __('models/news.singular')]));

            return redirect(route('adminPanel.news.index'));
        }

        $news = $this->newsRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/news.singular')]));

        return redirect(route('adminPanel.news.index'));
    }

    /**
     * Remove the specified News from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error(__('messages.not_found', ['model' => __('models/news.singular')]));

            return redirect(route('adminPanel.news.index'));
        }

        $this->newsRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/news.singular')]));

        return redirect(route('adminPanel.news.index'));
    }
}
