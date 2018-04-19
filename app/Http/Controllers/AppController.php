<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Registration;
use App\Registrationimage;
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
use App\Board;
use App\Boardimage;
use App\Management;
use App\Managementimage;
use Session;
use Debugbar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AppController extends BaseController {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function webRegister(){
        return view('/site/register');
    }
    
    private function checkLoggedStatus() {
        if (!$this->isLoggedIn()) {return redirect()->route('login');}
    }
    
    /*
     * handles file downloads
     * implement headers later
     */
    public function downloadFile($item){
        $pathToFile=public_path('/site/downloads/'.$item);
        return response()->download($pathToFile);
    }

    public function showPage($page, $sub_item = NULL, $data = []) {
        /*if its an admin page check if logged in, then redirect to requested page */        
            //get default data
            $data['siteitems'] = $this->getDBData('site');
            $data['services'] = $this->getDBData('service');
            $data['newsitem'] = $this->latest_news;
            $path = '/site/' . $page;
            $items = $page . 's';

            if ($sub_item) {
                //get details page data
                $path = '/site/' . $page.'_details';
                $data['listed_items'] = $this->showPaginatedList($page);//get paginated range    
                $data['fetched_item'] = $this->getDBData($page, $sub_item, false);//get selected item details,set page
                //print_r($data['fetched_item'][0]);exit;
                $page=$page."_details";
            } else {
                //site pages
                switch ($page) {
                    case 'index':
                    case 'investment':
                        $data['testimonials'] = $this->getDBData('testimonial');
                        $data['banners'] = $this->getDBData('banner');
                        $data['slides'] = $this->getDBData('slide');
                        $data['awards'] = $this->getDBData('award');
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
                    case 'faq_site':
                        $data['moduleitems']= DB::table('faqcats')->select('*')->distinct()->get();
                        break;
                    case 'download_site':
                        $data['moduleitems']= DB::table('downloadcats')->select('*')->distinct()->get();
                        break;
                    case 'financial_site':
                        $data['moduleitems']= DB::table('financials')->select('*')->distinct()->get();
                        break;
                    case 'branch_site':
                        $data['moduleitems']= DB::table('branches')->select('*')->distinct()->get();
                        break;
                    case 'about_site':
                        $data['moduleitems'] = $this->getDBData('about');
                        break;
                    case 'board_site':
                        $data['moduleitems'] = $this->getDBData('board');
                        break;
                    case 'management_site':
                        $data['moduleitems'] = $this->getDBData('management');
                        break;
                    case 'service_site':
                        $data['moduleitems'] = $this->getDBData('service');
                        break;
                    case 'newsitem_site':
                        $data['moduleitems'] = $this->getDBData('newsitem');
                        break;
                    case 'article_site':
                        $data['moduleitems'] = $this->getDBData('article');
                        break;                                        
                    case 'testimonial':
                    case 'banner':
                    case 'slide':
                    case 'award':                
                    case 'board':
                    case 'management':
                        $this->checkLoggedStatus();
                        $path = '/backend/' . $page;
                        $data['moduleitems'] = $this->getDBData($page);
                        break;
                    case 'service':
                    case 'about':
                    case 'article':
                    case 'newsitem':
                    case 'faqcat':
                        $this->checkLoggedStatus();
                        $path = '/backend/' . $page;
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
                'prices' => $this->latest_prices,
                'data' => $data,
                'page_name' => $page
            ]);
    }
    
    /* process contact/enquiries */
    public function processContact(Request $request) {
        if ($request['id'] > 0) {//validate and already existing module item
            $this->validate($request, [
                'name' => 'required',
                'feedback_type' => 'required',
                'details' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subject' => 'required'
            ]);
                        
            Response::where('id', $request['id'])->update([
                'name' => $request['name'],
                'pin' => $request['pin'],
                'employer' => $request['employer'],
                'feedback_type' => $request['type'],
                'details' => trim($request['details']),
                'email' => $request['email'],
                'phone' => $request['phone'],
                'subject' => $request['subject']
            ]);
            
        } else {
            //validate not existing module item
            $this->validate($request, [
                'name' => 'required',
                'feedback_type' => 'required',
                'details' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subject' => 'required'
            ]);
            
            $moduleitem = new Response();            

            //insert modules            
            $moduleitem->name = $request['name'];
            $moduleitem->pin = $request['pin'];
            $moduleitem->employer = $request['employer'];
            $moduleitem->details = trim($request['details']);
            $moduleitem->email = $request['email'];
            $moduleitem->phone = $request['phone'];
            $moduleitem->subject = $request['subject'];
            $moduleitem->feedback_type = $request['feedback_type'];
            $moduleitem->save();
        }
        $request->session()->flash('response_status', 'Thank You,your Feedback has been received.');
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
        
        $client_dob  = ($request['dob'])?($request['dob']):(date('m/d/Y'));
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

            $destinationPath = public_path('/site/img');
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
        $agent_details=DB::table('ref_states_teams')->select('contact_email')->where('title', $request['states'])
                ->get();
        
        foreach ($agent_details as $object) {
            $agent_details_arr[] = (array) $object;
        }
        $agent_email=$agent_details_arr[0]['contact_email'];
        
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
        }else{
            $request->session()->flash('reg_status', 'No Agent assigned to the selected location!');
        }


        return redirect()->back();
    }
    
    public function processClientTestimonial(Request $request) {   
        $this->validate($request, [
            'title' => 'required|unique:testimonials',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'CaptchaCode' => 'required|valid_captcha'
        ]);  

        $moduleitem = new Testimonial();
        $moduleimage = new Testimonialimage();
        
        $moduleitem->title = $request['title'];
        $moduleitem->details = trim($request['details']);
        $moduleitem->position = $request['position'];
        $moduleitem->display = (!empty($request['display'])?($request['display']):('0'));
        $moduleitem->link_label = preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title']));
        $moduleitem->excerpt = substr($request['details'], 0, 100);
        $moduleitem->save();
        
        //if image exists
        $image = $request->file('image');
        if (!empty($image)) {
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/site/img');
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
        
        $rsaBalance=$request['rsa_balance'];
        $monthlyContribution=$request['monthly_contribution'];
        $yearsBeforeRetirement=$request['years_before_retirement'];
        $percentageReturn=$request['percentage_return'];
        
        
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
        $data['newsitem'] = $this->latest_news;
        $path = '/site/' . $page;
        
        return view($path, [
            'prices' => $this->latest_prices,
            'data' => $data,
            'page_name' => $page
        ]);
    }

//    public function pensionCalculator(Request $request) {
//        //default values
//        $data = [];
//        $result = array('lumpsum' => '0.00',
//            'monthly_pension' => '0.00',
//            'qualify_for_lumpsum' => 'No',
//            'qualify_for_programmed_withdrawal' => 'No',
//            'total_package' => '0.00');
//
//        $this->validate($request, [
//            'rsa_balance' => 'numeric',
//            'monthly_contribution' => 'numeric',
//            'years_before_retirement' => 'numeric',
//            'percentage_return' => 'numeric'
//        ]);
//
//        $percentageReturn = ($request['percentage_return']) / 100;
//        $totalPackage = ($request['monthly_contribution'] * $request['years_before_retirement'] * 12) + ($request['rsa_balance'] * pow((1 + $request['percentage_return']), $request['years_before_retirement']));
//
//        //format & set total package
//        $result['total_package'] = number_format($totalPackage, 2);
//
//        if ($totalPackage > 550000) {
//            $result['qualify_for_lumpsum'] = 'Yes';
//            $result['lumpsum'] = number_format(($totalPackage * .25), 2);
//            $result['qualify_for_programmed_withdrawal'] = 'Yes';
//            $result['monthly_pension'] = number_format(((0.75 * $totalPackage) / 120), 2);
//        } else {
//            $result['qualify_for_lumpsum'] = 'No';
//            $result['lumpsum'] = $totalPackage;
//            $result['qualify_for_programmed_withdrawal'] = 'No';
//        }
//        $page = "pension_calculator";
//        $data['resultitems'] = $result;
//        $data['siteitems'] = $this->getDBData('site');
//        $data['services'] = $this->getDBData('service');
//        $data['newsitem'] = $this->latest_news;
//        $path = '/site/' . $page;
//
//        return view($path, [
//            'prices' => $this->latest_prices,
//            'data' => $data,
//            'page_name' => $page
//        ]);
//    }

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
        if ($request['id'] > 0) {//validate and already existing module item
            $this->validate($request, [
                'title' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            ]);

            //chk for module type
            switch ($request['type']) {//chk for module type
                case'about':
                    About::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Aboutimage();
                    break;

                case'service':
                    Service::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Serviceimage();
                    break;

                case'testimonial':
                    Testimonial::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Testimonialimage();
                    break;
                
                case'banner':
                    Banner::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'url' => $request['url'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Bannerimage();
                    break;
                
                case'slide':
                    Slide::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'url' => $request['url'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Slideimage();
                    break;
                
                case'award':
                    Award::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'url' => $request['url'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Awardimage();
                    break;

                case'board':
                    Board::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Boardimage();
                    break;

                case'management':
                    Management::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Managementimage();
                    break;

                case'newsitem':
                    Newsitem::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => (!empty($request['display'])?($request['display']):('0')),
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Newsitemimage();
                    break;
                
                case'article':
                    Article::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => (!empty($request['display'])?($request['display']):('0')),
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr(strip_tags($request['details']), 0, 100)
                    ]);
                    $moduleimage = new Articleimage();
                    break;
                
                case'faqcat':
                    Faqcat::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'description' => trim($request['details'])
                    ]);
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
                    $moduleimage->filename = $input['imagename'];
                    $moduleimage->itemid = $request['id'];
                    $moduleimage->alt = $request['caption'];
                    $moduleimage->caption = $request['caption'];
                    $moduleimage->main = '0';
                    $moduleimage->save();
                }
            }
        } else {
            //validate new module item
            $this->validate($request, [
                'title' => 'required|unique:abouts',
                'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            ]);            
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
            }
            
            //insert modules   
            if($request['type'] !="faqcat"){
            $moduleitem->title = $request['title'];
            $moduleitem->details = trim($request['details']);
            $moduleitem->position = $request['position'];
            $moduleitem->display = (!empty($request['display'])?($request['display']):('0'));
            $moduleitem->link_label = preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title']));
            $moduleitem->excerpt = substr(strip_tags($request['details']), 0, 100);
            
            }else{
            $moduleitem->title = $request['title'];
            $moduleitem->description = trim($request['details']);
            }
            $moduleitem->save();
            //if image exists
            $image = $request->file('image');
            if (!empty($image)) {
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/site/img');
                $image->move($destinationPath, $input['imagename']);

                //save the image                
                $moduleimage->filename = $input['imagename'];
                $moduleimage->itemid = $moduleitem->id;
                $moduleimage->alt = $request['caption'];
                $moduleimage->caption = $request['caption'];
                $moduleimage->main ='0';
                $moduleimage->save();
            }
        }

        return redirect()->back();
    }
    
    /*deletes items*/
    public function deleteItem($item_type,$id) {
        //chk for module type
            $del_type = $item_type;
            $imgarrays=array();
            $del_status=false;
            
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
                    $moduleitem = About::find($id);
                    $moduleitem->delete();
                    Aboutimage::where('itemid', $id)->delete(); 
                    $del_status=true;
                    break;

                case'service':
                    $moduleitem = Service::find($id);
                    $moduleitem->delete();
                    Serviceimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'testimonial':
                    $moduleitem = Testimonial::find($id);
                    $moduleitem->delete();
                    Testimonialimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'banner':
                    $moduleitem = Banner::find($id);
                    $moduleitem->delete();
                    Bannerimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'slide':
                    $moduleitem = Slide::find($id);
                    $moduleitem->delete();
                    Slideimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'award':
                    $moduleitem = Award::find($id);
                    $moduleitem->delete();
                    Awardimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'board':
                    $moduleitem = Board::find($id);
                    $moduleitem->delete();
                    Boardimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'management':
                    $moduleitem = Management::find($id);
                    $moduleitem->delete();
                    Managementimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'newsitem':                    
                    $moduleitem = Newsitem::find($id);
                    $moduleitem->delete();
                    Newsitemimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'article':                    
                    $moduleitem = Article::find($id);
                    $moduleitem->delete();
                    Articleimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;
                
                case'faqcat':                    
                    $moduleitem = Faqcat::find($id);
                    $moduleitem->delete();
                    $del_status=true;
                    break;

                default:
                    DB::table($del_type)->where('id', '=', $id)->delete();
                    $del_status=true;
                    break;
            }
            return $del_status;
    }
    
    /*deletes images*/
    public function deleteImages($item_type,$id) {
        //chk for module type
            $del_type = $item_type;
            $imgarrays=array();
            $del_status=false;
            
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
                    $del_status=true;
                    break;

                case'service':
                    Serviceimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'testimonial':
                    Testimonialimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'banner':
                    Bannerimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'slide':
                    Slideimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'award':
                    Awardimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'board':
                    Boardimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'management':
                    Managementimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'newsitem':                    
                    Newsitemimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;

                case'article':                    
                    Articleimage::where('itemid', $id)->delete();
                    $del_status=true;
                    break;
                
                case'faqcat':                    
                    $del_status=true;
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
//            $item_type=$request['type'];
//            $id=$request['id'];            
            $del_status=$this->deleteItem($request['type'], $request['id']);
        }else{
            $request->session()->flash('del_status', 'You are not authorised to perform this action!');
        }

        return redirect()->back();
    }

    public function fetchRangeOfPrices(Request $request) {
        //fetch range of unit prices
        $result=[];
        $from_date  = ($request['startDate'])?($request['startDate']):(date('m/d/Y'));
        $to_date    = ($request['endDate'])?($request['endDate']):(date('m/d/Y'));

        $from = date('Y-m-d' . ' 00:00:00', strtotime($from_date));
        $to = date('Y-m-d' . ' 00:00:00', strtotime($to_date));

        $range_of_prices = DB::table('unit_prices')
                ->whereBetween('report_date', [$from, $to])
                ->orderBy('report_date', 'desc')
                ->get();
        if($range_of_prices){
            $result=$range_of_prices;
        }
        return json_encode($result);
    }

}
