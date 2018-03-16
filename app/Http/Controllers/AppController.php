<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Registration;
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
                    case 'about':
                    case 'service':
                    case 'testimonial':
                    case 'banner':
                    case 'slide':
                    case 'award':                    
                    case 'article':
                    case 'faqcat':
                    case 'board':
                    case 'management':
                        $this->checkLoggedStatus();
                        $path = '/backend/' . $page;
                        $data['moduleitems'] = $this->getDBData($page);
                        break;
                    case 'newsitem':
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
            'states' => 'required',
            'phone' => 'required',
            'employer' => 'required',
            'email' => 'required|email',
            'CaptchaCode' => 'required|valid_captcha'
        ]);

        $moduleitem = new Registration();

        //insert modules            
        $moduleitem->fname = trim($request['fname']);
        $moduleitem->lname = trim($request['lname']);
        $moduleitem->email = trim($request['email']);
        $moduleitem->phone = trim($request['phone']);
        $moduleitem->employer = trim($request['employer']);
        $moduleitem->states = $request['states'];
        $moduleitem->oname = trim($request['oname']);
        $moduleitem->validated = 'no';
        $moduleitem->save();
        
        //select contact email & send mail
//        $agent_details=DB::table('ref_states_teams')->select('contact_email')
//                    ->where('title', $request['states'])
//                ->get();
//        $agent_email=$agent_details[0];
//        
//        $data=array(
//            'email'=>trim($request['email']),
//            'phone'=>trim($request['phone']),
//            'states'=>trim($request['states']),
//            'subject'=>'RSA Generation',
//            'agent_email'=>$agent_email->contact_email,
//            'clientname'=>trim($request['fname']).' '.trim($request['lname'])
//        );  
        
        //send client validation email
        $data=array(
            'email'=>'cservice@ieianchorpensions.com',
            'phone'=>trim($request['phone']),
            'states'=>trim($request['states']),
            'subject'=>'RSA Generation',
            'agent_email'=>trim($request['email']),
            'clientname'=>trim($request['fname']).' '.trim($request['lname'])
        );
        
                
        Mail::send('emails.mailEvent', $data, function($message) use ($data) {
            $message->from($data['email']);
            $message->to($data['agent_email']);
            $message->subject('RSA Registration');
        });
        $request->session()->flash('reg_status', 'Registration was successful!');
        return redirect()->back();
    }

    public function pensionCalculator(Request $request) {
        //default values
        $data = [];
        $result = array('lumpsum' => '0.00',
            'monthly_pension' => '0.00',
            'qualify_for_lumpsum' => 'No',
            'qualify_for_programmed_withdrawal' => 'No',
            'total_package' => '0.00');

        $this->validate($request, [
            'rsa_balance' => 'numeric',
            'monthly_contribution' => 'numeric',
            'years_before_retirement' => 'numeric',
            'percentage_return' => 'numeric'
        ]);

        $percentageReturn = ($request['percentage_return']) / 100;
        $totalPackage = ($request['monthly_contribution'] * $request['years_before_retirement'] * 12) + ($request['rsa_balance'] * pow((1 + $request['percentage_return']), $request['years_before_retirement']));

        //format & set total package
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
//                'details' => 'required',
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
                        'excerpt' => substr($request['details'], 0, 100)
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
                        'excerpt' => substr($request['details'], 0, 100)
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
                        'excerpt' => substr($request['details'], 0, 100)
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
                        'excerpt' => substr($request['details'], 0, 100)
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
                        'excerpt' => substr($request['details'], 0, 100)
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
                        'excerpt' => substr($request['details'], 0, 100)
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
                        'excerpt' => substr($request['details'], 0, 100)
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
                        'excerpt' => substr($request['details'], 0, 100)
                    ]);
                    $moduleimage = new Managementimage();
                    break;

                case'newsitem':
                    Newsitem::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr($request['details'], 0, 100)
                    ]);
                    $moduleimage = new Newsitemimage();
                    break;
                
                case'article':
                    Article::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'position' => $request['position'],
                        'display' => $request['display'],
                        'link_label' => preg_replace('/[^A-Za-z0-9]/', '_', strtolower($request['title'])),
                        'excerpt' => substr($request['details'], 0, 100)
                    ]);
                    $moduleimage = new Articleimage();
                    break;
            }

            //if image exists
            $image = $request->file('image');
            if (!empty($image)) {
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/site/img');
                $image->move($destinationPath, $input['imagename']);

                //insert the image                
                $moduleimage->filename = $input['imagename'];
                $moduleimage->itemid = $request['id'];
                $moduleimage->alt = $request['caption'];
                $moduleimage->caption = $request['caption'];
                $moduleimage->main = $request['main'];
                $moduleimage->save();
            }
        } else {
            //validate and already existing module item
            $this->validate($request, [
                'title' => 'required|unique:abouts',
//                'details' => 'required',
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
            }

            //insert modules            
            $moduleitem->title = $request['title'];
            $moduleitem->details = trim($request['details']);
            $moduleitem->position = $request['position'];
            $moduleitem->display = $request['display'];
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
                $moduleimage->alt = $request['caption'];
                $moduleimage->caption = $request['caption'];
                $moduleimage->main = $request['main'];
                $moduleimage->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        if (session()->has('delete_group') && session('delete_group') == 1) {//can delete
            //chk for module type
            $del_type = $request['type'];
            switch ($del_type) {
                case'about':
                    $moduleitem = About::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'service':
                    $moduleitem = Service::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'testimonial':
                    $moduleitem = Testimonial::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'banner':
                    $moduleitem = Banner::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'slide':
                    $moduleitem = Slide::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'award':
                    $moduleitem = Award::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'board':
                    $moduleitem = Board::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'management':
                    $moduleitem = Management::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'newsitem':
                    
                    $moduleitem = Newsitem::find($request['id']);
                    $moduleitem->delete();
                    break;

                case'article':
                    $moduleitem = Article::find($request['id']);
                    $moduleitem->delete();
                    break;

                default:
                    DB::table($del_type)->where('id', '=', $request['id'])->delete();
                    break;
            }
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
