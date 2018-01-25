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
use App\Newsitem;
use App\Newsitemimage;
use App\Board;
use App\Boardimage;
use App\Management;
use App\Managementimage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AppController extends BaseController {
    
    public function __construct(){
//        $this->middleware('auth');
        parent::__construct();
    }

    public function showPage($page, $sub_item = NULL, $data = []) {
        /* check if logged in, then redirect to requested page */
        if (!$this->isLoggedIn()) {
            //user not logged in: redirect
            return redirect()->route('login');
        } else {
            $data['siteitems'] = $this->getDBData('site');
            $data['services'] = $this->getDBData('service');
            $data['newsitem'] = $this->latest_news;
            $path = '/site/' . $page;
            $items = $page . 's';

            if ($sub_item) {               
                $path = '/site/' . $page.'_details';
                $data['listed_items'] = $this->showPaginatedList($page);//get paginated range                
                $data['fetched_item'] = $this->getDBData($page, $sub_item, false);//get selected item details,set page
                $page=$page."_details";
            } else {
                switch ($page) {
                    case 'index':
                    case 'investment':
                        $data['testimonials'] = $this->getDBData('testimonial');
                        $data['banners'] = $this->getDBData('banner');
                        $data['slides'] = $this->getDBData('slide');
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
                        $data['states'] = DB::table('ref_states_teams')->paginate(5);
                        $path = '/backend/' . $page;
                        break;
                    case 'activity':/* system generated */
                    case 'setup':
                    case 'dashboard':
                        $path = '/backend/' . $page;
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
                    case 'about':
                    case 'service':
                    case 'testimonial':
                    case 'banner':
                    case 'slide':
                    case 'newsitem':
                    case 'board':
                    case 'management':
                        $path = '/backend/' . $page;
                        $data['moduleitems'] = $this->getDBData($page);

//                        if (count($data['moduleitems']) <= 0) {//provide defaults if module is empty
//                            $sub_array = [];
//                            $sub_array['id'] = 0;
//                            $sub_array['title'] = "";
//                            $sub_array['details'] = "";
//                            $sub_array['link_label'] = "";
//                            $sub_array['position'] = 1;
//                            $sub_array['display'] = 1;
//                            $sub_array['keywords'] = "";
//                            $sub_array['description'] = "";
//                            $sub_array['excerpt'] = "";
//                            $sub_array['type'] = $page;
//                            $sub_array['filename'] = "";
//                            $sub_array['imageid'] = "";
//                            $sub_array['alt'] = "";
//                            $sub_array['caption'] = "";
//                            $sub_array['main'] = "";
//
//                            $data['moduleitems'] = $sub_array;
//                        }

                        break;
                    default:
                        break;
                }
            }

            return view($path, [
                'prices' => $this->latest_prices,
                'data' => $data,
                'page_name' => $page
            ]);
        }
    }
    
    /* process contact/enquiries */

    public function processContact(Request $request) {

        if ($request['id'] > 0) {//validate and already existing module item
            $this->validate($request, [
                'title' => 'required',
                'details' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subject' => 'required'
            ]);
            
            Response::where('id', $request['id'])->update([
                        'title' => $request['title'],
                        'details' => trim($request['details']),
                        'email' => $request['email'],
                        'phone' => $request['phone'],
                'ticket_id' => '1',
                        'subject' => $request['subject']
                    ]);
            
        } else {
            //validate not existing module item
            $this->validate($request, [
                'title' => 'required',
                'details' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subject' => 'required'
            ]);
            
            $moduleitem = new Response();            

            //insert modules            
            $moduleitem->title = $request['title'];
            $moduleitem->details = trim($request['details']);
            $moduleitem->email = $request['email'];
            $moduleitem->phone = $request['phone'];
            $moduleitem->subject = $request['subject'];
            $moduleitem->ticket_id = '1';
            $moduleitem->save();
        }

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

    /*
     * pension calculator
     * validates data received then calculates total package
     */

    public function processRegister(Request $request) {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'oname' => 'required',
            'email' => 'required',
            'states' => 'required',
            'phone' => 'required'
        ]);

        $moduleitem = new Registration();

        //insert modules            
        $moduleitem->fname = trim($request['fname']);
        $moduleitem->lname = trim($request['lname']);
        $moduleitem->email = trim($request['email']);
        $moduleitem->phone = trim($request['phone']);
        $moduleitem->states = $request['states'];
        $moduleitem->oname = trim($request['oname']);
        $moduleitem->save();

        $request->session()->flash('reg_status', 'Registration was successful!');
        //select contact email & send mail
//        Mail::send('emails.mailEvent', $user, function($message) use ($user) {
//            $message->to($user->email);
//            $message->subject('Mailgun Testing');
//        });
//        dd('Mail Sent Successfully');

        return redirect()->back();
    }

//    public function processRegMail() {
//        $user = User::find(1)->toArray();
//        Mail::send('emails.mailEvent', $user, function($message) use ($user) {
//            $message->to($user->email);
//            $message->subject('Mailgun Testing');
//        });
//        dd('Mail Send Successfully');
//    }

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

                case'newsitem':
                    $moduleitem = new Newsitem();
                    $moduleimage = new Newsitemimage();
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

        //    return redirect()->route('view');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {

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

            default:
                DB::table($del_type)->where('id', '=', $request['id'])->delete();
                break;
        }

        return redirect()->back();
    }

}
