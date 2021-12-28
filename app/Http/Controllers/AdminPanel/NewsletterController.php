<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateNewsletterRequest;
use App\Http\Requests\AdminPanel\UpdateNewsletterRequest;
use App\Repositories\AdminPanel\NewsletterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class NewsletterController extends AppBaseController
{
    /** @var  NewsletterRepository */
    private $newsletterRepository;

    public function __construct(NewsletterRepository $newsletterRepo)
    {
        $this->newsletterRepository = $newsletterRepo;
    }

    public function index(Request $request)
    {
        $newsletters = $this->newsletterRepository->all()->sortDesc();

        return view('adminPanel.newsletters.index')
            ->with('newsletters', $newsletters);
    }
}
