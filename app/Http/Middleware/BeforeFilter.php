<?php

namespace App\Http\Middleware;
use App\Job;
use Closure;
use Session;
use Request;
use Auth;
use Input;
use App\Page;
use Validator;
use Redirect;
use Hash;
use Route;
use Laracasts\Flash\Flash;
use View;
use App\Relationship;
use App\Conversation;
use App\ConversationMessage;

class BeforeFilter
{
   

    /**
     * Create a new filter instance.
     *
     *
     * @return void
     */
    public function __construct()
    {
        //GET FRIENDS
        if (Auth::check()) {
            $relations= Relationship::where('status',1)
                ->where('user_one',Auth::user()->id)
                ->orWhere('user_two',Auth::user()->id)
                ->get();
            //Get Convs
            $convs = Conversation::where('status',1)
                ->where('user_one',Auth::user()->id)
                ->orWhere('user_two',Auth::user()->id)
                ->get();

            $chat_html = ConversationMessage::PrepareChatHtml($relations,$convs);

        }
        view::share('friends_list',isset($chat_html)?$chat_html:null);

        // Page::Isset_Homepage();
        // $this->route = null;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       Job::ViewSharesPublicData();
       if (Auth::check()) {
            switch (Auth::user()->roles) {
                case 1://SUPERADMIN 
                case 2://ADMIN
                case 3://SIMPLEADMIN
                    Job::ViewShareAdminPrivateData();
                    break;
                default:
                    break;
            }
        }



        
        // Perform before page load
        
        $url = ($request->isMethod('post')) ? Session::get('_previous')['url'] : $request->url();

        if (!Request::is('users/login-modal','logout','users/login'))
        {
            Session::flash('redirect_flash',$url);
        } 
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $response = $next($request);
        //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        // Perform after page load
        // If request is post remove intended url for authorized users who were logged out and want to return to previous page
        if($request->isMethod('post')){
            Session::forget('intended_url');
        }

        return $response;

    }
}
