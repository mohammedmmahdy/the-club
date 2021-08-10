<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateSocialLinkRequest;
use App\Http\Requests\AdminPanel\UpdateSocialLinkRequest;
use App\Repositories\AdminPanel\SocialLinkRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SocialLinkController extends AppBaseController
{
    /** @var  SocialLinkRepository */
    private $socialLinkRepository;

    public function __construct(SocialLinkRepository $socialLinkRepo)
    {
        $this->socialLinkRepository = $socialLinkRepo;
    }

    /**
     * Display a listing of the SocialLink.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $socialLinks = $this->socialLinkRepository->all();

        return view('adminPanel.social_links.index')
            ->with('socialLinks', $socialLinks);
    }

    /**
     * Show the form for creating a new SocialLink.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.social_links.create');
    }

    /**
     * Store a newly created SocialLink in storage.
     *
     * @param CreateSocialLinkRequest $request
     *
     * @return Response
     */
    public function store(CreateSocialLinkRequest $request)
    {

        $input = $request->all();
        
        $socialLink = $this->socialLinkRepository->create($input);
        // dd($socialLink);

        Flash::success(__('messages.saved', ['model' => __('models/socialLinks.singular')]));

        return redirect(route('adminPanel.socialLinks.index'));
    }

    /**
     * Display the specified SocialLink.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $socialLink = $this->socialLinkRepository->find($id);

        if (empty($socialLink)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialLinks.singular')]));

            return redirect(route('adminPanel.socialLinks.index'));
        }

        return view('adminPanel.social_links.show')->with('socialLink', $socialLink);
    }

    /**
     * Show the form for editing the specified SocialLink.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $socialLink = $this->socialLinkRepository->find($id);

        if (empty($socialLink)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialLinks.singular')]));

            return redirect(route('adminPanel.socialLinks.index'));
        }

        return view('adminPanel.social_links.edit')->with('socialLink', $socialLink);
    }

    /**
     * Update the specified SocialLink in storage.
     *
     * @param int $id
     * @param UpdateSocialLinkRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSocialLinkRequest $request)
    {
        $socialLink = $this->socialLinkRepository->find($id);

        if (empty($socialLink)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialLinks.singular')]));

            return redirect(route('adminPanel.socialLinks.index'));
        }

        $socialLink = $this->socialLinkRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/socialLinks.singular')]));

        return redirect(route('adminPanel.socialLinks.index'));
    }

    /**
     * Remove the specified SocialLink from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $socialLink = $this->socialLinkRepository->find($id);

        if (empty($socialLink)) {
            Flash::error(__('messages.not_found', ['model' => __('models/socialLinks.singular')]));

            return redirect(route('adminPanel.socialLinks.index'));
        }

        $this->socialLinkRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/socialLinks.singular')]));

        return redirect(route('adminPanel.socialLinks.index'));
    }
}
