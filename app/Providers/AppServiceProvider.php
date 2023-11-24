<?php

namespace App\Providers;

use App\Models\Invoice\Invoice;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //check if the incoive is not paid to delete
        Validator::extend('invoice_delete', function ($attribute, $value, $parameters, $validator) {
          $inputs = $validator->getData();
          $invoice_id = $inputs['lab_invoice_id_delete'];

          $query = Invoice::where('status', '0')->find($invoice_id);

          if(!empty($query)) {
            return true;
            }
            else{
                return false;
            }
      }); 

      Paginator::useBootstrap();


    }
}