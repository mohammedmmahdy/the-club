<?php

namespace App\Http\Controllers\API;

use App\Models\Blog;
use App\Models\Meta;
use App\Models\Page;
use App\Models\Event;
use App\Models\Branch;
use App\Models\Slider;
use App\Models\Academy;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\SocialLink;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Playground;

class MainController extends Controller
{
    public function test()
    {
        return ('test home');
    }

    ##########################################################################

// Pages

    public function landing_page()
    {
        $data['slider'] = Slider::active()->orderBy('in_order_to')->get();

        // $blogs = Blog::latest()->limit(3)->get();

        return response()->json($data);
    }

    public function pages($id)
    {
        $page = Page::with('paragraph', 'image')->find($id);

        return response()->json(compact('page'));
    }

    public function informations()
    {
        $informations = Information::get();

        $data['phone']          = $informations->where('id', 1)->first()->value;
        $data['email']          = $informations->where('id', 2)->first()->value;
        $data['address']        = $informations->where('id', 3)->first()->value;
        // $data['description']    = $informations->where('id', 4)->first()->value;

        $social = SocialLink::get();

        $data['facebook']   = $social->where('id', 1)->first()->link;
        $data['twitter']    = $social->where('id', 2)->first()->link;
        $data['instagram']  = $social->where('id', 3)->first()->link;
        $data['linkedIn']   = $social->where('id', 4)->first()->link;

        return response()->json($data);
    }

    public function send_contact_message(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|min:3|max:191',
            'email'     => 'required|email|min:3|max:191',
            'phone'     => 'required',
            'subject'   => 'required|string|min:3|max:191',
            'message'   => 'required|string|min:3',
        ]);
        Contact::create($validated);

        return response()->json(['msg' => 'success']);
    }

    public function newsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|min:3|max:191|unique:newsletters,email',
        ]);
        Newsletter::create($validated);

        return response()->json(['msg' => 'success']);
    }

    public function metas()
    {
        $metas = Meta::get();

        return response()->json(compact('metas'));
    }

    public function blogs()
    {
        $blogs = Blog::latest()->paginate(8);

        return response()->json(compact('blogs'));
    }

    public function blog($id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json(compact('blog'));
    }


// Academies
    public function academies()
    {
        $branch = Branch::firstOrFail();
        $academies = $branch->academies->load('photos','schedules');

        return response()->json(compact('academies'));
    }

    public function academySchedule(Academy $academy)
    {
        $schedules = $academy->schedules;
        return response()->json(compact('schedules'));
    }

// Events
    public function events()
    {
        $events = Event::where('date', '>' , now())->get();

        return response()->json(compact('events'));
    }

    public function event(Event $event)
    {
        return response()->json(compact('event'));
    }

    public function upcominEvent()
    {
        $upcomingEvent = Event::query()
                        ->where('date' , '>', now())
                        ->orderBy('date')
                        ->first();

        return response()->json(compact('upcomingEvent'));
    }

    // Playgrounds
    public function playgrounds()
    {
        $playgrounds = Playground::with('playgroundType')->get();

        return response()->json(compact('playgrounds'));
    }

    public function playgroundReservedTimes(Playground $playground)
    {

        $reservedTimes = $playground->reservations->groupBy('date');
// dd($reservedTimes);
        return response()->json(compact('reservedTimes'));
    }
}
