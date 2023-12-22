<?php

namespace App\Http\Middleware;

use App\Mail\Basic_mail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class ValidWebUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $website_url = request()->getHost();

        $valid_url = $_ENV['valid_url'];

        if ($website_url !== $valid_url) {
            return abort(404);

            $client_name = prox_sett('companyname');
            $company_name = prox_sett('companyname');
            $company_logo = prox_sett('logo');

            //email send
            $details = [
                'subject' => "Denied access from Tripo system " . $website_url,
                'client_name' => "Shady Hesham",
                'company_logo' => $company_logo,
                'company_name' => $company_name,
                'description' => "Access is denied from the following URL " . $website_url . " and the valid URL is " . $valid_url,
            ];

            $mail = Mail::to("systemtripo@gmail.com")->send(new Basic_mail($details));
        }

        return $next($request);
    }
}