<?php

namespace App\Http\Controllers\API;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\Meta;
use App\Models\News;
use App\Models\Page;
use App\Models\User;
use App\Models\Event;
use App\Models\Option;
use App\Models\Academy;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Newsletter;
use App\Models\Onboarding;
use App\Models\Playground;
use App\Models\SocialLink;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\PlaygroundType;
use App\Http\Controllers\Controller;
use App\Models\Offer;

class MainController extends Controller
{
    public function test()
    {
        $url = 'https://webhook.site/29e0b687-bd0b-47ae-b42c-9275dd3a2f0b';
        // $data = [
        //     'status_code' => 200,
        //     'status' => 'success',
        //     'message' => 'webhook send successfully',
        //     'extra_data' => [
        //         'first_name' => 'Harsukh',
        //         'last_name' => 'Makwana',
        //     ],
        // ];
        $data = User::all();
    	$json_array = json_encode($data);
        $curl = curl_init();
        $headers = ['Content-Type: application/json'];

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_array);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($http_code >= 200 && $http_code < 300) {
            echo "webhook send successfully.";
        } else {
            echo "webhook failed.";
        }

    }

    public function testWebhook()
    {
        if($json = json_decode(file_get_contents("php://input"), true)) {
            print_r($json);
            $data = $json;
        } else{
            $data = $json;
            print_r($data);
        }
        // User::create([
        //     'first_name' => request('before'),
        //     'last_name' => request('after'),
        // ]);
    }

    public function insertUsers()
    {
        // Validate Data
        $validated = request()->validate([
            'MemberData'                         => 'array|required',
            'MemberData.*.iMemberId'             => 'required',
            'MemberData.*.member_mobile'         => 'required',
            'MemberData.*.strCardNumber'         => 'required',
            'MemberData.*.dateCardDateValidFrom' => 'required',
            'MemberData.*.dateCardDateExpire'    => 'required',
            'MemberData.*.timeTimeFrom'          => 'required',
            'MemberData.*.timeTimeTo'            => 'required',
            'MemberData.*.strMemberName'         => 'required',
            'MemberData.*.iMemberType'           => 'required',
            'MemberData.*.dateBirthdate'         => 'required',
            'MemberData.*.boolMemberStatus'      => 'required',
            'MemberData.*.iMainMemberID'         => 'required',
            'MemberData.*.strImageName_DataSoft' => 'required',
            'MemberData.*.strImgURL_DataSoft'    => 'required',
        ]);

        // loop on request data
        foreach (request('MemberData') as  $user) {
            // insert users to database
            User::updateOrCreate(['member_mobile' => $user['member_mobile'] ],[
                'iMemberId'             => $user['iMemberId'],
                'strCardNumber'         => $user['strCardNumber'],
                'member_mobile'         => $user['member_mobile'],
                'dateCardDateValidFrom' => $user['dateCardDateValidFrom'],
                'dateCardDateExpire'    => $user['dateCardDateExpire'],
                'timeTimeFrom'          => $user['timeTimeFrom'],
                'timeTimeTo'            => $user['timeTimeTo'],
                'strMemberName'         => $user['strMemberName'],
                'iMemberType'           => $user['iMemberType'],
                'dateBirthdate'         => $user['dateBirthdate'],
                'boolMemberStatus'      => $user['boolMemberStatus'],
                'iMainMemberID'         => $user['iMainMemberID'],
                'strImageName_DataSoft' => $user['strImageName_DataSoft'],
                'strImgURL_DataSoft'    => $user['strImgURL_DataSoft'],
            ]);
        }

        // return response
        return response()->json(['message' => 'Users Inserted Successfuly']);
    }

    public function updateUsers()
    {
        // Validate Data
        $validated = request()->validate([
            'MemberData'                         => 'array|required',
            'MemberData.*.iMemberId'             => 'required|exists:users,iMemberId',
            'MemberData.*.strCardNumber'         => 'required',
            'MemberData.*.member_mobile'         => 'required',
            'MemberData.*.dateCardDateValidFrom' => 'required',
            'MemberData.*.dateCardDateExpire'    => 'required',
            'MemberData.*.timeTimeFrom'          => 'required',
            'MemberData.*.timeTimeTo'            => 'required',
            'MemberData.*.strMemberName'         => 'required',
            'MemberData.*.iMemberType'           => 'required',
            'MemberData.*.dateBirthdate'         => 'required',
            'MemberData.*.boolMemberStatus'      => 'required',
            'MemberData.*.iMainMemberID'         => 'required',
            'MemberData.*.strImageName_DataSoft' => 'required',
            'MemberData.*.strImgURL_DataSoft'    => 'required',
        ]);
        // loop on request data
        foreach (request('MemberData') as  $user) {
            // define user
            $selectedUser = User::where('iMemberId', $user['iMemberId'])->first();
            //  users to database
            $selectedUser->update([
                'iMemberId'             => $user['iMemberId'],
                'strCardNumber'         => $user['strCardNumber'],
                'member_mobile'         => $user['member_mobile'],
                'dateCardDateValidFrom' => $user['dateCardDateValidFrom'],
                'dateCardDateExpire'    => $user['dateCardDateExpire'],
                'timeTimeFrom'          => $user['timeTimeFrom'],
                'timeTimeTo'            => $user['timeTimeTo'],
                'strMemberName'         => $user['strMemberName'],
                'iMemberType'           => $user['iMemberType'],
                'dateBirthdate'         => $user['dateBirthdate'],
                'boolMemberStatus'      => $user['boolMemberStatus'],
                'iMainMemberID'         => $user['iMainMemberID'],
                'strImageName_DataSoft' => $user['strImageName_DataSoft'],
                'strImgURL_DataSoft'    => $user['strImgURL_DataSoft'],
            ]);
        }

        // return response
        return response()->json(['message' => 'Users Updated Successfuly']);
    }

    public function deleteUsers()
    {
        // Validate Data
        $validated = request()->validate([
            'MemberData'                      => 'array|required',
            'MemberData.*.iMemberId'          => 'required|exists:users,iMemberId',
        ]);
        // loop on request data
        foreach (request('MemberData') as  $user) {
            // define user
            $selectedUser = User::where('iMemberId', $user['iMemberId'])->first();
            //  users to database
            $selectedUser->delete();
        }
        // return response
        return response()->json(['message' => 'Users deleted Successfuly']);
    }

    ##########################################################################

    ################################# General ###################################

    public function wifiPassword()
    {
        $user = auth('api')->user();

            // Handle if the user not a member Or academy member ( 0 (Main) / 1 (Sub) / 2 (Academic) )
            if (!$user->iMemberId) {
                return response()->json(['msg' => 'You are not a member'], 403);
            }
            // Handle account status True (Active) / False (Hold)
            if (!$user->boolMemberStatus) {
                return response()->json(['msg' => 'Your account is not active'], 403);
            }

        $data['wifiName'] = Option::first()->wifi_name;
        $data['wifiPassword'] = Option::first()->wifi_password;
        return response()->json($data);
    }

    public function safetyRatio()
    {
        $data['safetyRatio'] = Option::first()->safety_ratio;
        return response()->json($data);
    }

    ################################### Pages ####################################

    public function webHome()
    {
        $data['events'] = Event::where('date', '>' , now())
                    ->orderBy('date')
                    ->limit(4)
                    ->get();

        $data['academies'] = Academy::with('photos','schedules')->get();

        $user = auth('api')->user();
        if ($user) {
            $data['user_academies'] = $user->academies;
        }
        $data['news'] = News::latest()->limit(4)->get();
        $data['safetyRatio'] = Option::first()->safety_ratio;
        $data['introVideoLink'] = Option::first()->intro_video_link;
        $data['gallery'] = Gallery::get();
        // $blogs = Blog::latest()->limit(3)->get();

        return response()->json($data);
    }

    public function landing_page()
    {
        // $data['slider'] = Slider::active()->orderBy('in_order_to')->get();
        // $data['events'] = Event::where('date', '>' , now())
        //             ->orderBy('date')
        //             ->limit(4)
        //             ->get();
        $data['news'] = News::latest()->limit(4)->get();
        $data['offers'] = Offer::latest()->limit(4)->get();
        $data['safetyRatio'] = Option::first()->safety_ratio;
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

    public function webAllNews()
    {
        $allNews = News::latest()->paginate(6);
        return response()->json(compact('allNews'));
    }

    public function allNews()
    {
        $allNews = News::latest()->get();
        return response()->json(compact('allNews'));
    }

    public function singleNews(News $news)
    {
        return response()->json(compact('news'));
    }

    public function offers()
    {
        $offers = Offer::with('category')->latest()->get();
        return response()->json(compact('offers'));
    }

    public function offer(Offer $offer)
    {
        $offer->load('category');
        return response()->json(compact('offer'));
    }

    public function faqs()
    {
        $faqs = Faq::get();
        return response()->json(compact('faqs'));
    }

    public function gallery()
    {
        $gallery = Gallery::get();
        return response()->json(compact('gallery'));
    }

    public function galleryWeb()
    {
        $gallery = Gallery::paginate(9);
        return response()->json(compact('gallery'));
    }

    public function onboardings()
    {
        $onboardings = Onboarding::get();
        return response()->json(compact('onboardings'));
    }

    ################################### Academies ####################################

    public function academies()
    {
        $data['academies'] = Academy::with('photos','schedules')->get();

        $user = auth('api')->user();
        if ($user) {
            $data['user_academies'] = $user->academies()->where('status', 1)->get();
        }

        return response()->json($data);
    }

    public function academy(Academy $academy)
    {
        $academy->load('photos','schedules');
        return response()->json(compact('academy'));
    }

    public function academySchedule(Academy $academy)
    {
        $schedules = $academy->schedules;
        return response()->json(compact('schedules'));
    }

    ################################### Events ####################################

    public function events()
    {

        $events = Event::with('prices.eventCategory')->where('date', '>' , now())->get();

        $upcomingEvent = Event::query()
                        ->with('prices.eventCategory')
                        ->where('date' , '>', now())
                        ->orderBy('date')
                        ->first();

        return response()->json(compact('events', 'upcomingEvent'));
    }

    public function eventsWeb()
    {

        $events = Event::with('prices.eventCategory')->where('date', '>' , now())->paginate(9);

        $upcomingEvent = Event::query()
                        ->with('prices.eventCategory')
                        ->where('date' , '>', now())
                        ->orderBy('date')
                        ->first();

        return response()->json(compact('events', 'upcomingEvent'));
    }

    public function event(Event $event)
    {
        $event->load('prices.eventCategory');
        return response()->json(compact('event'));
    }

    public function upcominEvent()
    {
        $upcomingEvent = Event::query()
                        ->with('prices.eventCategory')
                        ->where('date' , '>', now())
                        ->orderBy('date')
                        ->first();

        return response()->json(compact('upcomingEvent'));
    }

    ################################### Playgrounds ####################################

    public function playgrounds()
    {
        $playgrounds = Playground::with('playgroundType')->get();

        return response()->json(compact('playgrounds'));
    }

    public function playgroundTypes()
    {
        $playgroundTypes = PlaygroundType::with('playgrounds')->get();

        return response()->json(compact('playgroundTypes'));
    }

    ################################### Tickets ####################################

    public function ticketPrice()
    {
        $ticketPrice = Option::first()->visit_ticket_price;
        return response()->json(compact('ticketPrice'));
    }


}
