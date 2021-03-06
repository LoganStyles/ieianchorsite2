<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Registrationimage;
use App\Careers;
use App\Careerimage;
use App\Response;
use App\About;
use App\Aboutimage;
use App\Service;
use App\Serviceimage;
use App\Testimonial;
use App\Testimonialimage;
use App\Banner;
use App\Bannerimage;
use App\Slide;
use App\Slideimage;
use App\Award;
use App\Awardimage;
use App\Newsitem;
use App\Newsitemimage;
use App\Article;
use App\Articleimage;
use App\Faqcat;
use App\Faq;
use App\Board;
use App\Boardimage;
use App\Management;
use App\Managementimage;
use Session;
use Debugbar;
use Purifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AppController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function webRegister() {
        return view('/site/register');
    }

    private function checkLoggedStatus() {
        if (!$this->isLoggedIn()) {
            return redirect()->route('login');
        }
    }

    /*
     * handles file downloads
     * implement headers later
     */

    public function downloadFile($item) {
        $pathToFile = public_path('/site/downloads/' . $item);
        return response()->download($pathToFile);
    }

    public function viewFile($item) {
        $pathToFile = public_path('/site/downloads/' . $item);
        return response()->file($pathToFile);
    }


    public function fetchHomeData() {
        $home_data = $this->getHomePageData();
        return json_encode($home_data);
    }

    public function fetchPageData(Request $request) {
        $page = $request['page'];
        $page_data = $this->getPageData($page);
        return json_encode($page_data);
    }

    public function fetchPageDataNoImages(Request $request) {
        $page = $request['page'];
        $page_data = $this->getPageDataNoImages($page);
        return json_encode($page_data);
    }

    public function fetchLatestPricesById(Request $request) {
        $latest_id = $request['last_id'];
        $curr_latest_id = (intval($latest_id) > 0 ? $latest_id : 0);
        $items = DB::table('unit_prices')
                ->where('id', '>=', $curr_latest_id)
                ->orderBy('id', 'desc')
                ->first();

        $res = (array) $items;
        return json_encode($res);
    }


    public function showPage($page = 'index', $sub_item = NULL, $data = []) {
        /* if its an admin page check if logged in, then redirect to requested page */
        //get default data
        $path = '/site/' . $page;
        $items = $page . 's';

        if ($sub_item) {
            //get details page data
            $path = '/site/' . $page . '_details';
            $data['listed_items'] = $this->showPaginatedList($page); //get paginated range    
            $data['fetched_item'] = $this->getDBData($page, $sub_item, false); //get selected item details,set page
            $page = $page . "_details";
        } else {
            //site pages
            switch ($page) {
                case 'index':
                case 'investment':
                    break;
                case 'show_pension_calculator':
                    $path = '/site/pension_calculator';
                    $data['resultitems'] = array('lumpsum' => '0.00',
                        'monthly_pension' => '0.00',
                        'qualify_for_lumpsum' => 'No',
                        'qualify_for_programmed_withdrawal' => 'No',
                        'total_package' => '0.00');
                    break;
                case 'register':
                case 'careers':
                case 'feedback':
                    $data['states'] = $this->getDBData('ref_states_team', $sub_item, true);
                    break;            
                    

                case 'states':
                    $this->checkLoggedStatus();
                    $data['states'] = DB::table('ref_states_teams')->paginate(5);
                    $path = '/backend/' . $page;
                    break;
                case 'activity':/* system generated */
                case 'setup':
                case 'dashboard':
                    $this->checkLoggedStatus();
                    $path = '/backend/' . $page;
                    break;
                case 'financial_site':
                    $path = '/site/' . 'financial_details';
                    break;
                case 'banner':
                case 'award':
                    $this->checkLoggedStatus();
                    $path = '/backend/' . $page;
                    $data['moduleitems'] = $this->getDBData($page);
                    break;
                case 'management':
                case 'board':
                case 'slide':
                case 'service':
                case 'about':
                case 'article':
                case 'newsitem':
                case 'testimonial':
                case 'faqcat':
                    $this->checkLoggedStatus();
                    $path = '/backend/template';
                    $data['moduleitems'] = $this->getDBPaginatedData($page);
                    break;
                case 'faq':
                    $this->checkLoggedStatus();
                    $path = '/backend/' . $page;
                    $data['moduleitems'] = $this->getDBPaginatedData($page);
                    break;
                default:
                    $this->checkLoggedStatus();
                    break;
            }
        }
        return view($path, [
            'data' => $data,
            'page_name' => $page
        ]);
    }

    /* process contact/enquiries */

    public function processContact(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'feedback_type' => 'required',
            'details' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required'
        ]);
        
        //clean with Purifier facade            
        $cleaned_name = Purifier::clean($request['name']);
        $cleaned_pin = Purifier::clean($request['pin']);
        $cleaned_phone = Purifier::clean($request['phone']);
        $cleaned_employer = Purifier::clean($request['employer']);
        $cleaned_subject = Purifier::clean($request['subject']);
        $cleaned_details = Purifier::clean(trim($request['details']));
        if ($request['id'] > 0) {
            //already existing module item            
            Response::where('id', $request['id'])->update([
                'name' => $cleaned_name,
                'pin' => $cleaned_pin,
                'employer' => $cleaned_employer,
                'feedback_type' => $request['feedback_type'],
                'details' => $cleaned_details,
                'email' => $request['email'],
                'phone' => $request['phone'],
                'subject' => $cleaned_subject
            ]);
        } else {
            $moduleitem = new Response();
            //insert modules            
            $moduleitem->name = $cleaned_name;
            $moduleitem->pin = $cleaned_pin;
            $moduleitem->employer = $cleaned_employer;
            $moduleitem->details = $cleaned_details;
            $moduleitem->email = $request['email'];
            $moduleitem->phone = $request['phone'];
            $moduleitem->subject = $request['subject'];
            $moduleitem->feedback_type = $request['feedback_type'];
            $moduleitem->save();
        }

        //send cservice email
        $data = array(
            'email' => 'cservice@ieianchorpensions.com',
            'phone' => $cleaned_phone,
            'pin' => $cleaned_pin,
            'employer' => $cleaned_employer,
            'details' => $cleaned_details,
            'subject' => 'Contact Us(' . ucwords(trim($request['feedback_type'])) . ') - ' . $cleaned_subject,
            'client_email' => trim($request['email']),
            'feedback_type' => trim($request['feedback_type']),
            'created_at' => Date('Y-m-d'),
            'clientname' => $cleaned_name
        );

        Mail::send('emails.mailCservice', $data, function($message) use ($data) {
            $message->from($data['client_email']);
            $message->to($data['email']);
            $message->subject($data['subject']);
        });

        $request->session()->flash('response_status', 'Thank you,your feedback has been received.');
        return redirect()->back();
    }

    /* process site info */

    public function updateSite(Request $request) {
        if ($request['id'] > 0) {
            $this->validate($request, [
                'url' => 'required|url',
                'email' => 'required|email',
                'opening' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            ]);

            Site::where('id', $request['id'])->update([
                'url' => $request['url'],
                'email' => $request['email'],
                'phone1' => $request['phone1'],
                'phone2' => $request['phone2'],
                'facebook' => $request['facebook'],
                'twitter' => $request['twitter'],
                'instagram' => $request['instagram'],
                'youtube' => $request['youtube'],
                'linkedin' => $request['linkedin'],
                'opening' => $request['opening'],
                'client_url' => $request['client_url'],
                'office' => $request['office']
            ]);

            //if image exists
            $image = $request->file('image');
            if (!empty($image)) {
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/site/img');
                $image->move($destinationPath, $input['imagename']);

                //insert the image
                $siteimage = new Siteimages();
                $siteimage->filename = $input['imagename'];
                $siteimage->itemid = $request['id'];
                $siteimage->alt = $request['caption'];
                $siteimage->caption = $request['caption'];
                $siteimage->main = $request['main'];
                $siteimage->save();
            }
        } else {
            $this->validate($request, [
                'url' => 'required|url',
                'email' => 'required|email',
                'opening' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            ]);

            //insert siteitems                    
            $siteinfo = new Site();
            $siteinfo->url = $request['url'];
            $siteinfo->email = trim($request['email']);
            $siteinfo->phone1 = $request['phone1'];
            $siteinfo->facebook = $request['facebook'];
            $siteinfo->twitter = $request['twitter'];
            $siteinfo->instagram = $request['instagram'];
            $siteinfo->youtube = $request['youtube'];
            $siteinfo->linkedin = $request['linkedin'];
            $siteinfo->opening = $request['opening'];
            $siteinfo->office = $request['office'];
            $siteinfo->client_url = $request['client_url'];
            $siteinfo->save();

            //if image exists
            $image = $request->file('image');
            if (!empty($image)) {
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/site/img');
                $image->move($destinationPath, $input['imagename']);

                //save the image
                $siteimage = new Siteimages();
                $siteimage->filename = $input['imagename'];
                $siteimage->itemid = $siteinfo->id;
                $siteimage->alt = $request['caption'];
                $siteimage->caption = $request['caption'];
                $siteimage->main = $request['main'];
                $siteimage->save();
            }
        }
        return redirect()->back();
    }

    public function processRegister(Request $request) {

        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'states' => 'required',
            'phone' => 'required',
            'employer' => 'required',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'CaptchaCode' => 'required|valid_captcha'
        ]);

        $moduleitem = new Registration();
        $moduleimage = new Registrationimage();

        //insert modules            
        $moduleitem->fname = trim($request['fname']);
        $moduleitem->lname = trim($request['lname']);
        $moduleitem->email = trim($request['email']);
        $moduleitem->phone = trim($request['phone']);

        $client_dob = ($request['dob']) ? ($request['dob']) : (date('m/d/Y'));
        $moduleitem->dob = date('Y-m-d', strtotime($client_dob));

        $moduleitem->employer = trim($request['employer']);
        $moduleitem->employer_address = trim($request['employer_address']);
        $moduleitem->states = $request['states'];
        $moduleitem->oname = trim($request['oname']);
        $moduleitem->validated = 'no';
        $moduleitem->save();

        //if image exists
        $image = $request->file('image');
        if (!empty($image)) {
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

            //$destinationPath = public_path('/site/img');
            $destinationPath =public_path('/site/client_imgs/');
            $image->move($destinationPath, $input['imagename']);

            //save the image                
            $moduleimage->filename = $input['imagename'];
            $moduleimage->itemid = $moduleitem->id;
            $moduleimage->alt = $request['caption'];
            $moduleimage->caption = $request['caption'];
            $moduleimage->main = $request['main'];
            $moduleimage->save();
        }

        //select contact email & send mail
        $agent_details = DB::table('ref_states_teams')->select('contact_email')->where('title', $request['states'])
                ->get();

        foreach ($agent_details as $object) {
            $agent_details_arr[] = (array) $object;
        }
        $agent_email = $agent_details_arr[0]['contact_email'];

        if ($agent_email) {
            //send client validation email
            $data = array(
                'email' => 'register@ieianchorpensions.com',
                'phone' => trim($request['phone']),
                'states' => trim($request['states']),
                'subject' => 'RSA Generation',
                'client_email' => trim($request['email']),
                'agent_email' => trim($agent_email),
                'clientname' => trim($request['fname']) . ' ' . trim($request['lname'])
            );

            Mail::send('emails.mailEvent', $data, function($message) use ($data) {
                $message->from($data['email']);
                $message->to($data['agent_email']);
                $message->subject('RSA Registration');
            });
            $request->session()->flash('reg_status', 'Registration was successful!');
        } else {
            $request->session()->flash('reg_status', 'No Agent assigned to the selected location!');
        }


        return redirect()->back();
    }

    public function processCareers(Request $request) {

        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'available_startdate' => 'required',
            'states' => 'required',
            'phone' => 'required',
            'salary' => 'required',
            'email' => 'required|email',
            'cv' => 'file|mimes:jpeg,jpg,png,gif,pdf|max:2048',
            'letter' => 'file|mimes:jpeg,jpg,png,gif,pdf|max:2048',
            'CaptchaCode' => 'required|valid_captcha'
        ]);

        $moduleitem = new Careers();
        $moduleimage = new Careerimage();

        //insert modules            
        $moduleitem->fname = trim($request['fname']);
        $moduleitem->lname = trim($request['lname']);
        $moduleitem->email = trim($request['email']);
        $moduleitem->phone = trim($request['phone']);

        $client_dob = ($request['dob']) ? ($request['dob']) : (date('m/d/Y'));
        $moduleitem->dob = date('Y-m-d', strtotime($client_dob));
        
        $client_start_date = ($request['available_startdate']) ? ($request['available_startdate']) : (date('m/d/Y'));
        $moduleitem->available_startdate = date('Y-m-d', strtotime($client_start_date));

        $moduleitem->salary = trim($request['salary']);
        $moduleitem->states = $request['states'];
        $moduleitem->oname = trim($request['oname']);
        $moduleitem->validated = 'no';
        $moduleitem->save();

        //if image exists
        $cv = $request->file('cv');
        $letter = $request->file('letter');
        if (!empty($cv) && !empty($letter)) {
            $input['cvname'] = time().'CV' . '.' . $cv->getClientOriginalExtension();
            $input['lettername'] = time().'L' . '.' . $letter->getClientOriginalExtension();

            $destinationPath =public_path('/site/client_imgs/');
            $cv->move($destinationPath, $input['cvname']);
            $letter->move($destinationPath, $input['lettername']);

            //save the image                
            $moduleimage->filename_cv = $input['cvname'];
            $moduleimage->filename_letter = $input['lettername'];
            $moduleimage->itemid = $moduleitem->id;
            $moduleimage->alt = $request['caption'];
            $moduleimage->caption = $request['caption'];
            $moduleimage->main = $request['main'];
            $moduleimage->save();
        }
        
        //send client validation email
//            $data = array(
//                'email' => 'careers@ieianchorpensions.com',
//                'phone' => trim($request['phone']),
//                'states' => trim($request['states']),
//                'subject' => 'IEI-Anchor Pensions Careers',
//                'client_email' => trim($request['email']),
//                'clientname' => trim($request['fname']) . ' ' . trim($request['lname'])
//            );
//
//            Mail::send('emails.mailEvent', $data, function($message) use ($data) {
//                $message->from($data['email']);
//                $message->to($data['client_email']);
//                $message->subject('IEI-Anchor Pensions Careers');
//            });
            $request->session()->flash('career_status', 'Submission was successful!');

        return redirect()->back();
    }

    public function processClientTestimonial(Request $request) {
        $this->validate($request, [
            'title' => 'required|unique:testimonials',
            'email' => 'required|email',
            'position' => 'required|integer',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'CaptchaCode' => 'required|valid_captcha'
        ]);

        $moduleitem = new Testimonial();
        $moduleimage = new Testimonialimage();

        $conv_display = (!empty($request['display']) ? ($request['display']) : ('0'));
        //clean with Purifier facade            
        $cleaned_title = Purifier::clean($request['title']);
        $cleaned_details = Purifier::clean(trim($request['details']));

        $moduleitem->title = $cleaned_title;
        $moduleitem->details = $cleaned_details;
        $moduleitem->position = $request['position'];
        $moduleitem->display = $conv_display;
        $moduleitem->link_label = preg_replace('/[^A-Za-z0-9]/', '_', strtolower($cleaned_title));
        $moduleitem->excerpt = substr(strip_tags($cleaned_details), 0, 100);
        $moduleitem->save();

        //if image exists
        $image = $request->file('image');
        if (!empty($image)) {
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

            //$destinationPath = public_path('/site/img');
            $destinationPath =public_path('/site/client_imgs/');
            $image->move($destinationPath, $input['imagename']);

            //save the image                
            $moduleimage->filename = $input['imagename'];
            $moduleimage->itemid = $moduleitem->id;
            $moduleimage->alt = "";
            $moduleimage->caption = "";
            $moduleimage->main = "0";
            $moduleimage->save();
        }

        $request->session()->flash('feedback_status', 'Thank you for your feedback.');
        return redirect()->back();
    }

    public function pensionCalculator(Request $request) {
        $this->validate($request, [
            'rsa_balance' => 'required|numeric',
            'monthly_contribution' => 'required|numeric',
            'years_before_retirement' => 'required|numeric',
            'percentage_return' => 'required|numeric'
        ]);

        //default values
        $data = [];
        $result = array('lumpsum' => '0.00',
            'monthly_pension' => '0.00',
            'qualify_for_lumpsum' => 'No',
            'qualify_for_programmed_withdrawal' => 'No',
            'total_package' => '0.00');

        $rsaBalance = $request['rsa_balance'];
        $monthlyContribution = $request['monthly_contribution'];
        $yearsBeforeRetirement = $request['years_before_retirement'];
        $percentageReturn = $request['percentage_return'];


        if (is_numeric($rsaBalance) && is_numeric($monthlyContribution) && is_numeric($yearsBeforeRetirement) && is_numeric($percentageReturn)) {
            $percentageReturn = $percentageReturn / 100;
            $totalPackage = ($monthlyContribution * $yearsBeforeRetirement * 12) + ($rsaBalance * pow((1 + $percentageReturn), $yearsBeforeRetirement));

            $result['total_package'] = number_format($totalPackage, 2);

            if ($totalPackage > 550000) {
                $result['qualify_for_lumpsum'] = 'Yes';
                $result['lumpsum'] = number_format(($totalPackage * .25), 2);
                $result['qualify_for_programmed_withdrawal'] = 'Yes';
                $result['monthly_pension'] = number_format(((0.75 * $totalPackage) / 120), 2);
            } else {
                $result['qualify_for_lumpsum'] = 'No';
                $result['lumpsum'] = $totalPackage;
                $result['qualify_for_programmed_withdrawal'] = 'No';
            }
        }

        $page = "pension_calculator";
        $data['resultitems'] = $result;
        $data['siteitems'] = $this->getDBData('site');
        $data['services'] = $this->getDBData('service');
        // $data['newsitem'] = $this->latest_news;
        $path = '/site/' . $page;

        return view($path, [
            //'prices' => $this->latest_prices,
            'data' => $data,
            'page_name' => $page
        ]);
    }

    public function processStates(Request $request) {
        if ($request['id'] > 0) {//validate and already existing module item
            $this->validate($request, [
                'contact_email' => 'required'
            ]);

            DB::table('ref_states_teams')
                    ->where('id', $request['id'])
                    ->update(['team_code' => strtoupper($request['team_code']),
                        'team_name' => strtoupper($request['team_name']),
                        'contact_email' => $request['contact_email']
            ]);
        } else {
            //validate not existing module item
            $this->validate($request, [
                'contact_email' => 'required'
            ]);

            DB::table('ref_states_teams')
                    ->insert(['team_code' => strtoupper($request['team_code']),
                        'team_name' => strtoupper($request['team_name']),
                        'contact_email' => $request['contact_email']
            ]);
        }

        return redirect()->back();
    }

    /* process modules create & edit */

    public function processModule(Request $request) {
        //validate module item
        $req_type = $request['type'];
        if ($request['id'] > 0) {
            $title_required = "required";
        } else {
            $title_required = "required|unique:" . $req_type . "s";
        }

        if ($request['type'] != "faq") {
            $this->validate($request, [
                'title' => $title_required,
                'position' => 'required|integer',
                'display' => 'boolean',
                'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            ]);
        }

        $conv_display = (!empty($request['display']) ? ($request['display']) : ('0'));
        //clean with Purifier facade            
        $cleaned_title = Purifier::clean($request['title']);
        $cleaned_details = Purifier::clean(trim($request['details']));

        if ($request['id'] > 0) {
            //store in array
            $req_data = [
                'title' => $cleaned_title,
                'details' => $cleaned_details,
                'position' => $request['position'],
                'display' => $conv_display,
                'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($cleaned_title)),
                'excerpt' => substr(strip_tags($cleaned_details), 0, 100)
            ];

            //chk for module type
            switch ($request['type']) {
                case'about':
                    About::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Aboutimage();
                    break;

                case'service':
                    Service::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Serviceimage();
                    break;

                case'testimonial':
                    Testimonial::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Testimonialimage();
                    break;

                case'banner':
                    $req_data['url'] = (filter_var($request['url'], FILTER_VALIDATE_URL) !== false) ? ($request['url']) : "";
                    Banner::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Bannerimage();
                    break;

                case'slide':
                    $req_data['url'] = (filter_var($request['url'], FILTER_VALIDATE_URL) !== false) ? ($request['url']) : "";
                    Slide::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Slideimage();
                    break;

                case'award':
                    $req_data['url'] = (filter_var($request['url'], FILTER_VALIDATE_URL) !== false) ? ($request['url']) : "";
                    Award::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Awardimage();
                    break;

                case'board':
                    Board::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Boardimage();
                    break;

                case'management':
                    Management::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Managementimage();
                    break;

                case'newsitem':
                    Newsitem::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Newsitemimage();
                    break;

                case'article':
                    Article::where('id', $request['id'])->update($req_data);
                    $moduleimage = new Articleimage();
                    break;

                case'faqcat':
                    Faqcat::where('id', $request['id'])->update($req_data);
                    break;

                case'faq':
                    $req_data = [
                        'question' => $cleaned_title,
                        'answer' => $cleaned_details,
                        'category_id' => $request['category'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    Faq::where('id', $request['id'])->update($req_data);
                    break;
            }

            //if image exists
            $image = $request->file('image');
            if (!empty($image)) {
                //chk if a prev featured image exists & delete it
                $del_status = $this->deleteImages($request['type'], $request['id']);
                if ($del_status) {
                    //create a new featured image name
                    $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('/site/img');
                    $image->move($destinationPath, $input['imagename']);

                    //insert the image         
                    $cleaned_caption = Purifier::clean($request['caption']);
                    $moduleimage->filename = $input['imagename'];
                    $moduleimage->itemid = $request['id'];
                    $moduleimage->alt = $cleaned_caption;
                    $moduleimage->caption = $cleaned_caption;
                    $moduleimage->main = '0';
                    $moduleimage->save();
                }
            }
        } else {
            //chk for module type
            switch ($request['type']) {
                case'about':
                    $moduleitem = new About();
                    $moduleimage = new Aboutimage();
                    break;

                case'service':
                    $moduleitem = new Service();
                    $moduleimage = new Serviceimage();
                    break;

                case'testimonial':
                    $moduleitem = new Testimonial();
                    $moduleimage = new Testimonialimage();
                    break;

                case'banner':
                    $moduleitem = new Banner();
                    $moduleitem->url = $request['url'];
                    $moduleimage = new Bannerimage();
                    break;

                case'slide':
                    $moduleitem = new Slide();
                    $moduleitem->url = $request['url'];
                    $moduleimage = new Slideimage();
                    break;

                case'award':
                    $moduleitem = new Award();
                    $moduleitem->url = $request['url'];
                    $moduleimage = new Awardimage();
                    break;

                case'newsitem':
                    $moduleitem = new Newsitem();
                    $moduleimage = new Newsitemimage();
                    break;

                case'article':
                    $moduleitem = new Article();
                    $moduleimage = new Articleimage();
                    break;

                case'board':
                    $moduleitem = new Board();
                    $moduleimage = new Boardimage();
                    break;

                case'management':
                    $moduleitem = new Management();
                    $moduleimage = new Managementimage();
                    break;

                case'faqcat':
                    $moduleitem = new Faqcat();
                    break;

                case'faq':
                    $moduleitem = new Faq();
                    break;
            }

            //insert modules   
            if ($request['type'] != "faq") {
                $moduleitem->title = $cleaned_title;
                $moduleitem->details = $cleaned_details;
                $moduleitem->position = $request['position'];
                $moduleitem->display = $conv_display;
                $moduleitem->link_label = preg_replace('/[^A-Za-z0-9]/', '_', strtolower($cleaned_title));
                $moduleitem->excerpt = substr(strip_tags($cleaned_details), 0, 100);
            } else {
                $moduleitem->question = $cleaned_title;
                $moduleitem->answer = $cleaned_details;
                $moduleitem->category_id = $request['category'];
            }


            $moduleitem->save();
            //if image exists
            $image = $request->file('image');
            if (!empty($image)) {
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/site/img');
                $image->move($destinationPath, $input['imagename']);

                //save the image           
                $cleaned_caption = Purifier::clean($request['caption']);
                $moduleimage->filename = $input['imagename'];
                $moduleimage->itemid = $moduleitem->id;
                $moduleimage->alt = $cleaned_caption;
                $moduleimage->caption = $cleaned_caption;
                $moduleimage->main = '0';
                $moduleimage->save();
            }
        }

        return redirect()->back();
    }

    /* deletes items */

    public function deleteItem($item_type, $id) {
        //chk for module type
        $del_type = $item_type;
        $imgarrays = array();
        $del_status = false;

        if ($del_type != "faqcat" && $del_type != "faq") {
            $itemimages = $del_type . 'images';

            //get filename and remove it if exists
            $moduleimages = DB::table($itemimages)
                    ->select('filename')
                    ->where('itemid', $id)
                    ->get();

            foreach ($moduleimages as $object) {
                $imgarrays[] = (array) $object;
            }

            foreach ($imgarrays as $image) {
                //delete file
                $deletePath = public_path('/site/img/' . $image['filename']);
                Storage::delete($deletePath);
            }
        }

        //remove from tbls
        switch ($del_type) {
            case'about':
                $moduleitem = About::find($id);
                $moduleitem->delete();
                Aboutimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'service':
                $moduleitem = Service::find($id);
                $moduleitem->delete();
                Serviceimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'testimonial':
                $moduleitem = Testimonial::find($id);
                $moduleitem->delete();
                Testimonialimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'banner':
                $moduleitem = Banner::find($id);
                $moduleitem->delete();
                Bannerimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'slide':
                $moduleitem = Slide::find($id);
                $moduleitem->delete();
                Slideimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'award':
                $moduleitem = Award::find($id);
                $moduleitem->delete();
                Awardimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'board':
                $moduleitem = Board::find($id);
                $moduleitem->delete();
                Boardimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'management':
                $moduleitem = Management::find($id);
                $moduleitem->delete();
                Managementimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'newsitem':
                $moduleitem = Newsitem::find($id);
                $moduleitem->delete();
                Newsitemimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'article':
                $moduleitem = Article::find($id);
                $moduleitem->delete();
                Articleimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'faqcat':
                $moduleitem = Faqcat::find($id);
                $moduleitem->delete();
                $del_status = true;
                break;

            case'faq':
                $moduleitem = Faq::find($id);
                $moduleitem->delete();
                $del_status = true;
                break;

            default:
                DB::table($del_type)->where('id', '=', $id)->delete();
                $del_status = true;
                break;
        }
        return $del_status;
    }

    /* deletes images */

    public function deleteImages($item_type, $id) {
        //chk for module type
        $del_type = $item_type;
        $imgarrays = array();
        $del_status = false;

        if ($del_type != "faqcat") {
            $itemimages = $del_type . 'images';

            //get filename and remove it if exists
            $moduleimages = DB::table($itemimages)
                    ->select('filename')
                    ->where('itemid', $id)
                    ->get();

            foreach ($moduleimages as $object) {
                $imgarrays[] = (array) $object;
            }

            foreach ($imgarrays as $image) {
                //delete file
                $deletePath = public_path('/site/img/' . $image['filename']);
                Storage::delete($deletePath);
            }
        }

        //remove from tbls
        switch ($del_type) {
            case'about':
                Aboutimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'service':
                Serviceimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'testimonial':
                Testimonialimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'banner':
                Bannerimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'slide':
                Slideimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'award':
                Awardimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'board':
                Boardimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'management':
                Managementimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'newsitem':
                Newsitemimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'article':
                Articleimage::where('itemid', $id)->delete();
                $del_status = true;
                break;

            case'faqcat':
                $del_status = true;
                break;
        }
        return $del_status;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        if (session()->has('delete_group') && session('delete_group') == 1) {//can delete
            $del_status = $this->deleteItem($request['type'], $request['id']);
        } else {
            $request->session()->flash('del_status', 'You are not authorised to perform this action!');
        }

        return redirect()->back();
    }

    public function fetchRangeOfPrices(Request $request) {
        //fetch range of unit prices
        $result = [];
        $from_date = ($request['startDate']) ? ($request['startDate']) : (date('m/d/Y'));
        $to_date = ($request['endDate']) ? ($request['endDate']) : (date('m/d/Y'));

        if (!($request['startDate']) || !($request['endDate'])) {
            $range_of_prices = DB::table('unit_prices')
                    ->orderBy('report_date', 'desc')
                    ->take(7)
                    ->get();
        } else {
            $from_date = ($request['startDate']) ? ($request['startDate']) : (date('m/d/Y'));
            $to_date = ($request['endDate']) ? ($request['endDate']) : (date('m/d/Y'));

            $from = date('Y-m-d' . ' 00:00:00', strtotime($from_date));
            $to = date('Y-m-d' . ' 00:00:00', strtotime($to_date));

            $range_of_prices = DB::table('unit_prices')
                    ->whereBetween('report_date', [$from, $to])
                    ->orderBy('report_date', 'desc')
                    ->get();
        }

        if ($range_of_prices) {
            $result = $range_of_prices;
        }
        return json_encode($result);
    }

}
