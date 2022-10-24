<?php

use App\Models\Product;
use App\Models\Requisition;
use Illuminate\Support\Facades\DB;
/**
 * Return sizes readable by humans
 */
function human_filesize($bytes, $decimals = 2)
{
  $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
  $factor = floor((strlen($bytes) - 1) / 3);

  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
      @$size[$factor];
}


function menuSubmenu($menu, $submenu)
{
  $request = request();
  $request->session()->forget(['lsbm','lsbsm']);
  $request->session()->put(['lsbm'=>$menu,'lsbsm'=>$submenu]);
  return true;
}
/**
 * Check Requisition Count
 */
function requisitionCount($type){

    if ($type == 'all') {
        $count= \App\Models\Requisition::where('status','!=','temp')->count();
        $count = $totals->total;
    }
    elseif ($type == 'rawStockedMaterials') {
        $count = \App\Models\RawStock::where('type','raw')->count();
    }elseif($type == 'packStockedMaterials'){
        $count = \App\Models\RawStock::where('type','pack')->count();
    }
    else {
        $count= \App\Models\Requisition::where('status','!=','temp')->where('status',$type)->count();
    }
    return $count;

}

/**
 * Gram To Kg
 */
function gTk($value)
{
    return $value / 1000;
}
/**
 * Kg To Gram
 */
function kTg($value)
{
    return $value * 1000;
}

/**
 * Litter To Milliter
 */
function lTm($value)
{
    return $value / 1000;
}
/**
 * Milliter To Litter
 */
function mTl($value)
{
    return $value * 1000;
}


/**
 * product Manufacture Count
 */
function productManufactureCount($type){

    $totals = DB::table('products')
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
    ->selectRaw("count(case when status = 'confirmed' then 1 end) as confirmed")
    ->selectRaw("count(case when status = 'processing' then 1 end) as processing")
    ->selectRaw("count(case when status = 'ready_to_stock' then 1 end) as ready_to_stock")
    ->selectRaw("count(case when status = 'in_stocked' then 1 end) as in_stocked")
    ->where('status','!=','temp')
    ->first();
    if ($type == 'all') {
        $count= Product::where('status','!=','temp')->count();
        $count = $totals->total;
    }elseif ($type == 'pending') {
        $count = $totals->pending;
    }elseif ($type == 'confirmed') {
        $count = $totals->confirmed;
    }elseif ($type == 'processing') {
        $count = $totals->processing;
    }elseif ($type == 'ready_to_stock') {
        $count = $totals->ready_to_stock;
    }elseif ($type == 'in_stocked') {
        $count = $totals->in_stocked;
    }
    else {
        $count= Product::where('status','!=','temp')->where('status',$type)->count();
    }
    return $count;

}
/**
 * Is the mime type an image
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

// function human_time()
// {
//     $time = ['seconds', 'minutes', 'hours', 'days', 'months', 'years'];
//     $factor = floor()
// }

function custom_slug($text)
{
    $date = date('ynjGis');
    $string = str_slug($text);
    $rand = strtolower(str_random(8));
    $string = substr($string, 0,100);
    return $date.'-'.$rand.'-'.$string;
}

function custom_name($text, $limit)
{
  if(strlen($text) > $limit)
  {
      return str_pad(substr($text, 0, ($limit - 2)), ($limit +1),'.');
  }
  else
  {
    return $text;
  }

}

function custom_title($text, $limit, $dot='...')
{
  if(strlen($text) > $limit)
  {
      $n = substr($text, 0, $limit);
      return $n . $dot;
  }
  else
  {
    return $text;
  }

}

function new_slug($text='')
{
  // $string = str_slug($text);
  // if($string){
  //   return $string;
  // }else{

  //   // return strtolower(preg_replace('/\s+/u', '-', $text));
  //   return strtolower(preg_replace('/[\W\s\/]+/', '-', $text));
  //   # return preg_replace('/\s+/u', '-', trim($string));
  // }

  $generator = new \Vnsdks\SlugGenerator\SlugGenerator;
  return $generator->generate($text);
}


function numberWithoutDashSpace($number)
{
  $number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
  return str_replace('-','', $number);
}



function mobileWithCode($mobile, $calling_code)
{
  $mobile = numberWithoutDashSpace($mobile);

  $number = trim($mobile);

    $c_code = $calling_code;
    $cc_count = strlen($c_code);

    if(substr($number, 0, 2) == '00')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '0')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '+')
    {
        $number = ltrim($number, '+');
    }
    if(substr($number, 0, $cc_count) == $c_code)
    {
        $number = substr($number, $cc_count);
    }
    if(substr($c_code, -1) == 0)
    {
        $number = ltrim($number, '0');
    }
    $finalNumber = $c_code.$number;


    return $finalNumber;


}

function bdMobileWithoutCode($mobile)
{
  $number = trim($mobile);
    $c_code = '0';
    $cc_count = strlen($c_code);

    if(substr($number, 0, 2) == '00')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '0')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '+')
    {
        $number = ltrim($number, '+');
    }
    if(substr($number, 0, $cc_count) == $c_code)
    {
        $number = substr($number, $cc_count);
    }
    if(substr($c_code, -1) == 0)
    {
        $number = ltrim($number, '0');
    }
    $finalNumber = $c_code.$number;

    return $finalNumber;
}

function bdMobile($mobile)
{
    $number = trim($mobile);
    $c_code = '880';
    $cc_count = strlen($c_code);

    if(substr($number, 0, 2) == '00')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '0')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '+')
    {
        $number = ltrim($number, '+');
    }
    if(substr($number, 0, $cc_count) == $c_code)
    {
        $number = substr($number, $cc_count);
    }
    if(substr($c_code, -1) == 0)
    {
        $number = ltrim($number, '0');
    }
    $finalNumber = $c_code.$number;

    return $finalNumber;
}


function smsBalanceUrl()
{
  // return 'http://connect.primesoftbd.com/api/balance?api_key=$2y$10$PT2OlLaCqLcVhqd1P1kl7ePKWg5axIQXjiuFFfYKtrJc03k8ohYYy';
}

function smsMaskingCode()
{
  // return 'T.M. Media';
}

function smsNonMaskingCode()
{
  return '8809601000500';
}

function smsApiKey()
{
  // return '$2y$10$PT2OlLaCqLcVhqd1P1kl7ePKWg5axIQXjiuFFfYKtrJc03k8ohYYy';
  // return 'R60008815db425b302a278.75780999';
  return 'C20050125dd63d8c22ca29.35869526';
}



################ sms parameter ###########
//https://sms.multisoftbd.com/Developers
//API URL (GET & POST) :  http://sms.multisoftbd.com/smsapi?api_key=(APIKEY)&type=text&contacts=(NUMBER)&senderid=(Approved Sender ID)&msg=(Message Content)

// Parameter Name  Meaning/Value Description
// api_key API Key Your API Key (R60008815db41685780486.06562292)
// type  text/unicode  text for normal SMS/unicode for Bangla SMS
// contacts  mobile number Exp: 88017XXXXXXXX+88018XXXXXXXX+88019XXXXXXXX...
// msg SMS body  N.B: Please use url encoding to send some special characters like &, $, @ etcCredit Balance API
// API URL : https://sms.multisoftbd.com/miscapi/(API Key )/getBalance
// API URL : Your API Key (R60008815db41685780486.06562292)
// Delivery Report API
// API URL : https://sms.multisoftbd.com/miscapi/(API Key )/getDLR/getAll
// API URL : Your API Key (R60008815db41685780486.06562292)
// Chunk per Call: 100
// SMS Shoot ID Enter the SMS ID returned when submitted SMS via API. It will return an array having mobile numbers and their DLR status.
// API URL : https://sms.multisoftbd.com/miscapi/(API Key )/getDLR/(SMS SHOOT ID)
// API Key Retrieval
// API URL : https://sms.multisoftbd.com/getkey/(username)/( password)
// Username : Your account User ID used to login.
// Password : Account password that you use to login.
// Error Code & Meaning
// Error Code  Meaning
// 1002  Sender Id/Masking Not Found
// 1003  API Not Found
// 1004  SPAM Detected
// 1005  Internal Error
// 1006  Internal Error
// 1007  Balance Insufficient
// 1008  Message is empty
// 1009  Message Type Not Set (text/unicode)
// 1010  Invalid User & Password
// 1011  Invalid User Id
// 1012  No Valid Number Found
################## sms parameter end #############


function bn2enNumber ($number){
    $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $en_number = str_replace($search_array, $replace_array, $number);

    return $en_number;
}

function en2bnNumber ($number){
    $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $en_number = str_replace($search_array, $replace_array, $number);

    return $en_number;
}

function localeNumber ($number)
{
  if(app()->getLocale() == 'bn')
  {
    return en2bnNumber($number);
  }
  elseif(app()->getLocale() == 'en')
  {
    return $number;
  }

}





    //for custom package
    //https://github.com/gocanto/gocanto-pkg
    //https://laravel.com/docs/5.2/packages
    //http://stackoverflow.com/questions/19133020/using-models-on-packages
    //http://kaltencoder.com/2015/07/laravel-5-package-creation-tutorial-part-1/
    //http://laravel-recipes.com/recipes/50/creating-a-helpers-file
