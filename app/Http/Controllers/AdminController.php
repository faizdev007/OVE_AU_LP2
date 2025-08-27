<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\Models\ModalData;
use App\Models\RequestQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function landing_page_list(){
        $landing_pages = LandingPage::paginate(10);
        return view('landingpages',[
            'landing_pages' => $landing_pages,
        ]);
    }
    //
    public function select_lp_theme(Request $request){
        // Validate the request to ensure 'lp_url' is present
        $request->validate([
            'page_name' => 'required|string|max:255',
            'template' => 'required|in:bacancy,siliconvalley',
        ]);
        
        $lp_url = Str::slug(strtolower($request->input('page_name')));
        $lp_theme = $request->input('template');

        if(!LandingPage::where(['lp_url'=>$lp_url])->count()){
            LandingPage::create([
                'page_name' => request()->input('page_name'),
                'lp_theme' => $lp_theme,
                'lp_url' => $lp_url,
                'page_contect' => json_encode([]),
                'ip_address' => request()->ip(),
            ]);

            return redirect()->route('create_lp_content',$lp_url);
        }else{
            return redirect()->back()->with('error','Page Already Existed!');
        }
    }

    public function create_lp_contect(LandingPage $lp_data){
        return view('landing_pages.'.$lp_data->lp_theme,[
            'lp_theme'=>$lp_data->lp_theme,
            'lp_data' =>$lp_data,
            'header'=> [
                'btntext'=>'Book a 30 mins strategy call',
                'menu'=>[
                    'OurTalent',
                    'Technical Stack',
                    'Case Study',
                    'FAQs'
                ]
            ]
        ]);
    }

    public function delete_lp_contect(LandingPage $lp_data)
    {
        $lp_data->forceDelete();
        session()->flash('success','Landing Page Delete Successfully!');
        return back();
    }


    public function form_querys()
    {
        $querys = RequestQuery::all()->toArray();
        return view('formquerys',compact('querys'));
    }
}
